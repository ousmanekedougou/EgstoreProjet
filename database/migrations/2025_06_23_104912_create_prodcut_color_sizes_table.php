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
        Schema::create('product_color_sizes', function (Blueprint $table) {
            $table->id();
            
            $table->integer('quantity');

            $table
              ->foreignId("product_id")->nullable()
              ->references("id")
              ->on("users")
              ->cascadeOnDelete();

            $table
              ->foreignId("color_id")->nullable()
              ->references("id")
              ->on("magasins")
              ->cascadeOnDelete();

            $table
              ->foreignId("size_id")->nullable()
              ->references("id")
              ->on("magasins")
              ->cascadeOnDelete();

            $table
              ->foreignId("magasin_id")->nullable()
              ->references("id")
              ->on("magasins")
              ->cascadeOnDelete();

              $table->boolean('visible')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodcut_color_sizes');
    }
};
