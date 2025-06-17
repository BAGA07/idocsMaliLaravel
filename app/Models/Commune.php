<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $primaryKey = 'id_commune';
    protected $fillable = ['nom_commune', 'region', 'cercle'];
}
