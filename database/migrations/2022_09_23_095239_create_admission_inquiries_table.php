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
        Schema::create('admission_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->string('email')->unique()->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->string('inquiry_date')->nullable()->default(Carbon::now());
            $table->string('follow_up')->nullable();
            $table->foreignId('source_id')->constrained('sources')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('reference_id')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('teacher_id')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('class_id')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_of_child')->nullable()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('admission_inquiries');
    }
};
