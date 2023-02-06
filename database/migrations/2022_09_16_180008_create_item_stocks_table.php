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
        Schema::create('item_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('item_category_id')->constrained('item_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('item_supplier_id')->constrained('item_suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('item_store_id')->constrained('item_stores')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity');
            $table->string('purchase_price');
            $table->date('date');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('item_stocks');
    }
};
