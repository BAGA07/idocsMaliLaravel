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
    'statut',
    'num_acte',
    'nombre_copie',
    'nom_personne_concernee',
    'prenom_personne_concernee',
    'date_evenement',
    'lieu_evenement',

    ];

    public function PieceJointe()
    {
        return $this->hasMany(PieceJointe::class);
    }


    public function acte()
    {
        return $this->hasOne(Acte::class,'id_demande');
    }
    public function volet()
    {

        return $this->belongsTo(VoletDeclaration::class, 'id_volet');
    }
}
