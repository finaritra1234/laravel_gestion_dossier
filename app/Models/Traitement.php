<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    protected $fillable = [
        'date_depot','date_envoye','date_retour', 'status','motif','enseignant_id','dossier_id','responsable_id'
    ];
   
    public function enseignant(){
        return $this->belongsTo('App\Models\Enseignant');
    }
    public function dossier(){
        return $this->belongsTo('App\Models\Dossier');
    }
    public function responsable(){
        return $this->belongsTo('App\Models\Responsable');
    }
}
