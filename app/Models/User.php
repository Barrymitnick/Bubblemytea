<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Username',
        'Password',
        'Email',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
