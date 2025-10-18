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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->integer('quantity');
            $table->date('date');
            $table
              ->foreignId("product_id")
              ->references("id")
              ->on("products")
              ->cascadeOnDelete();
            $table
              ->foreignId("magasin_id")
              ->references("id")
              ->on("magasins")
              ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
