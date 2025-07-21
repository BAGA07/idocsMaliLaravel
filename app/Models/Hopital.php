<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hopital extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_hopital', 
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
        return $this->hasMany(User::class, 'id_hopital');
    }

    public function declarations()
    {
        return $this->hasMany(VoletDeclaration::class, 'id_hopital');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'id_commune');
    }

    // Accesseurs
    public function getTypeLabelAttribute()
    {
        return 'Hôpital';
    }

    public function getNomAttribute()
    {
        return $this->nom_hopital;
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
}