<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'mairie_id',
        'from_hopital',
        'hopital_id',
        'from_mairie',
        'message',
        'type',
        'demande_id',
        'is_read'
    ];




    public function mairie()
    {
        return $this->belongsTo(Mairie::class, 'mairie_id');
    }
    //gerer aussi les notifications pour les hopitaux
    public function hopital()
    {
        return $this->belongsTo(Hopital::class, 'from_hopital');
    }

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }

}
