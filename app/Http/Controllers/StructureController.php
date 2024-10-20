<?php

namespace App\Http\Controllers;

use App\Http\Requests\StructureRequest;
use App\Models\AnneeExercice;
use App\Models\Reponse;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class StructureController extends Controller
{
    public function index()
    {
        $structures = Structure::all();

        return view('structures.index_structure',['structures' => $structures]);
    }

    public function create()
    {
        return view('structures.create');
    }

    public function store(StructureRequest $request)
    {
        $input = $request->all();
        $annee = AnneeExercice::where('statut', '=', 'active')->get()->first();

        if ($structure = Structure::create($input)){
            $from_data_prevision = array(
                'type' => 'prevision',
                'date_debut' => $annee->date_debut_prevision,
                'date_fin' => $annee->date_fin_prevision,
                'envoye' => 0,
                'ouvert' => 1,
                //'date_reouverture' => '',
                'structure_id' => $structure->id,
                'annee_id' => $annee->id,
            );
            Reponse::create($from_data_prevision);

            $from_data_realisation = array(
                'type' => 'realisation',
                'date_debut' => $annee->date_debut_realisation,
                'date_fin' => $annee->date_fin_realisation,
                'envoye' => 0,
                'ouvert' => 1,
                //'date_reouverture' => '',
                'structure_id' => $structure->id,
                'annee_id' => $annee->id,
            );
            Reponse::create($from_data_realisation);
            return redirect()->route("structures.index")->with("statut", "La structure  a bien été ajoutée avec succés");

        }
        return redirect()->route("structures.index")->with("statut", "Echec de l'ajout de la structure ");
//        return redirect(route('structures.index'));
    }

    public function getListe(Request $request) 
    {
        $structures = Structure::all();

        return view('structures.table')
            ->with('structures', $structures);
    }

    public function show(Structure $structure)
    {
        $view = view('structures.show');
        
            $view->with('structure',$structure);
     
        return $view;
    }

    public function edit(Structure $structure)
    {
        return view('structures.edit')->with('structure',$structure);
    }

    public function update(Request $request, Structure $structure)
    {
        $validated = $request->validate([
            'nom_struct' => 'required',
            'sigle_struct' =>'nullable',
            'type_struct' => 'required',
            'tel_struct' =>'required',
            'email_struct' =>'required',
            'responsable_struct' => 'required'
        ]);


        if ($structure->update($request->all())){
            return redirect()->route("structures.index")->with("statut", "La structure  a  été modifiée avec succés");

        }
        return redirect()->route("structures.index")->with("statut", "Echec de modification de la structure ");

    }

    public function destroy($id)
    {
        $result = Structure::destroy($id);
       
        return redirect(route('structures.index'));
    }

    public function getStructuresListeByAnnee($annee_id)
    {
        $structures = DB::table('structures')
            ->join('previsions', 'structures.id', '=', 'previsions.structure_id')
            ->join('annee_exercices', 'annee_exercices.id', '=', 'previsions.annee_id')
            ->select('structures.id','structures.nom_struct')
            ->where('annee_exercices.id',$annee_id)
            ->get();
        $structures = $structures->unique('id');    
        return $structures;
        //return view('previsions.index',['structures' => $structures]);
    }
}
