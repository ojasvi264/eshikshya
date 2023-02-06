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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->string('name');
            $table->string('date_from');
            $table->string('date_to');
            $table->string('description');
            $table->string('result_date');
            $table->integer('status')->default(1);
            $table->foreignId('eclasses_id')->constrained('eclasses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('sections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('exam_type_id')->constrained('examination_types')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('exams');
    }
};
