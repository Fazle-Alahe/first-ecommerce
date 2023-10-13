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
        Schema::create('special_offer2s', function (Blueprint $table) {
            $table->id();
            $table->string('product_name2');
            $table->integer('price2');
            $table->integer('discount_price2');
            $table->string('image2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_offer2s');
    }
};
