<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Traitement;
use App\Models\Admin;
use App\Models\Responsable;
use DB;
class AdminController extends Controller
{

   public function __construct()
   {
       $this->middleware('auth:admin');

   }

   public function index(){

      $rejeter = Traitement::where('status','REJETER')->get();
      $acceper = Traitement::where('status','ACCEPTER')->get();
      $attente = Traitement::where('status',null)->get();
      $admin = Admin::get();
      $resp = Responsable::get();

    //   $pas_envoye = Traitement::where('date_envoye','!=', null)->get();
    //   $count_pas_envoye = count($pas_envoye);

      $count_rejeter = count($rejeter);
      $count_accepter = count($acceper);
      $count_attente = count($attente);
      $count_admin = count($admin);

      $dossiers = $this->liste_dossier();
      return view('admin',[
        'count_rejeter' => $count_rejeter,
        'count_accepter' => $count_accepter,
        'count_attente' => $count_attente,
        'dossiers' => $dossiers,
        'count_admin' => $count_admin,
        'admins' => $admin,
        'resps' => $resp,
      //  'pas_envoye' => $pas_envoye

      ]);
   }

   public function liste_dossier(){
        return DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.created_at','traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom')
        ->orderby('created_at','desc')
        ->take(5)
        ->get();
   }
}
