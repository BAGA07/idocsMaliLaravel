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
        'message',
    ];

    public function mairie()
    {
        return $this->belongsTo(Mairie::class, 'mairie_id');
    }

}
