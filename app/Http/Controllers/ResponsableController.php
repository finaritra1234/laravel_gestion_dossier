<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsable;
use Session;
class ResponsableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function responsable()
    {
        //liste Responsable
        $liste_resp =  Responsable::paginate(10);

        return view('Responsable.list',  ['liste_resp' => $liste_resp]);
    }

    public function add(Request $request)
    {
            //validation
            $this->validate($request,[
                'nom' => 'required|string',
                'desc' => 'required|string',

            ],[
                'nom.required' => 'Champ obligatoire',
                'desc.required' => 'Champ obligatoire',

            ]);

            //creer Responsable
            Responsable::create([
                'nom' => $request->nom,
                'desc' => $request->desc,

            ]);
            Session::flash('success', 'Ajout avec succes!!!');
            return redirect()->back();

    }

    public function edit($id)
    {
         //liste Responsable
         $liste_resp =  Responsable::paginate(10);
        $respl = Responsable::find($id);

        return view('Responsable.edit',[
            'resp' => $respl,
            'liste_resp' => $liste_resp
        ]);

    }
    public function update(Request $request, $id)
    {
            //validation
            $this->validate($request,[
                'nom' => 'required|string',
                'desc' => 'required|string',

            ],[
                'nom.required' => 'Champ obligatoire',
                'desc.required' => 'Champ obligatoire',

            ]);

           $respl = Responsable::find($id);
           $respl->nom = $request->nom;
           $respl->desc = $request->desc;
           $respl->update();
            Session::flash('success', 'Modification avec succes!!!');
            return redirect()->back();

    }
    public function delete($id)
    {
        Responsable::find($id)->delete();
        Session::flash('success', 'Suppression avec succes!!!');
        return redirect()->back();

    }



}
