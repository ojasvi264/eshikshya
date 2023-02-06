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
        Schema::create('hostel_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number');
            $table->foreignId('hostel_id')->constrained('hostels')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('room_type_id')->constrained('room_types')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('number_of_bed');
            $table->integer('cost_per_bed');
            $table->string('description');
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
        Schema::dropIfExists('hostel_rooms');
    }
};
