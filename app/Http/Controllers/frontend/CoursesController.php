<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Instractor;
use Carbon\Carbon;
use Auth;

class CoursesController extends Controller
{
    // public function index() {
    //     $categories = Category::with('courses')->get();

    //     return view('courses', compact('categories', 'page_name'));
    // }

    public function getCourses() {

        $courses = DB::table('courses')
        ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
        ->select('courses.*', 'categories.name as category_name')
        ->get();

        return response()->json([
            'status' => 'success',
            'courses' => $courses
        ]);
    }

    public function getCourseData($id, $user_id) {

        $course = DB::table('courses')
        ->join('courses_content', 'courses.id', '=', 'courses_content.course_id')
        ->select('courses.*', 'courses_content.*')
        ->where('courses.id', $id)
        ->first();

        $now = Carbon::now();
        $expiration = Carbon::parse($course->discount_expiration_date);
        $secondsUntilExpiration = abs(intval($expiration->diffInSeconds($now)));

        $this_user_courses = new Collection();



        if(isset($user_id) && $user_id !== null && !empty($user_id)) {
            $this_user = DB::table('users')
            ->leftJoin('enrolled_courses', 'users.id', '=', 'enrolled_courses.user_id')
            ->select('users.*', 'enrolled_courses.*')
            ->where('users.id', $user_id)
            ->where('enrolled_courses.status', 'paid')
            ->first();

            if($this_user)
                $this_user_courses = $this_user->pluck('course_id');
        }

        $discount_expiration_periods = [];

        $discount_expiration_periods['days'] = floor($secondsUntilExpiration / 86400);
        $discount_expiration_periods['hours'] = floor(($secondsUntilExpiration % 86400) / 3600);
        $discount_expiration_periods['minutes'] = floor(($secondsUntilExpiration % 3600) / 60);
        $discount_expiration_periods['seconds'] = $secondsUntilExpiration % 60;

        $course['discount_expiration_date'] = $discount_expiration_periods['days'].
        'd : '.$discount_expiration_periods['hours'].
        'h : '.$discount_expiration_periods['minutes'].
        'm : '.$discount_expiration_periods['seconds'].'s';

        $course['long_description'] = json_decode($course['long_description']);
        $course['course_target_items'] = json_decode($course['course_target_items']);
        $course['files'] = json_decode($course['files']);
        $course['available_languages'] = json_decode($course['available_languages']);

        return response()->json([
            'status' => 'success',
            'course' => $course,
            'this_user_courses' => $this_user_courses,
            'test' => $user_id
        ]);
    }

    public function search(Request $request) {

        $search_word = $request->word;
        $courses = DB::table('courses')
        ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
        ->select('courses.*', 'categories.name as category_name')
        ->where('courses.title', 'like', '%' . $search_word . '%')
        ->get();

        return response()->json([
            'status' => 'success',
            'search_word' => $search_word,
            'courses' => $courses
        ]);

    }

}
