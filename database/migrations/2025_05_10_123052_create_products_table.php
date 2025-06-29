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
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->string('categories')->nullable();
            $table->boolean('is_available')->default(true);
            $table->enum('type', ['kasur', 'sofa', 'perlengkapan_bayi', 'add_on'])->nullable();
            $table->enum('size', [
                // Kasur sizes
                'super_king', 'king', 'queen', 'single', 'kecil',
                // Sofa sizes
                'standard', 'jumbo', 'bed', 'L_shape', 'recliner',
                // Null for other types
                null
            ])->nullable();
            $table->integer('seat_count')->nullable(); // Untuk car interior
            $table->string('unit')->nullable(); // Untuk items yang menggunakan unit m2
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
