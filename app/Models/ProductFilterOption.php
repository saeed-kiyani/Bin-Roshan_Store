<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductFilterOption extends Model
{
    protected $fillable = [
        'product_filter_id',
        'value',
        'label',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function filter(): BelongsTo
    {
        return $this->belongsTo(ProductFilter::class, 'product_filter_id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(ProductFilterValue::class);
    }
}