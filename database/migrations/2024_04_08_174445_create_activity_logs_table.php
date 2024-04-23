<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->string('table_name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('item_foreign_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('item_category')->nullable();
            $table->string('item_unit')->nullable();
            $table->string('changed_attributes')->nullable();
            $table->text('item_description')->nullable();
            $table->integer('item_in_stock')->nullable();
            $table->integer('item_out_stock')->nullable();
            $table->date('item_date')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
