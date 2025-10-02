<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_billing_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'division',
        'district',
        'address',
        'zip_code',
        'phone',
        'cookie',
    ];
}
