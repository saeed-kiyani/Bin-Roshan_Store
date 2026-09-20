<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = [
        'category_id',

        // Common product fields
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'sale_price',
        'stock',
        'is_featured',
        'is_active',

        // Clothing filters
        'gender',
        'sizes',
        'brand',

        // Cosmetics filters
        'cosmetic_product_type',
        'skin_types',
        'concerns',
        'product_forms',

        // Lace filters
        'lace_category',
        'lace_subcategories',
        'width',
        'height',
        'length',

        // Jewelry filters
        'jewelry_gender',
        'jewelry_type',
        'jewelry_subcategories',
        'jewelry_quality',
        'ring_sizes',
        'necklace_lengths',
        'bracelet_sizes',

        // Watches filters
        'watch_gender',
        'strap_material',
        'watch_type',

        // Other Accessories
        'buttons',
        'piping_clothes',
        'accessory_type',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'stock' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',

        // Clothing
        'sizes' => 'array',

        // Cosmetics
        'skin_types' => 'array',
        'concerns' => 'array',
        'product_forms' => 'array',

        // Laces
        'lace_subcategories' => 'array',
        'width' => 'array',
        'height' => 'array',
        'length' => 'array',

        // Jewelry
        'jewelry_gender' => 'array',
        'jewelry_subcategories' => 'array',
        'jewelry_quality' => 'array',
        'ring_sizes' => 'array',
        'necklace_lengths' => 'array',
        'bracelet_sizes' => 'array',

        // Watches
        'watch_gender' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)
            ->orderBy('sort_order');
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_primary', true);
    }
}
