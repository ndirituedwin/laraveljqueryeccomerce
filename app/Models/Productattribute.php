<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productattribute extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[

        'product_id',
        'size',
        'price',
        'stock',
        'sku',
        'status',
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
 