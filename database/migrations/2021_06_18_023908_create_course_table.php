<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('material')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('public_id')->nullable();
            $table->string('video_link')->nullable();
            $table->string('view_count')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->foreignId('category_id')->nullable()->references('id')->on('category')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
}
