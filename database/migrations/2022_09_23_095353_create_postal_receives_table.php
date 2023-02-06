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
        Schema::create('postal_receives', function (Blueprint $table) {
            $table->id();
            $table->string('from_title');
            $table->string('reference_no')->nullable();
            $table->string('address')->nullable();
            $table->string('to_title')->nullable();
            $table->string('postal_receive_date')->nullable();
            $table->longText('note')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('postal_receives');
    }
};
