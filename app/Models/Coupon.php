<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'couponoption',
        'couponcode',
        'categories',
        'users',
        'coupontype',
        'amounttype',
        'amount',
        'expirydate',
        'status',
    ];
}
