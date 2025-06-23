<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class Mairie extends Model
{
     protected $fillable = [
        'nom_mairie',
        'quartier',
        'id_commune',
    ];
    use HasFactory;
      public function Commune()
{
    return $this->belongsTo(Commune::class);

}
}
