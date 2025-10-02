<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'img',
        'price',
        'quantity',
        'discount',
        'notification_quantity',
        'action',
        'best_sell',
        'category',
        'subcategory',
        'added_by',
    ];

    protected $casts = [
        'price' => 'float',
        'quantity' => 'integer',
        'discount' => 'float',
        'best_sell' => 'boolean',
    ];

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('upload/product/' . $value) : 'https://placehold.co/600x400?text=No+Image',
        );
    }

    public function category_info()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function subcategory_info()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function photos()
    {
        return $this->hasMany(Product_photo::class, 'product');
    }
}
