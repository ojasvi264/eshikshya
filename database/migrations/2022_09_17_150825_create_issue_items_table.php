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
        Schema::create('issue_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('issue_to')->constrained('staff_directories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('issue_by')->constrained('staff_directories')->onDelete('cascade')->onUpdate('cascade');
            $table->date('issue_date');
            $table->date('return_date');
            $table->foreignId('item_category_id')->constrained('item_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity');
            $table->text('note')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('issue_items');
    }
};
