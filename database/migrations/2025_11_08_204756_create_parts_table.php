<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('car_make');
            $table->string('car_model');
            $table->string('category')->nullable();
            $table->decimal('price', 10, 2);
            $table->enum('condition', ['New', 'Used']);
            $table->boolean('availability')->default(true);
            $table->text('description')->nullable();
            $table->json('images')->nullable(); // store image URLs
            $table->timestamps();

            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
