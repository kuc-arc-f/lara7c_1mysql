<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'password',
    ];    
}
