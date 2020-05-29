<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftuser extends Model
{
    protected $fillable = [
        "id","firstname","lastname","email","userorders" 
    ];
    protected $table = "ftusers";
}
