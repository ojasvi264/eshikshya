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
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('question_type',['single_choice', 'multiple_choice', 'true_or_false', 'descriptive']);
            $table->enum('question_level',['low', 'medium', 'high']);
            $table->foreignId('eclasses_id')->constrained('eclasses')->onDelete('cascade')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade')->onDelete('cascade');
            $table->string('question');
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
        Schema::dropIfExists('question_banks');
    }
};
