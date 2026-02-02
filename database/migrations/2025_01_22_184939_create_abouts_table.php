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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table
              ->foreignId("magasin_id")
              ->references("id")
              ->on("magasins")
              ->cascadeOnDelete();
            $table->text('our_history')->nullable();
            $table->text('our_vision')->nullable();
            $table->text('our_mission')->nullable();
            $table->text('our_values')->nullable();
            $table->text('our_sieges')->nullable();
            $table->text('sales_figures')->nullable();
            $table->text('areas_interest')->nullable();
            $table->text('our_invoice_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
