<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PieceJointe extends Model
{
    protected $fillable = [
        'id_demande',
        'nom_fichier',
        'chemin_fichier',
    ];
    use HasFactory;
    protected $table = 'pieces_jointes'; 
    public function Demande(){
        return $this->belongsTo(Demande::class);
    }
}
