<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->string('lace_category')->nullable()->after('category_id');

            $table->json('lace_subcategories')
                ->nullable()
                ->after('lace_category');

            $table->string('width')->nullable()->after('lace_subcategories');

            $table->string('height')->nullable()->after('width');

            $table->string('length')->nullable()->after('height');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn([
                'lace_category',
                'lace_subcategories',
                'width',
                'height',
                'length',
            ]);

        });
    }
};