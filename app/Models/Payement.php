<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_eleve",
        "total_pay",
        "montant_pay",
        "reste_pay",
        "description"
    ];
}
