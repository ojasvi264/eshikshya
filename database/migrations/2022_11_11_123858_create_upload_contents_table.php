<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('content_type',['assignments','study_material','syllabus','other_download']);
            $table->enum('available_for',['super_admin','student', 'classes']);
            $table->integer('class_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('upload_date');
            $table->string('description')->nullable();
            $table->string('content_file');
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
        Schema::dropIfExists('upload_contents');
    }
};
