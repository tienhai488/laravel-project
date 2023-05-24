<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\User\src\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i = 'a';$i<='z';$i++){
            $user = new User();
            $user->name = "Nguyen Van $i";
            $user->email = "nguyenvan$i@gmail.com";
            $user->group_id = 1;
            $user->password = Hash::make('123456');
            $user->save();
        }
    }
}