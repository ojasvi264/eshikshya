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
        Schema::create('fee_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fee_group_id');
            $table->foreign('fee_group_id')->on('fee_groups')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('fees_type_id');
            $table->foreign('fees_type_id')->on('fees_types')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->date('due_date');
            $table->string('amount');
            $table->string('fine_type');
            $table->string('percentage')->nullable();
            $table->string('fine_amount')->nullable();
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
        Schema::dropIfExists('fee_masters');
    }
};
