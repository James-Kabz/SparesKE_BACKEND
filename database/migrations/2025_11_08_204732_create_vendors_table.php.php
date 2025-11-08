<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('shop_name');
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('verified')->default(false);
            $table->decimal('rating', 2, 1)->default(0);
            $table->json('socials')->nullable(); // e.g., whatsapp, facebook links
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
