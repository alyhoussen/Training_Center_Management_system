<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "surname",
        "email",
        "telephone",   
        "CIN",
        "id_centre",
        "id_formation", 
        "datenaiss",
        "image"
    ];
}
