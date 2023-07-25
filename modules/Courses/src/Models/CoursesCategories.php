<?php
namespace Modules\Courses\src\Models;
use Illuminate\Database\Eloquent\Model;

class CoursesCategories extends Model {
    protected $fillable = [
        'course_id',
        'category_id'
    ];

    
}