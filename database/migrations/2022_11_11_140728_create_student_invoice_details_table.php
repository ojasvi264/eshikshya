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
        Schema::create('student_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_invoice_id')->constrained('student_invoices')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fee_type_id')->constrained('fee_types')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('is_hostel')->default(0);
            $table->integer('is_transporation')->default(0);
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
        Schema::dropIfExists('student_invoice_details');
    }
};
