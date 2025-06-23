<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declarant extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_declarant';

    protected $fillable = [
        'nom_declarant',
        'prenom_declarant',
        'age_declarant',
        'profession_declarant',
        'domicile_declarant',
        'numero_declaration',
        'date_declaration'
    ];

    public function declarant()
    {
        return $this->hasMany(VoletDeclaration::class, 'id_declarant');

    }
    use HasFactory; 
    public function Acte()
    {
        return $this->hasMany(Acte::class);
    }
}
