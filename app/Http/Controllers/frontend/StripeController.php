<?php

namespace App\Http\Controllers\frontend;

use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\frontend\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $coursesIds = collect($request->courses)->pluck('id');

        $purchasedCourses = DB::table('courses')
            ->whereIn('id', $coursesIds)
            ->get();
            
        $stripe = new StripeClient(env("STRIPE_SECRET_KEY"));

        $lineItems = [];

        foreach ($purchasedCourses as $course) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'sar',
                    'product_data' => [
                        'name' => $course->title,
                        // 'image' => $course->image,
                    ],
                    'unit_amount' => $course->price * 100,
                ],
                'quantity' => 1,
            ];
        }

        $checkoutSession = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url('/success?session_id=' . "{CHECKOUT_SESSION_ID}"),
            'cancel_url' => url('/cancel'),
        ]);

        foreach ($purchasedCourses as $course) {
            $data[] = [
                'course_id' => $course->id,
                'user_id' => Auth::id(),
                'purchase_price' => $course->price,
                'session_id' => $checkoutSession->id,
                'status' => 'unpaid',
            ];
        }
        
        DB::table('onrolled_courses')->insert($data);

        return response()->json([
            'status' => 'success',
            'url' => $checkoutSession->url,
            'success_url' => url('/success?session_id=' . "{CHECKOUT_SESSION_ID}")
        ]);
    }

    public function success(Request $request) {

        $session_id = $request->get('session_id');

        try {

            $stripe = new StripeClient(env("STRIPE_SECRET_KEY"));

            $session = $stripe->checkout->sessions->retrieve($session_id);

            if(! $session) {
                throw new NotFoundHttpException;
            }

        } catch (\Throwable $th) {
            throw new NotFoundHttpException();
        }

        try {
            $courses = DB::table('onrolled_courses')
                ->where('session_id', $session_id)
                ->get();
        
            foreach ($courses as $course) {
                DB::table('onrolled_courses')
                    ->where('id', $course->id)
                    ->update(['status' => 'paid']);
            }
        
        } catch (\Exception $e) {
            Log::error('Failed to update course statuses: ' . $e->getMessage());
        }

        $cart = DB::table('carts')
        ->where('user_id', Auth::user()->id)
        ->first();

        if ($cart) {
            DB::table('cart_course')
                ->where('cart_id', $cart->id)
                ->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'تم إتمام عملية الشراء بنجاح'
        ]);

    }

    public function cancel() {

    }


}


