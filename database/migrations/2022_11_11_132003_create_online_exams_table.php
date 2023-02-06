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
        Schema::create('online_exams', function (Blueprint $table) {
            $table->id();
            $table->integer('is_quiz')->default(0);
            $table->string('title');
            $table->string('exam_from_date');
            $table->string('exam_from_time');
            $table->string('exam_to_date');
            $table->string('exam_to_time');
            $table->string('auto_publis_result_date');
            $table->string('auto_publis_result_time');
            $table->string('time_duration');
            $table->integer('number_of_attempt');
            $table->float('passing_percentage',8,2);
            $table->integer('publish_exam')->default(0);
            $table->integer('publish_result')->default(0);
            $table->integer('negative_marking')->default(0);
            $table->integer('display_marks_in_exam')->default(0);
            $table->integer('random_question_order')->default(0);
            $table->longText('description');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('online_exams');
    }
};
