<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('name')->nullable;
            $table->string('slug')->nullable;
            $table->text('detail')->nullable;
            $table->integer('teacher_id');
            $table->string('thumbnail')->nullable;
            $table->integer('price')->default(0);
            $table->integer('sale_price')->default(0);
            $table->string('code')->nullable;
            $table->integer('durations')->default(0);
            $table->boolean('is_document')->default(0);
            $table->text('support')->nullable;
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};