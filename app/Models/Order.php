<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'isOrdered',
        'User_Id',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'User_Id');
    }

    public function products_to_order()
    {
        return $this->hasMany(Product_to_Order::class);
    }
}
