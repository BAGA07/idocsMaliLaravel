<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mairie extends Model
{
    use HasFactory;

    protected $table = 'mairie';

    protected $fillable = [
        'nom_mairie',
        'quartier',
        'id_commune',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_mairie');
    }

    public function acte()
    {
        return $this->hasMany(Demande::class, 'id_mairie');
    }

    public function hopitaux()
    {
        return $this->hasMany(Hopital::class, 'id_mairie');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'id_commune');
    }

    // Accesseurs
    public function getTypeLabelAttribute()
    {
        return 'Mairie';
    }

    public function getNomAttribute()
    {
        return $this->nom_mairie;
    }

    public function getCommuneNameAttribute()
    {
        return $this->commune ? $this->commune->nom_commune : '';
    }

    // Scopes
    public function scopeActives($query)
    {
        return $query;
    }

    public function scopeParCommune($query, $commune)
    {
        return $query->whereHas('commune', function ($q) use ($commune) {
            $q->where('nom_commune', 'like', "%{$commune}%");
        });
    }
    public function Officier()
    {
        return $this->hasMany(Officier::class, 'id_mairie');
    }
}

