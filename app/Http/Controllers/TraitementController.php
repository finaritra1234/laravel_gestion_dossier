<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Traitement;
use App\Models\Dossier;
use App\Models\Enseignant;
use App\Models\Responsable;
use Session;
use DB;
class TraitementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }



    public function deposer($id)
    {
        $ens = Enseignant::find($id);
        $doss = Dossier::orderBy('created_at','asc')->get();
        $resp = Responsable::orderBy('created_at','desc')->get();
        return view('traitement.deposer',[
            'ens' => $ens,
            'doss' => $doss,
            'resp' => $resp,

        ]);

    }
    public function add(Request $request)
    {
            //validation
            $this->validate($request,[
                'dossier_id' => 'required',
                'enseignant_id' => 'required',
                'responsable_id' => 'required',
                'date_depot' => 'required'

            ],[
                'dosser_id.required' => 'Champ obligatoire',
                'enseignant_id.required' => 'Champ obligatoire',
                'responsable_id.required' => 'Champ obligatoire',
                'date_depot.required' => 'Champ obligatoire',


            ]);
              //creer traitement
            Traitement::create([
                'dossier_id' => $request->dossier_id,
                'enseignant_id' => $request->enseignant_id,
                'responsable_id' => $request->responsable_id,
                'date_depot' => $request->date_depot,

            ]);
           Session::flash('success', 'Dossier enregistrer avec succes!!!');
           return redirect()->route('traitement.liste');

    }

    public function transfer($id)
    {
        $ens = Enseignant::find($id);

        $resp = Responsable::orderBy('created_at','asc')->get();
        return view('traitement.transfer',[
            'ens' => $ens,

            'resp' => $resp,

        ]);

    }
    public function edit($id)
    {
        //$ens = Enseignant::find($id);
        $resp = Responsable::orderBy('created_at','asc')->get();
        $trait = Traitement::find($id);

        $re = Responsable::where('id',$trait->responsable_id)->first();

        return view('traitement.edit',[
            'trait' => $trait,
            'resp' => $resp,
            're' => $re
        ]);

    }
    public function update(Request $request,$id)
    {
            //validation
            $this->validate($request,[
                'responsable_id' => 'required'

            ],[
                'responsable_id.required' => 'Champ obligatoire',

            ]);
              // traitement
            $trait = Traitement::find($id);

            $trait->responsable_id  = $request->responsable_id;
            $trait->date_depot  = $request->date_depot;
            $trait->date_depot  = $request->date_depot;
            $trait->date_retour  = $request->date_retour;
            $trait->status  = $request->status;
            $trait->motif  = $request->motif;
            $trait->update();

           Session::flash('success', 'Dossier modifié avec succes!!!');
           return redirect()->route('traitement.liste');

    }

    public function transfert_update(Request $request, $id)
    {
            //validation
            $this->validate($request,[

                'responsable_id' => 'required',
                'date_envoye' => 'required'

            ],[
                'responsable_id.required' => 'Choisir le responsable',
                'date_envoye.required' => 'Champ obligatoire',


            ]);
            $trait = Traitement::find($id);
            $trait->responsable_id = $request->responsable_id;
            $trait->date_envoye = $request->date_envoye;
            $trait->update();
            Session::flash('success', 'Transfert reussie!!!');
            return redirect()->route('traitement.liste');

    }


    public function liste ()
    {
        $titre = '';
        //liste dossier
        $liste_ens = DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom')
        ->paginate(10);
        return view('traitement.list',  ['liste_ens' => $liste_ens, 'titre' => $titre]);
    }
    public function print ($id)
    {
        //liste dossier
        $liste_ens = DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom')
        ->where('traitements.id',$id)
        ->first();
        return view('traitement.print',  ['liste_ens' => $liste_ens]);
    }

    public function rejeter ()
    {
        $titre = 'REJETER';
        //liste dossier
        $liste_ens = DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom')
        ->where('traitements.status','REJETER')
        ->paginate(10);
        return view('traitement.list_requete',  ['liste_ens' => $liste_ens, 'titre' => $titre]);
    }
    public function accepter ()
    {
        $titre = 'ACCEPTER';
        //liste dossier
        $liste_ens = DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom')
        ->where('traitements.status','ACCEPTER')
        ->paginate(10);
        return view('traitement.list_requete',  ['liste_ens' => $liste_ens, 'titre' => $titre]);
    }
    public function attente ()
    {
        $titre = 'EN ATTENTE';
        //liste dossier
        $liste_ens = DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom')
        ->where('traitements.status',null)
        ->paginate(10);
        return view('traitement.list_requete',  ['liste_ens' => $liste_ens, 'titre' => $titre]);
    }
    public function rejeter_par_finance ()
    {
        $titre = 'REJETER PAR FINANCE';
        //liste dossier
        $liste_ens = DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom')
        ->where('traitements.status','REJETER')
        ->where('responsables.nom','Finance')
        ->paginate(10);
        return view('traitement.list_requete',  ['liste_ens' => $liste_ens, 'titre' => $titre]);
    }
    public function rejeter_par_visa ()
    {
        $titre = 'REJETER PAR VISA PREFET';
        //liste dossier
        $liste_ens = DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom')
        ->where('traitements.status','REJETER')
        ->where('responsables.nom','Visa prefet')
        ->paginate(10);
        return view('traitement.list_requete',  ['liste_ens' => $liste_ens, 'titre' => $titre]);
    }
    public function search (Request $request)
    {
        $critere = $request->critere;
        $search = $request->cle;



        //liste dossier
        $liste_ens = DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom');

        switch ($critere) {
            case 'im':
                $liste_ens->where('enseignants.im','like', '%'.$search.'%');
                 break;
            case 'nom':
                $liste_ens->where('enseignants.nom','like', '%'.$search.'%');
                break;
            case 'prenom':
                $liste_ens->where('enseignants.prenom','like', '%'.$search.'%');
                break;
            case 'grad':
                $liste_ens->where('enseignants.grad','like', '%'.$search.'%');
                break;
            case 'cord':
                $liste_ens->where('enseignants.corps','like', '%'.$search.'%');
                break;
            case 'indice':
                $liste_ens->where('enseignants.indice','like', '%'.$search.'%');
                break;
            case 'acte':
                $liste_ens->where('enseignants.acte','like', '%'.$search.'%');
                break;
             default:
                 # code...
                 break;
         }

         $titre =  "AVEC ".strtoupper($critere." = "."'".$search."'");

         $liste_ens = $liste_ens->paginate(10);
         return view('traitement.list',  ['liste_ens' => $liste_ens, 'titre' => $titre]);


    }
    public function search_date (Request $request)
    {
        $critere = $request->critere1;
        $search = $request->cle1;



        //liste dossier
        $liste_ens = DB::table('traitements')
        ->join('dossiers', 'traitements.dossier_id', '=', 'dossiers.id')
        ->join('responsables', 'traitements.responsable_id', '=', 'responsables.id')
        ->join('enseignants', 'traitements.enseignant_id', '=', 'enseignants.id')
        ->select('traitements.id','traitements.date_depot','traitements.date_envoye','traitements.date_retour','traitements.status','traitements.motif','traitements.enseignant_id','traitements.dossier_id','traitements.responsable_id',
                'enseignants.im','enseignants.nom as nom_enseignant','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte',
                'dossiers.type_dossier','responsables.nom');

        switch ($critere) {
            case 'date_depot':
                $liste_ens->where('traitements.date_depot','like', '%'.$search.'%');
                 break;
            case 'date_transfert':
                $liste_ens->where('traitements.date_envoye','like', '%'.$search.'%');
                break;
            case 'date_retour':
                $liste_ens->where('traitements.date_retour','like', '%'.$search.'%');
                break;

             default:
                 # code...
                 break;
         }

         $titre =  "AVEC ".strtoupper($critere." = "."'".$search."'");

         $liste_ens = $liste_ens->paginate(10);
         return view('traitement.list',  ['liste_ens' => $liste_ens, 'titre' => $titre]);


    }





}
