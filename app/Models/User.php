<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $hidden = ['id'];
    protected $fillable = ['id', 'balance'];
    protected $casts = [
        'balance' => 'integer',
    ];
}
