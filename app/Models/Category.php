<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'img',
        'action',
        'added_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('upload/category/' . $value) : 'https://placehold.co/600x400?text=No+Image',
        );
    }
}
