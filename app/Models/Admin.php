<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;
class Admin extends Authenticable
{
    use HasFactory, SoftDeletes,Notifiable;
    protected $guard='admin';
    protected $fillable=[

        'name',
        'type',
        'mobile',
        'email',
        'image',
        'status',
        'password'
    ];
    protected $hidden=['password','remember_token'];

}
