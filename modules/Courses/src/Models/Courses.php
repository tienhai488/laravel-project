<?php
namespace Modules\Courses\src\Models;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;

class Courses extends Model {
        protected $fillable = [
        'name', 
        'slug', 
        'detail',
        'teacher_id',
        'thumbnail',
        'price',
        'sale_price',
        'code',
        'durations',
        'is_document',
        'support',
        'status',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class,'courses_categories','course_id','category_id');
    }
}