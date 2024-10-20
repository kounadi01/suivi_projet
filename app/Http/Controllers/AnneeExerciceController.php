<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnneeExerciceRequest;
use App\Models\AnneeExercice;
use App\Models\Reponse;
use App\Models\Structure;
use Illuminate\Http\Request;

use Validator;

class AnneeExerciceController extends Controller
{
    public function index()
    {
        $annee_exercices = AnneeExercice::all();
        return view('annee-exercices.index_annee_exercices', ['annee_exercices' => $annee_exercices]);
    }

    public function create()
    {
        return view('annee-exercices.create');
    }


    public function store(CreateAnneeExerciceRequest $request)
    {
        $input = $request->all();

        $annee = AnneeExercice::create($input);

        $structures = Structure::where('type_struct', '!=', 'Etat')->get();

        foreach ($structures  as $index => $structure) {
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
        }

        return redirect(route('annee-exercices.index'));
    }

    public function getListe(Request $request)
    {
        $annee_exercices = AnneeExercice::all();

        return view('annee-exercices.table')
            ->with('annee_exercices', $annee_exercices);
    }

    public function activer($id)
    {
        $annee_exercice = AnneeExercice::find($id);

        $annee_actives = AnneeExercice::where('statut', "active")->get();
        $nb_annee_active = $annee_actives->count();
        if ($nb_annee_active >= 1) {
            return response()->json([
                'erreur' => "Beaucoup d'année active",
            ], 422);
        }
        $annee_exercice->statut = "active";
        $annee_exercice->save();

        return response()->json();
    }

    public function cloturer($id)
    {
        $annee_exercice = AnneeExercice::find($id);

        $annee_exercice->statut = "clôturée";
        $annee_exercice->save();
        return response()->json();
    }
    public function show(AnneeExercice $annee_exercice)
    {
        $view = view('annee-exercices.show');

        $view->with('annee_exercice', $annee_exercice);

        return $view;
    }

    public function edit(AnneeExercice $annee_exercice)
    {
        return view('annee-exercices.edit', ['annee_exercice' => $annee_exercice]);
    }


    public function update(Request $request, AnneeExercice $annee_exercice)
    {
        $validated = $request->validate([
            'annee_exercice' => 'required|unique:annee_exercices,annee_exercice,' . $annee_exercice->id
        ]);
        $annee_exercice->update($request->all());

        return redirect(route('annee-exercices.index'));
    }


    public function destroy($id)
    {
        $result = AnneeExercice::destroy($id);

        return redirect(route('annee-exercices.index'));
    }
}
