<?php

namespace Modules\Categories\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Courses;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'slug'];

    public function courses(){
        return $this->belongsToMany(Courses::class,'courses_categories','category_id','course_id');
    }
}