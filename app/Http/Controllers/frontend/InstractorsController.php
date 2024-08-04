<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

class InstractorsController
{
    /**
     * Display a listing of the resource.
     */
    public function getInstractors()
    {
        $instractors  = DB::table('instructors')
        ->leftJoin('users', 'instructors.user_id', '=', 'users.id')
        ->select('instructors.*', 'users.*')
        ->get();

        return response()->json([
            'status' => 'success',
            'instractors' => $instractors
        ]);

    }

}
