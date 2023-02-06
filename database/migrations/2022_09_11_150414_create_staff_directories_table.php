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
        Schema::create('staff_directories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('staff_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('gender');
            $table->string('dob');
            $table->string('marital_status');
            $table->string('permanent_address');
            $table->string('current_address');
            $table->string('qualification');
            $table->string('work_experience');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('emergency_phone');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('designation_id')->constrained('designations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_of_joining');
            $table->text('note')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('work_shift')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('staff_directories');
    }
};
