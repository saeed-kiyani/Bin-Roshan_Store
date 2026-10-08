<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_filter_values', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->foreignId('product_filter_id')
                ->constrained('product_filters')
                ->cascadeOnDelete();

            $table->foreignId('product_filter_option_id')
                ->constrained('product_filter_options')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'product_id',
                'product_filter_id',
                'product_filter_option_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_filter_values');
    }
};