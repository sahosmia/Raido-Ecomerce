<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cupon extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'discount',
        'end_cupon',
        'action',

    ];
}
