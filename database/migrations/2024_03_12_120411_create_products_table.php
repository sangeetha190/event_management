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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Product description (nullable)
            $table->decimal('price', 10, 2); // Product price (e.g., 10 digits with 2 decimal places)
            $table->integer('quantity')->default(0); // Product quantity (default to 0)
            $table->string('image'); // Image field
            $table->integer('discount')->default(0); // Make discount nullable
            $table->unsignedBigInteger('category_id')->nullable(); // Category ID
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // Foreign key relationship with categories table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
