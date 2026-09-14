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

        // Clothing filters
        'name',
        'slug',
        'sku',
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

        'description',
        'price',
        'sale_price',
        'stock',
        'is_featured',
        'is_active',
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