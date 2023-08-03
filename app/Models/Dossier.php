<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    protected $fillable = [
        'type_dossier','nb_dossier'
    ];

    public function traitement(){
        return $this->hasMany('App\Models\Traitement');
    }
}
