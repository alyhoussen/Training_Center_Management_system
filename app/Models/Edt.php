<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edt extends Model
{
    use HasFactory;
    protected $fillable = [
        "jour",
        "heur",
        "type",
        "nom_formation",
        "centre",
        "date_edt",
        "niveau",
        "nom_enseignant",
    ];
}
