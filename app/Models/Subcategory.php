<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


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

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function category_info()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}
