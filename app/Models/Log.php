<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ['id_utilisateur', 'action', 'details'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }
}
