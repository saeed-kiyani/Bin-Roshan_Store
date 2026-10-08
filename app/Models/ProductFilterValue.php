<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductFilterValue extends Model
{
    protected $fillable = [
        'product_id',
        'product_filter_id',
        'product_filter_option_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function filter(): BelongsTo
    {
        return $this->belongsTo(
            ProductFilter::class,
            'product_filter_id'
        );
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(
            ProductFilterOption::class,
            'product_filter_option_id'
        );
    }
}