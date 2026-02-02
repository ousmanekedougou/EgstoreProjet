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
        Schema::create('bagages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->string('amount')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('type')->default(false);
            $table->string('unique_code')->unique()->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('unite')->nullable();
            $table->date('exp_date')->nullable();
            $table
                ->foreignId("commande_id")
                ->references("id")
                ->on("commandes")
                ->cascadeOnDelete()->nullable();
            $table
                ->foreignId("magasin_id")
                ->references("id")
                ->on("magasins")
                ->cascadeOnDelete()->nullable();
            $table->dateTime('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bagages');
    }
};
