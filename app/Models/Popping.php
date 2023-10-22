<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popping extends Model
{
    protected $table = 'popping';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Name',
    ];
}
