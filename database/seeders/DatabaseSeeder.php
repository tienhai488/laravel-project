<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Categories\src\Models\Category;
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
            $cate = new Category();
            $cate->name = "nguyen van $i";
            $cate->slug = "nguyen_van_$i";
            $cate->save();
        }
    }
}