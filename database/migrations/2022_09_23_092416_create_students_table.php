<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            //$table->string('user_type')->default('student');
            $table->boolean('tc')->nullable();
            $table->string('image')->nullable();
            $table->string('admission')->nullable();
            $table->string('roll')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('class_id')->nullable()->constrained('eclasses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('section_id')->nullable()->constrained('sections')->onUpdate('cascade')->onDelete('cascade');
            $table->string('bloodgroup')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable()->default(Carbon::now());
            $table->string('phone')->nullable();
            $table->string('caddress')->nullable();
            $table->string('paddress')->nullable();
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
};
