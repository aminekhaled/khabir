<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;

    public $table = 'courses_content';

    protected $fillable = [
        'title',
        'video',
        'time',
        'poster',
        'course_id',
    ];

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }






}
