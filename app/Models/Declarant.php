<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declarant extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_declarant';

    protected $fillable = [
        'prenom_declarant',
        'nom_declarant',
        'age_declarant',
        'domicile_declarant',
        'ethnie_declarant',
        'profession_declarant',
        'numero_declaration',
        'date_declaration',
    ];

    public function declarations()
    {
        return $this->hasMany(VoletDeclaration::class, 'id_declarant');
    }
}