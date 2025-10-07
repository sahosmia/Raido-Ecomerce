<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;
    protected $table = 'product_photos';
    protected $fillable = [
        'img',
        'product',
        'added_by',
        'action',
    ];

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('upload/product_photo/' . $value) : 'https://placehold.co/600x400?text=No+Image',
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product');
    }
}