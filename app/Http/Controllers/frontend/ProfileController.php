<?php

namespace App\Http\Controllers\frontend;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{


    public function getUserData()
    {
        $user_id = Auth::user()->id;
        $user_data = DB::table('users')->where('id', $user_id)->first();
        
        $user_data['image'] = $user_data['image'] ? $user_data['image'] : 'user-avatar.png';

        return response()->json([
            'status' => 'success',
            'user_data' => $user_data
        ]);

    }

    public function certificates()
    {
        $user_id = Auth::user()->id;
        $user_data = DB::table('users')->where('id', $user_id)->first();

        return response()->json([
            'status' => 'success',
            'user_data' => $user_data
        ]);

    }

    public function getUserCourses()
    {
        
        $user_data = DB::table('users')
        ->select('users.id', 'users.name')
        ->leftJoin('onrolled_courses', 'users.id', '=', 'onrolled_courses.user_id')
        ->leftJoin('courses', 'onrolled_courses.course_id', '=', 'courses.id')
        ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
        ->where('users.id', Auth::user()->id)
        ->where('onrolled_courses.status', 'paid')
        ->select(
            'users.id as user_id',
            'users.name',
            'onrolled_courses.id as onrolled_course_id',
            'onrolled_courses.user_id',
            'onrolled_courses.course_id',
            'courses.id as course_id',
            'courses.category_id',
            'courses.title',
            'courses.instractor',
            'courses.img',
            'courses.small_description',
            'courses.price',
            'courses.original_price',
            'categories.id as category_id',
            'categories.name as category_name'
        )
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->user_id,
                'name' => $item->name,
                'onrolled_courses' => [
                    [
                        'id' => $item->onrolled_course_id,
                        'user_id' => $item->user_id,
                        'course_id' => $item->course_id,
                        'course' => [
                            'id' => $item->course_id,
                            'category_id' => $item->category_id,
                            'title' => $item->title,
                            'instractor' => $item->instractor,
                            'img' => $item->img,
                            'small_description' => $item->small_description,
                            'price' => $item->price,
                            'original_price' => $item->original_price,
                            'category' => [
                                'id' => $item->category_id,
                                'name' => $item->category_name,
                            ],
                        ],
                    ],
                ],
            ];
        });

        $user_data['image'] = $user_data['image'] ? $user_data['image'] : 'user-avatar.png';

        return response()->json([
            'status' => 'success',
            'user_data' => $user_data
        ]);
    }


}
