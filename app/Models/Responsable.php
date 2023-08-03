<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $fillable = [
        'nom','desc'
    ];

    public function traitement(){
        return $this->hasMany('App\Models\Traitement');
    }
}
