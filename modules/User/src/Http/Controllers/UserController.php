<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\src\Models\User;
use Modules\User\src\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        // return view("user::lists");
        return view("admin.layouts.admin");
    }

    public function detail($id)
    {
        return view("user::detail", compact("id"));
    }

    public function add()
    {
        return "<h1>Add User</h1>";
    }
}