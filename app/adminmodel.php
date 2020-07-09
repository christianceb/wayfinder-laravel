<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminmodel extends Model
{
    protected $fillable = [
        'email', 'password', 'name'
    ];


} 
