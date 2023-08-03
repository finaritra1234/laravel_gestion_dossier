<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dossier;
use Session;
class DossierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function dossier()
    {
        //liste Dossier
        $liste_doss =  Dossier::paginate(10);

        return view('dossier.list',  ['liste_doss' => $liste_doss]);
    }

    public function add(Request $request)
    {
            //validation
            $this->validate($request,[
                'type_dossier' => 'required|string',


            ],[
                'type_dossier.required' => 'Champ obligatoire',



            ]);

            //creer Dossier
            Dossier::create([
                'type_dossier' => $request->type_dossier,
                'nb_dossier' => 1,


            ]);
            Session::flash('success', 'Dossier ajouté avec succes!!!');
            return redirect()->back();

    }

    public function edit($id)
    {
        //liste Dossier
        $liste_doss =  Dossier::paginate(10);
        $doss = Dossier::find($id);

        return view('dossier.edit',[
            'doss' => $doss,
            'liste_doss' => $liste_doss
        ]);

    }
    public function update(Request $request, $id)
    {
            //validation
            $this->validate($request,[
                'type_dossier' => 'required|string',
                'nb_dossier' => 'required|string',

            ],[
                'type_dossier.required' => 'Champ obligatoire',
                'nb_dossier.required' => 'Champ obligatoire',


            ]);

           $doss = Dossier::find($id);
           $doss->type_dossier = $request->type_dossier;


           $doss->update();
            Session::flash('success', 'Dossier modifié avec succes!!!');
            return redirect()->back();

    }
    public function delete($id)
    {
        Dossier::find($id)->delete();
        Session::flash('success', 'Dossier supprimé avec succes!!!');
            return redirect()->back();

    }



}
