<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'img',
        'price',
        'quantity',
        'description',
        'category_id',
        'subcategory_id',
        'added_by',
        'best_sell',
        'is_active',
        'discount',
        'notification_quantity',
    ];

    protected $with = ['category', 'subcategory', 'user'];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'discount' => 'decimal:2',
        'best_sell' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('upload/product/' . $value) : 'https://placehold.co/600x400?text=No+Image',
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id');
    }
}
