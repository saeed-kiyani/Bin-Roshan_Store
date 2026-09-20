<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('buttons')->nullable()->after('watch_type');
            $table->string('piping_clothes')->nullable()->after('buttons');
            $table->string('accessory_type')->nullable()->after('piping_clothes');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'buttons',
                'piping_clothes',
                'accessory_type',
            ]);
        });
    }
};