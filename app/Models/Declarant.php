<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declarant extends Model
{

    protected $table = 'declarants';

    use HasFactory;

    protected $primaryKey = 'id_declarant';

    protected $fillable = [
        'prenom_declarant',
        'nom_declarant',
        'age_declarant',
        'domicile_declarant',
        'ethnie_declarant',
        'profession_declarant',
        'numero_declaration',
        'date_declaration',
        'telephone',
        'email',
    ];

    public function declarant()
    {
        return $this->hasMany(VoletDeclaration::class, 'id_declarant', 'id_declarant');
    }

    public function acte()
    {
        return $this->hasMany(Acte::class);
    }
    //     public function hopital()
    // {
    //     return $this->belongsTo(Hopital::class);
    // }

}
