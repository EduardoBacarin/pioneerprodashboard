<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftuser extends Model
{
    protected $fillable = [
        "id","firstname","lastname","email","userorders" ,"addressemail","address1"
    ];
    protected $table = "ftusers";
}
