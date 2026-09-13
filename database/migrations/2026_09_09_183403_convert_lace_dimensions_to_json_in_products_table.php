<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Temporary JSON columns
        |--------------------------------------------------------------------------
        */

        Schema::table('products', function (Blueprint $table) {
            $table->json('width_json')->nullable()->after('length');
            $table->json('height_json')->nullable()->after('width_json');
            $table->json('length_json')->nullable()->after('height_json');
        });


        /*
        |--------------------------------------------------------------------------
        | Convert existing values into JSON arrays
        |--------------------------------------------------------------------------
        */

        $products = DB::table('products')
            ->select('id', 'width', 'height', 'length')
            ->get();

        foreach ($products as $product) {

            $width = $product->width !== null && $product->width !== ''
                ? (json_decode($product->width, true) ?: [$product->width])
                : null;

            $height = $product->height !== null && $product->height !== ''
                ? (json_decode($product->height, true) ?: [$product->height])
                : null;

            $length = $product->length !== null && $product->length !== ''
                ? (json_decode($product->length, true) ?: [$product->length])
                : null;

            DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'width_json' => $width !== null
                        ? json_encode($width)
                        : null,

                    'height_json' => $height !== null
                        ? json_encode($height)
                        : null,

                    'length_json' => $length !== null
                        ? json_encode($length)
                        : null,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Remove old string columns
        |--------------------------------------------------------------------------
        */

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'width',
                'height',
                'length',
            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | Rename JSON columns
        |--------------------------------------------------------------------------
        */

        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('width_json', 'width');
            $table->renameColumn('height_json', 'height');
            $table->renameColumn('length_json', 'length');
        });
    }


    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Convert JSON columns back to strings
        |--------------------------------------------------------------------------
        */

        Schema::table('products', function (Blueprint $table) {
            $table->string('width_string')->nullable();
            $table->string('height_string')->nullable();
            $table->string('length_string')->nullable();
        });


        $products = DB::table('products')
            ->select('id', 'width', 'height', 'length')
            ->get();

        foreach ($products as $product) {

            DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'width_string' => $product->width
                        ? json_encode(json_decode($product->width, true))
                        : null,

                    'height_string' => $product->height
                        ? json_encode(json_decode($product->height, true))
                        : null,

                    'length_string' => $product->length
                        ? json_encode(json_decode($product->length, true))
                        : null,
                ]);
        }


        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'width',
                'height',
                'length',
            ]);
        });


        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('width_string', 'width');
            $table->renameColumn('height_string', 'height');
            $table->renameColumn('length_string', 'length');
        });
    }
};