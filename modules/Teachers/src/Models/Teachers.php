<?php
namespace Modules\Teachers\src\Models;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model {
    protected $table = 'teachers';

    protected $fillable = [
        'name', 
        'slug', 
        'exp',
        'image',
        'description',
    ];

}