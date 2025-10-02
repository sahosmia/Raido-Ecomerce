<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'img',
        'product',
        'added_by',
        'action',
    ];

    public function product_info()
    {
        return $this->belongsTo(Product::class, 'product');
    }
}
