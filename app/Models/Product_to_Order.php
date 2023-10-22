<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_to_Order extends Model
{
    protected $table = 'product_to_order';

    protected $fillable = [
        'Qty',
        'Popping_Id',
        'sugar',
        'Product_Id',
        'Order_Id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_Id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'Order_Id');
    }

    public function popping()
    {
        return $this->belongsTo(Popping::class, 'Popping_Id');
    }
}
