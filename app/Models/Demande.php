<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_complet',
        'email',
        'telephone',
        'type_document',
        'informations_complementaires',
        'justificatif',
    ];
}
