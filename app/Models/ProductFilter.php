<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductFilter extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'type',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProductFilterOption::class)
            ->orderBy('sort_order');
    }

    public function values(): HasMany
    {
        return $this->hasMany(ProductFilterValue::class);
    }
}