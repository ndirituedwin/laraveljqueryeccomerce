<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cmspage extends Model
{
    use HasFactory,softDeletes;
    protected $table='cmspages';
    protected $fillable=[
        'admin_id',
        'title',
        'description',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'status'
    ];
}
