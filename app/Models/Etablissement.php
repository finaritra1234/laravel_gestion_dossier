<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    protected $fillable = [
        'cisco','nom_etabl','adresse_etabl'
    ];
   
    public function enseignant(){
        return $this->hasMany('App\Models\Enseignant');
    }
}
