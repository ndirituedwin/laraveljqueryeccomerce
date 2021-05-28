<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'image',
        'slug',
        'link',
        'title',
        'alt',
        'status',
    ];
}
