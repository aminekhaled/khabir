<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Course;
use App\Models\User;


class CartController extends Controller
{

    public function getCartCourses(){


        $cart = Cart::with(['courses' => function($query) {
            $query->with('category');
        }])->where('user_id', Auth::user()->id)->get()->first();

        $userId = Auth::user()->id;

        $cart = DB::table('carts')
        ->where('user_id', $userId)
        ->first(); 

        if ($cart) {
            $courses = DB::table('courses')
            ->join('cart_course', 'courses.id', '=', 'cart_course.course_id')
            ->where('cart_course.cart_id', $cart->id)
            ->get();

            $coursesWithCategories = $courses->map(function ($course) {
                $course->category = DB::table('categories')
                    ->where('id', $course->category_id)
                    ->first();
                return $course;
            });
    
            $cart->courses = $coursesWithCategories;

        }
        
        $total_price = DB::table('courses')
        ->join('cart_course', 'courses.id', '=', 'cart_course.course_id')
        ->where('cart_course.cart_id', $cart->id)
        ->sum('courses.price');
        
        return response()->json([
            'status' => 'success',
            'cart' => $cart,
            'total_price' => $total_price
        ]);
    }

    public function addToCart(Request $request) {

        $userId = Auth::user()->id;

        $user_cart = DB::table('carts')
        ->where('user_id', $userId)
        ->first();

        $is_product_exist_in_cart = DB::table('cart_course')
        ->where('cart_course.cart_id', $user_cart->id)
        ->where('cart_course.course_id', $request->id)
        ->exists();

        if (!$is_product_exist_in_cart) {
            DB::table('cart_course')->insert([
                'cart_id' => $user_cart->id,
                'course_id' => $request->id,
            ]);
        }

        $courses_number = DB::table('cart_course')
        ->where('cart_id', $user_cart->id)
        ->count();

        return response()->json([
            'status' => 'success',
            'courses_number' => $courses_number
        ]);

    }

    public function removeToCart(Request $request) {

        $userId = Auth::user()->id;

        $user_cart = DB::table('carts')
        ->where('user_id', $userId)
        ->first();

        $is_product_exist_in_cart = DB::table('cart_course')
        ->where('cart_course.cart_id', $user_cart->id)
        ->where('cart_course.course_id', $request->id)
        ->delete();

        $total_price = DB::table('cart_course')
        ->join('courses', 'cart_course.course_id', '=', 'courses.id')
        ->where('cart_course.cart_id', $user_cart->id)
        ->sum('courses.price');

        return response()->json([
            'status' => 'success',
            'total_price' => $total_price,
            'courses_number' => $user_cart->courses()->count()
        ]);
    }

    public function getCartProductsNumber() {

        $userId = Auth::user()->id;

        $user_cart = DB::table('carts')
        ->where('user_id', $userId)
        ->first();

        $cart_courses_number = DB::table('cart_course')
        ->where('cart_id', $user_cart->id)
        ->count();

        return response()->json([
            'status' => 'success',
            'cart_courses_number' => $cart_courses_number
        ]);
    }


}
