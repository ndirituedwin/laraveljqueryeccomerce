<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdersProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'user_id',
        'order_id',
        'product_id',
        'product_code',
        'product_name',
        'product_color',
        'product_size',
        'product_price',
        'product_quantity'
    ];
    public function order(){
        return $this->belongsTo(OrdersProduct::class);
    }
}
