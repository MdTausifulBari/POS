<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticable
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['firstName', 'lastName', 'email', 'mobile', 'password'];

    protected $attributes = ['otp'=> '0'];

    protected $hidden = ['password', 'otp'];
}
