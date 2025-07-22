<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Officier extends Model
{
    protected $table = 'officier_etat_civil'; 
    protected $fillable = [
        'nom',
        'prenom',
        'profession',
        'id_mairie',
    ];

    use HasFactory;
    public function Acte(){
        return $this->hasMany(Acte::class);
    }
    // public function Commune()
    // {
    //     return $this->belongsTo(Commune::class);
    // }
    public function Mairie()
{
    return $this->belongsTo(Mairie::class, 'id_mairie');
}

}
