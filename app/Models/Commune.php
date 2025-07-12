<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Commune extends Model
{
    use HasFactory;

    // protected $primaryKey = 'id_commune';
    protected $fillable = ['nom_commune', 'region', 'cercle'];

    public function hopitaux()
    {
        return $this->hasMany(Hopital::class, 'id_commune');
    }


    public function Mairie()
    {
        return $this->hasOne(Mairie::class);
    }
    public function Officier()
    {
        return $this->hasMany(Officier::class);
    }
}
