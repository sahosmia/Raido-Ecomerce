<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cupon_code extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'discount',
        'cupon_end',
        'action',

    ];
}
