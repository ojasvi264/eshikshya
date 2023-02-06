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
        Schema::create('staff_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attendance_date_id');
            $table->foreign('attendance_date_id')->references('id')->on('attendance_dates')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('directory_id');
            $table->foreign('directory_id')->references('id')->on('staff_directories')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('attendance');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('staff_attendances');
    }
};
