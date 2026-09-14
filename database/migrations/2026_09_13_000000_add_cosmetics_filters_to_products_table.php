<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Cosmetics Product Type
            |--------------------------------------------------------------------------
            | Example:
            | makeup, skincare, haircare, fragrance, body_care, nail_care
            |--------------------------------------------------------------------------
            */
            $table->string('cosmetic_product_type')
                ->nullable()
                ->after('brand');


            /*
            |--------------------------------------------------------------------------
            | Cosmetics Filters
            |--------------------------------------------------------------------------
            */

            $table->json('skin_types')
                ->nullable()
                ->after('cosmetic_product_type');

            $table->json('concerns')
                ->nullable()
                ->after('skin_types');

            $table->json('product_forms')
                ->nullable()
                ->after('concerns');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn([
                'cosmetic_product_type',
                'skin_types',
                'concerns',
                'product_forms',
            ]);

        });
    }
};