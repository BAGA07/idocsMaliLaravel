<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Officier extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'profession',
        'id_commune',
    ];

    use HasFactory;
    public function Acte(){
        return $this->hasMany(Acte::class);
    }
    public function Commune()
    {
        return $this->belongsTo(Commune::class);
    }
}
