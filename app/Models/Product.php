<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'brand',
        'price',
        'image',
        'stock',
        'remaining_stock',
    ];

    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
        'remaining_stock' => 'integer',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
