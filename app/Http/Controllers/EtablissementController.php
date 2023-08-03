<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use Session;
class EtablissementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }
   
    public function etablissement()
    {
        //liste etablissement 
        $liste_etab =  Etablissement::paginate(10);

        return view('etablissement.list',  ['liste_etab' => $liste_etab]);
    }

    public function add(Request $request) 
    {
            //validation
            $this->validate($request,[
                'cisco' => 'required|string',
                'nom_etabl' => 'required|string',
                'adresse_etabl' => 'required|string'
            ],[
                'cisco.required' => 'Champ obligatoire',
                'nom_etabl.required' => 'Champ obligatoire',
                'adresse_etabl.required' => 'Champ obligatoire',
            
            ]);

            //creer etablissement
            Etablissement::create([
                'cisco' => $request->cisco,
                'nom_etabl' => $request->nom_etabl,
                'adresse_etabl' => $request->adresse_etabl,
                
            ]);
            Session::flash('success', 'Etablissement ajouté avec succes!!!');
            return redirect()->back();
        
    }

    public function edit($id) 
    {   
         //liste etablissement 
         $liste_etab =  Etablissement::paginate(10);
        $etabl = Etablissement::find($id);
            
        return view('etablissement.edit',[
            'etabl' => $etabl, 
            'liste_etab' => $liste_etab
        ]);
        
    }
    public function update(Request $request, $id) 
    {
            //validation
            $this->validate($request,[
                'cisco' => 'required|string',
                'nom_etabl' => 'required|string',
                'adresse_etabl' => 'required|string'
            ],[
                'cisco.required' => 'Champ obligatoire',
                'nom_etabl.required' => 'Champ obligatoire',
                'adresse_etabl.required' => 'Champ obligatoire',
            
            ]);

           $etabl = Etablissement::find($id);
           $etabl->cisco = $request->cisco;
           $etabl->nom_etabl = $request->nom_etabl;
           $etabl->adresse_etabl = $request->adresse_etabl;
           $etabl->update();
            Session::flash('success', 'Etablissement modifié avec succes!!!');
            return redirect()->back();
        
    }
    public function delete($id) 
    {
        Etablissement::find($id)->delete();
        Session::flash('success', 'Etablissement supprimé avec succes!!!');
            return redirect()->back();
        
    }

   

}
