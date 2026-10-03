<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
        'cloudinary_public_id',
        'cloudinary_asset_id',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Product relationship.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the actual browser-ready image URL.
     *
     * Supports both:
     * - Cloudinary URLs
     * - Legacy local storage paths
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('images/placeholder.jpg');
        }

        if (Str::startsWith($this->image, [
            'http://',
            'https://',
        ])) {
            return $this->image;
        }

        return asset(
            'storage/' . ltrim($this->image, '/')
        );
    }
}