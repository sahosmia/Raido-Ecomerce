<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_method',
        'user_id',
        'total',
        'cupon_id',
        'cookie',
        'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cupon()
    {
        return $this->belongsTo(Cupon::class, 'cupon_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'cookie', 'cookie');
    }
}
