<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController
{
    /**
     * Display a listing of the resource.
     */
    public function getCategories()
    {
        $categories = DB::table('categories')
        ->leftJoin('courses', 'categories.id', '=', 'courses.category_id')
        ->select('categories.*', 'courses.*')
        ->get()
        ->groupBy('id');

        return response()->json([
            'status' => 'success',
            'categories' => $categories
        ]);
    }

}
