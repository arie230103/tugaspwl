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
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->bigInteger('stock');
            $table->boolean('is_discount');
            $table->float('discount')->nullable();
            $table->longText('description');
            $table->float('rating')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('category_products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
