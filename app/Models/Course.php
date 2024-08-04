<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'small_description',
        'long_description',
        'instractor',
        'video_path',
        'img',
        'price',
        'original_price',
        'discount_status',
        'discount_value',
        'discount_expiration_date',
        'course_type',
        'unit',
        'files',
        'available_languages',
        'level',
        'course_target',
        'course_target_items',
        'category_id Ascending 1',
        'availability',
        'mobile_available',
        'is_best_sell',
    ];


    public function courses_content() {
        return $this->hasMany(CourseContent::class, 'course_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function onrolled_courses() {
        return $this->hasMany(OnrolledCourse::class);
    }


}
