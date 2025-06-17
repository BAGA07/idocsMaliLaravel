<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hopital extends Model
{
    use HasFactory;

    protected $fillable = ['nom_hopital', 'id_commune'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_hopital');
    }

    public function declarations()
    {
        return $this->hasMany(VoletDeclaration::class, 'id_hopital');
    }
}
