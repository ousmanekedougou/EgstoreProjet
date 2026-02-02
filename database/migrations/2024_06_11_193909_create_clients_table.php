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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->integer('phone')->unique();
            $table->string('adress')->nullable();
            $table->string('slug')->unique();
            $table->integer('account')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('depot')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('restant')->nullable();
            $table->integer('type')->nullable();
            $table->string('name_type')->unique()->nullable();
            $table->string('status_type')->nullable();
            $table->string('email_type')->unique()->nullable();
            $table->string('phone_type')->unique()->nullable();
            $table->string('rccm')->unique()->nullable();
            $table->string('ninea')->unique()->nullable();
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
        Schema::dropIfExists('clients');
    }
};
