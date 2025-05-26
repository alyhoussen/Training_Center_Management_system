<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formationsession extends Model
{
    use HasFactory;
    protected $fillable = [
        'start',
        'end',
        'echeance',
        'frais',
        'niveau',
        'formation',
        'centre',
    ];
}
