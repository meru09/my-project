<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'price',
        'stock',
        'size',
        'color',
        'shade',
        'available',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
