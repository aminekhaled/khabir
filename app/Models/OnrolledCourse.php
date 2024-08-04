<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnrolledCourse extends Model
{
    use HasFactory;

    public $table = "onrolled_courses";

    protected $fillable = [
        'user_id',
        'course_id',
        'purchase_price',
        'session_id',
        'expiration_date',
        'status'
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }





}
