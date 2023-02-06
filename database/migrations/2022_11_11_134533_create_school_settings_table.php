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
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slogan')->nullable();
            $table->string('established_year')->nullable();
            $table->string('logo')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->integer('take_late_fee')->default(0);
            $table->enum('type_of_late_fee', ['percentage','amount'])->nullable();
            $table->integer('late_fee_value')->default(0);
            $table->integer('late_fee_after')->nullable();
            $table->string('address')->nullable();
            $table->enum('result_type', ['percentage','grade'])->default('grade');
            $table->unsignedBigInteger('session_id');
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
        Schema::dropIfExists('school_settings');
    }
};
