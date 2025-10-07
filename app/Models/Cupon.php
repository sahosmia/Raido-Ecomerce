<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class Cupon extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'code',
        'discount_value',
        'discount_type',
        'expires_at',
        'is_active',
        'added_by',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'discount_value' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($cupon) {
            if (empty($cupon->slug)) {
                $cupon->slug = Str::slug($cupon->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
