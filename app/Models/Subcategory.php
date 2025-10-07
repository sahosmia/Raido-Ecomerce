<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Subcategory extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'category',
        'action',
        'added_by',
    ];



     protected static function boot()
    {
        parent::boot();

        static::creating(function ($subcategory) {
            $subcategory->slug = Str::slug($subcategory->name);
        });
    }


    public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'added_by');
}

}
