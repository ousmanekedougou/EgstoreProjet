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
        Schema::create('ides', function (Blueprint $table) {
            $table->id();
            $table->string('sujet')->nullable();
            $table->longText('msg')->nullable();
            $table->longText('reply')->nullable();
            $table->string('reply_by')->nullable();
            $table->string('image')->nullable();
            $table->boolean('type')->default(0);
            $table->boolean('status')->default(0);
            $table->foreignId("magasin_id")
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
        Schema::dropIfExists('ides');
    }
};
