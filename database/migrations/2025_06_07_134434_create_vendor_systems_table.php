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
        Schema::create('vendor_systems', function (Blueprint $table) {
            $table->id();
            
            $table->integer('quantity')->nullable();
            $table->integer('price_achat')->nullable();
            $table->integer('price_vente')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('price_revenu')->nullable();
            
            $table
            ->foreignId("magasin_id")
            ->references("id")
            ->on("magasins")
            ->cascadeOnDelete();

            $table
            ->foreignId("product_id")
            ->references("id")
            ->on("products")
            ->cascadeOnDelete();

             $table
            ->foreignId("unite_id")
            ->references("id")
            ->on("unites")
            ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_systems');
    }
};
