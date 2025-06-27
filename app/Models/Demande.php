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
        'numero_volet_naissance',
        'id_volet',
    ];
     
    public function PieceJointe () {
         return $this->hasMany(PieceJointe::class);
    }
    
    public function Acte(){
        return $this->hasOne(Acte::class);
    }
    public function volet(){

        return $this->belongsTo(VoletDeclaration::class,'id_volet', 'id_volet');
    }
}
