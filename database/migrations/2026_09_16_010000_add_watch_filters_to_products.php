<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('watch_gender')->nullable()->after('bracelet_sizes');
            $table->string('strap_material')->nullable()->after('watch_gender');
            $table->string('watch_type')->nullable()->after('strap_material');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'watch_gender',
                'strap_material',
                'watch_type',
            ]);
        });
    }
};
