<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('jewelry_gender')->nullable()->after('brand');
            $table->string('jewelry_type')->nullable()->after('jewelry_gender');
            $table->json('jewelry_subcategories')->nullable()->after('jewelry_type');
            $table->json('jewelry_quality')->nullable()->after('jewelry_subcategories');
            $table->json('ring_sizes')->nullable()->after('jewelry_quality');
            $table->json('necklace_lengths')->nullable()->after('ring_sizes');
            $table->json('bracelet_sizes')->nullable()->after('necklace_lengths');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'jewelry_gender',
                'jewelry_type',
                'jewelry_subcategories',
                'jewelry_quality',
                'ring_sizes',
                'necklace_lengths',
                'bracelet_sizes',
            ]);
        });
    }
};
