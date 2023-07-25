<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->timestamps();

            $table
            ->foreign('course_id')
            ->references('id')
            ->on('courses');
            
            $table
            ->foreign('category_id')
            ->references('id')
            ->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses_categories');
    }
};