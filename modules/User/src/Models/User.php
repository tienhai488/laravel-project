<?php
namespace Modules\User\src\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $fillable = ['name', 'email', 'password','group_id'];
}