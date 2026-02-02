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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->nullable();
            $table->integer('num_invoice')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->integer('phone')->nullable();
            $table->string('slug')->unique();
            $table->string('adresse')->nullable();
            $table->string('bon_commande')->nullable();
            $table->dateTime('payment_created_at')->nullable();
            $table->integer('tva')->nullable();
            $table->boolean('type')->default(false);
            $table->foreignId("user_id")->nullable()
            ->references("id")
            ->on("users")
            ->cascadeOnDelete();
            $table->foreignId("magasin_id")
            ->references("id")
            ->on("magasins")
            ->cascadeOnDelete();
            $table->foreignId("client_id")->nullable()
            ->references("id")
            ->on("magasins")
            ->cascadeOnDelete();
            $table->string('amount')->nullable();
            $table->enum('payment', ['Success', 'Pending','Cancelled'])->nullable();
            $table->enum('delivery', ['Success', 'Pending','Cancelled'])->nullable();
            $table->integer('status')->nullable();
            $table->boolean('validate')->default(false);
            $table->date('date');
            $table->integer('methode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
