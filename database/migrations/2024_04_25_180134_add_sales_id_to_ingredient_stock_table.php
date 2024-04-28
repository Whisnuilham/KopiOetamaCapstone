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
        Schema::table('ingredient_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('sales_id')->after('ingredient_id')->nullable();
            $table->foreign('sales_id')->references("id")->on('penjualans')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredient_stock', function (Blueprint $table) {
            //
        });
    }
};
