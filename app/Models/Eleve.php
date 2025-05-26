<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "surname",
        "datenaiss",
        "cin",
        "telephone",
        "email",
        "image",
        "level",
        "id_centre",
        "enseignant",
        "id_formation",
        "id_session",
        "certificate"
    ];
}
