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
        Schema::create('magasins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('admin_name');
            $table->string('email')->unique();
            $table->integer('phone')->unique();
            $table->integer('shop_phone')->unique()->nullable();
            $table->string('slug')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('adresse')->nullable();
            $table->string('registre_com')->nullable();
            $table->string('ninea')->nullable();
            $table->string('confirmation_token')->nullable();
            $table->integer('code_validation')->length(6)->nullable();
            $table->dateTime("expired_at")->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('termsService')->default(false);
            $table->boolean('visible')->default(false);
            $table->boolean('inv_status')->default(false);
            $table->integer('inv_at')->nullable();
            $table->string('prefix')->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magasins');
    }
};
