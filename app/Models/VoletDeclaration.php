<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoletDeclaration extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_volet';

    protected $fillable = [
        'date_naissance',
        'heure_naissance',
        'date_declaration',
        'prenom_enfant',
        'nom_enfant',
        'sexe',
        'nbreEnfantAccouchement',

        'prenom_pere',
        'nom_pere',
        'age_pere',
        'domicile_pere',
        'ethnie_pere',
        'situation_matrimonial_pere',
        'niveau_instruction_pere',
        'profession_pere',

        'prenom_mere',
        'nom_mere',
        'age_mere',
        'domicile_mere',
        'ethnie_mere',
        'situation_matrimonial_mere',
        'niveau_instruction_mere',
        'profession_mere',

        'nbreEINouvNee',
        'id_declarant',
        'id_hopital',
    ];

    public function declarant()
    {
        return $this->belongsTo(Declarant::class, 'id_declarant');
    }

    public function hopital()
    {
        return $this->belongsTo(Hopital::class, 'id_hopital');
    }
}