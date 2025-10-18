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
        Schema::create('supply_orders', function (Blueprint $table) {
          $table->id();
          $table->integer('order')->nullable();
          $table->string('slug')->nullable();
          $table->string('bon_commande')->nullable();
          $table->string('payment_intent_id')->unique()->nullable();
          $table->dateTime('payment_created_at')->nullable();
          $table->integer('tva')->nullable();
          $table
            ->foreignId("magasin_id")->nullable()
            ->references("id")
            ->on("magasins")
            ->cascadeOnDelete();
          $table
            ->foreignId("supply_id")->nullable()
            ->references("id")
            ->on("supplies")
            ->cascadeOnDelete();
          $table->string('amount')->nullable();
          $table->enum('payment', ['Success', 'Pending','Cancelled'])->nullable();
          $table->integer('delivery')->nullable();
          $table->integer('status')->nullable();
          // $table->boolean('recept')->default(0);
          $table->boolean('notify')->default(0);
          $table->integer('request_id')->nullable();
          $table->integer('type')->nullable();
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
        Schema::dropIfExists('suply_orders');
    }
};
