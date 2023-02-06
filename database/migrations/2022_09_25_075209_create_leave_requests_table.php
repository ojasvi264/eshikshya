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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('apply_date');
            $table->unsignedBigInteger('leave_type_id');
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('role_id')->nullable();
            $table->integer('directory_id')->nullable();
            $table->string('user_id')->nullable();
            $table->date('leave_from');
            $table->date('leave_to');
            $table->text('reason');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0 => Pending, 1 =>Approved, 2 => Disapproved" );
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
        Schema::dropIfExists('leave_requests');
    }
};
