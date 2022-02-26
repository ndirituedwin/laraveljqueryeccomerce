<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    public function deliveryaddresses(){
        return $this->hasMany(DeliveryAddress::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
