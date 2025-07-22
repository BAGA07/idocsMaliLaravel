<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class Acte extends Model

{
    protected $table = 'acte_naissance';

    protected $fillable = [
        'num_acte',
        'date_naissance_enfant',
        'lieu_naissance_enfant',
        'sexe_enfant',
        'nom',
        'prenom',
        'heure_naissance',

        // Infos père
        'nom_pere',
        'prenom_pere',
        'proffesion_pere',
        'domicile_pere',

        // Infos mère
        'nom_mere',
        'prenom_mere',
        'proffesion_mere',
        'domicile_mere',

        // Clés étrangères
        'id_officier',
        'id_declarant',
        'id_commune',
        'id_demande',

        'date_enregistrement_acte',
        'token'
    ];

    use HasFactory;
    public function declarant()
   {
    return $this->belongsTo(Declarant::class,'id_declarant');
   }
   public function Commune()
  {
    return $this->belongsTo(Commune::class,'id_commune','id');
   }
    public function Officier(){
        return $this->belongsTo(Officier::class,'id_officier');
    }
   // public function User(){
        //return $this->belongsTo(User::class);
    //}
    public function demande(){
        return $this->belongsTo(Demande::class,'id_demande');
    }
    public function voletDeclaration(){
        return $this->belongsTo(VoletDeclaration::class,'id_volet');

    }
}
