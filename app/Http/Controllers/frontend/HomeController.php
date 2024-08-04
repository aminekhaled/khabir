<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Models\OnrolledCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page_name = 'index';

        $courses = DB::table('courses')
        ->leftJoin('categories', 'courses.category_id', '=', 'categories.id')
        ->select('courses.*', 'categories.name as category_name') 
        ->get();
        
        $instructors = DB::table('instructors')
        ->leftJoin('users', 'instructors.user_id', '=', 'users.id')
        ->select('instructors.*', 'users.name as user_name')
        ->get();
        
        return view('index', compact('page_name', 'courses', 'instructors'));
            }

}
