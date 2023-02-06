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
        Schema::create('manage_syllabus_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('topic_id')->constrained('topics')->onUpdate('cascade')->onDelete('cascade');
            $table->date('completion_date')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('manage_syllabus_statuses');
    }
};
