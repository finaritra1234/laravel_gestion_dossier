<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $fillable = [
        'im','nom','prenom','date_naiss','lieu_naiss','corps','grad','indice','acte','etablissement_id'
    ];

    public function etablissement(){
        return $this->belongsTo('App\Models\Etablissement');
    }
}
