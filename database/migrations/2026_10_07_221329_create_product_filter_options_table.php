<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_filter_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_filter_id')
                ->constrained('product_filters')
                ->cascadeOnDelete();

            $table->string('label');
            $table->string('value');

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->unique([
                'product_filter_id',
                'value',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_filter_options');
    }
};