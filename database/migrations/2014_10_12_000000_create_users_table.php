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
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('email')->unique();
                $table->integer('phone')->unique();
                $table->string('adresse')->nullable();
                $table->string('password');
                $table->string('image')->nullable();
                $table->boolean('is_active')->default(false);
                $table->string('confirmation_token')->nullable();
                $table->integer('code_validation')->length(6)->nullable();
                $table->dateTime("expired_at")->nullable();
                $table->boolean('termsService');
                $table->timestamp('email_verified_at')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
