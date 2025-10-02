<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
