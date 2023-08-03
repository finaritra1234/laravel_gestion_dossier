<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enseignant;
use App\Models\Etablissement;
use Session;
use DB;
class EnseignantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function Enseignant()
    {
        //liste Enseignant
        $liste_ens = DB::table('enseignants')
        ->join('etablissements', 'enseignants.etablissement_id', '=', 'etablissements.id')
        ->select('enseignants.id','enseignants.created_at','enseignants.im','enseignants.nom','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte','etablissements.cisco')
        ->orderBy('created_at','asc')
        ->paginate(10);
        return view('enseignant.list',  ['liste_ens' => $liste_ens]);
    }

    public function form_add(){
        $etabl = Etablissement::orderBy('created_at','desc')->get();
        return view('enseignant.add')->with('etabl', $etabl);

    }

    public function add(Request $request)
    {
            //validation
            $this->validate($request,[
                'im' => 'required|string',
                'nom' => 'required|string',
                'prenom' => 'string',
                'date_naiss' => 'required',
                'lieu_naiss' => 'required',
                'corps' => 'required',
                'indice' => 'required',
                'acte' => 'required',
                'etablissement_id' => 'required',
            ],[
                'im.required' => 'Champ obligatoire',
                'nom.required' => 'Champ obligatoire',
                'date_naiss.required' => 'Champ obligatoire',
                'lieu_naiss.required' => 'Champ obligatoire',
                'corps.required' => 'Champ obligatoire',
                'indice.required' => 'Champ obligatoire',
                'acte.required' => 'Champ obligatoire',
                'etablissement_id.required' => 'Champ obligatoire',

            ]);

            //creer Enseignant
            Enseignant::create([
                'im' => $request->im,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'date_naiss' => $request->date_naiss,
                'lieu_naiss' => $request->lieu_naiss,
                'corps' => $request->corps,
                'grad' => $request->grad,
                'indice' => $request->indice,
                'acte' => $request->acte,
                'etablissement_id' => $request->etablissement_id,

            ]);
            Session::flash('success', 'Enseignant ajouté avec succes!!!');
            return redirect()->back();

    }

    public function edit($id)
    {
          //liste Enseignant


        $liste_ens =  Enseignant::paginate(10);
        $ens = Enseignant::find($id);

        $etab_id = $ens->etablissement_id;

        $liste_etab =  Etablissement::where('id',  $etab_id)->first();
        $etabl = Etablissement::all();

        return view('enseignant.edit',[
            'ens' => $ens,
            'liste_ens' => $liste_ens,
            'liste_etab' => $liste_etab,
            'etabl' => $etabl
        ]);

    }
    public function update(Request $request, $id)
    {
            //validation
            $this->validate($request,[
                'im' => 'required|string',
                'nom' => 'required|string',
                'prenom' => 'string',
                'date_naiss' => 'required',
                'lieu_naiss' => 'required',
                'corps' => 'required',
                'indice' => 'required',
                'acte' => 'required',
                'etablissement_id' => 'required',
            ],[
                'im.required' => 'Champ obligatoire',
                'nom.required' => 'Champ obligatoire',
                'date_naiss.required' => 'Champ obligatoire',
                'lieu_naiss.required' => 'Champ obligatoire',
                'corps.required' => 'Champ obligatoire',
                'indice.required' => 'Champ obligatoire',
                'acte.required' => 'Champ obligatoire',
                'etablissement_id.required' => 'Champ obligatoire',

            ]);
           $ensl = Enseignant::find($id);
           $ensl->im = $request->im;
           $ensl->nom = $request->nom;
           $ensl->prenom = $request->prenom;
           $ensl->date_naiss = $request->date_naiss;
           $ensl->lieu_naiss = $request->lieu_naiss;
           $ensl->corps = $request->corps;
           $ensl->indice = $request->indice;
           $ensl->acte = $request->acte;
           $ensl->etablissement_id = $request->etablissement_id;

           $ensl->update();
            Session::flash('success', 'Enseignant modifié avec succes!!!');
            return redirect()->route('enseignant.liste');

    }
    public function delete($id)
    {
        Enseignant::find($id)->delete();
        Session::flash('success', 'Enseignant supprimé avec succes!!!');
            return redirect()->back();

    }
    public function search (Request $request){
        $critere = $request->critere;
        $search = $request->cle;


        $liste_ens = DB::table('enseignants')
            ->join('etablissements', 'enseignants.etablissement_id', '=', 'etablissements.id')
            ->select('enseignants.id','enseignants.im','enseignants.nom','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte','etablissements.cisco');


        switch ($critere) {
            case 'im':
                $liste_ens->where('enseignants.im','like', '%'.$search.'%');
                 break;
            case 'cisco':
                $liste_ens->where('etablissements.cisco','like', '%'.$search.'%');
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

         $liste_ens = $liste_ens->paginate(10);
         return view('enseignant.list',  ['liste_ens' => $liste_ens]);


    }

    public function print()
    {
         $titre = "TOUT LES ENSEIGNANTS";
         //liste Enseignant
         $liste_ens = DB::table('enseignants')
         ->join('etablissements', 'enseignants.etablissement_id', '=', 'etablissements.id')
         ->select('enseignants.id','enseignants.im','enseignants.nom','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte','etablissements.cisco')
         ->paginate(10);
         return view('enseignant.list_print',  ['liste_ens' => $liste_ens ,'titre' => $titre]);
    }

    public function print_c (Request $request){
        $critere = $request->critere1;
        $search = $request->cle1;


        $liste_ens = DB::table('enseignants')
            ->join('etablissements', 'enseignants.etablissement_id', '=', 'etablissements.id')
            ->select('enseignants.id','enseignants.im','enseignants.nom','enseignants.prenom','enseignants.date_naiss','enseignants.lieu_naiss','enseignants.corps','enseignants.grad','enseignants.indice','enseignants.acte','etablissements.cisco');


        switch ($critere) {
            case 'im':
                $liste_ens->where('enseignants.im','like', '%'.$search.'%');

                $titre = "IM : ". $search;
                 break;
            case 'cisco':
                $liste_ens->where('etablissements.cisco','like', '%'.$search.'%');
                $titre = "CISCO : ". $search;
                break;
            case 'grad':
                $liste_ens->where('enseignants.grad','like', '%'.$search.'%');
                $titre = "GRAD : ". $search;
                break;
            case 'cord':
                $liste_ens->where('enseignants.corps','like', '%'.$search.'%');
                $titre = "CORD : ". $search;
                break;
            case 'indice':
                $liste_ens->where('enseignants.indice','like', '%'.$search.'%');
                $titre = "INDICE : ". $search;
                break;
            case 'acte':
                $liste_ens->where('enseignants.acte','like', '%'.$search.'%');
                $titre = "ACTE : ". $search;
                break;
             default:
                 # code...
                 break;
         }

         $liste_ens = $liste_ens->paginate(10);
         return view('enseignant.list_print',  ['liste_ens' => $liste_ens ,'titre' => $titre]);


    }



}
