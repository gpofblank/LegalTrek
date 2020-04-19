<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $fillable = [
    	'name', 'description'
    ];
}
