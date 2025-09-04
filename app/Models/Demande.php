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
        'commune_demandeur',
        'type_document',
        'informations_complementaires',
        'justificatif',
        'statut',
        'num_acte',
        'nombre_copie',
        'numero_volet_naissance',
        'id_volet',
        'numero_suivi', // NULL pour les demandes d'actes originaux (volet), généré pour les demandes de copies (plateforme)
        'id_utilisateur', // Pour les demandes via volet (actes originaux) qui nécessitent une connexion
        'id' // Référence vers l'acte créé (original ou copie)
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

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_demandeur');
    }
}
