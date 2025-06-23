<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class Acte extends Model

{
    protected $fillable = [
        'num_acte',
        'date_naissance_enfant',
        'lieu_naissance_enfant',
        'sexe_enfant',
        'nom',
        'prenom',

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
    ];

    use HasFactory;
    public function declarant()
   {
    return $this->belongsTo(Declarant::class);
   }
   public function Commune()
  {
    return $this->belongsTo(Commune::class);
   }
    public function Officier(){
        return $this->belongsTo(Officier::class);
    }
   // public function User(){
        //return $this->belongsTo(User::class);
    //}
    public function Demande(){
        return $this->belongsTo(Demande::class);
    }
    public function voletDeclaration(){
        return $this->belongsTo(VoletDeclaration::class);

    }
}
