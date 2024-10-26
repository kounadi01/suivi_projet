<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Http\Requests\StoreProjetRequest;
use App\Http\Requests\UpdateProjetRequest;
use App\Models\AnneeExercice;
use App\Models\Bailleur;
use App\Models\Composante;
use App\Models\Coordonateur;
use App\Models\Fournisseur;
use App\Models\Phase;
use App\Models\Realisation;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['ae'])) {
            $annee_id = $_GET['ae'];
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
        }

        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
        }else{
            $type = "tout";
        }
        $projets = Projet::all();
        //dd($projets);
        return view('projets.index', ['projets' => $projets, 'ae' => $annee_id,'type' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $societes = Societe::pluck('libelle', 'id');
            $natures = Phase::pluck('libelle', 'id');
            $bailleurs = Bailleur::selectRaw("CONCAT(nom, ' (', sigle, ')') as nom_complet, id")->pluck('nom_complet', 'id');
            $entreprises = Fournisseur::pluck('nom', 'id');
            $composantes = Composante::pluck('libelle', 'id');
            $coordonnateurs = Coordonateur::selectRaw("CONCAT(nom, ' ', prenom) as nom_complet, id")->pluck('nom_complet', 'id');
        } catch (\Exception $e) {
            return redirect()->back();
        }


        return view('projets.create', compact('societes', 'natures', 'bailleurs', 'entreprises', 'composantes', 'coordonnateurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjetRequest $request)
    {

        $annee = AnneeExercice::where('statut', '=', 'active')->first();

        if ($annee == NULL) {
            return redirect()->route('projets.index')->with("statut", "Echec! Créer une année active d'abord");
        }

        // Ajouter l'année active à la requête avant la création du projet
        $data = $request->except(['composantes', 'coordonnateur']);
        $data['idAnn'] = $annee->id; // Ajouter l'ID de l'année d'exercice active

        // Créer le projet avec les données, y compris l'année d'exercice
        if ($projet = Projet::create($data)) {
            // Attacher les composantes (many-to-many)
            $projet->composantes()->sync($request->composantes);

            $projet->coordonnateurs()->sync([
                $request->coordonnateur => [
                    'date_debut' => $request->date_demarrage,
                    'date_fin' => $request->date_fin_probable
                ]
            ]);

            if ($request->taux_financier != 0 || $request->taux_physique != 0) {
                # code...
                Realisation::create([
                    'taux_financier'=>$request->taux_financier,
                    'taux_physique'=>$request->taux_physique,
                    'etat_execution'=>$request->statut,
                    'difficultes'=>$request->difficultes,
                    'action'=>$request->action,
                    'idProj'=>$projet->id,
                    'date_execution'=>date('Y-m-d')
                ]);
            }

            return redirect()->route('projets.index')->with("statut", "Le projet a été ajouté avec succès");
        }

        return redirect()->route('projets.index')->with("statut", "Echec de la création du projet");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function show(Projet $projet)
    {
        //
        try {
            // dd($projet->realisations);
            $societes = Societe::pluck('libelle', 'id');
            $natures = Phase::pluck('libelle', 'id');
            $bailleurs = Bailleur::selectRaw("CONCAT(nom, ' (', sigle, ')') as nom_complet, id")->pluck('nom_complet', 'id');
            $entreprises = Fournisseur::pluck('nom', 'id');
            $composantes = Composante::pluck('libelle', 'id');
            $coordonnateurs = Coordonateur::selectRaw("CONCAT(nom, ' ', prenom) as nom_complet, id")->pluck('nom_complet', 'id');
        } catch (\Exception $e) {
            return redirect()->back();
        }


        return view('projets.show', compact('projet', 'societes', 'natures', 'bailleurs', 'entreprises', 'composantes', 'coordonnateurs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function edit(Projet $projet)
    {
        try {
            $societes = Societe::pluck('libelle', 'id');
            $natures = Phase::pluck('libelle', 'id');
            $bailleurs = Bailleur::selectRaw("CONCAT(nom, ' (', sigle, ')') as nom_complet, id")->pluck('nom_complet', 'id');
            $entreprises = Fournisseur::pluck('nom', 'id');
            $composantes = Composante::pluck('libelle', 'id');
            $coordonnateurs = Coordonateur::selectRaw("CONCAT(nom, ' ', prenom) as nom_complet, id")->pluck('nom_complet', 'id');
        } catch (\Exception $e) {
            return redirect()->back();
        }


        return view('projets.edit', compact('projet', 'societes', 'natures', 'bailleurs', 'entreprises', 'composantes', 'coordonnateurs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjetRequest  $request
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjetRequest $request, Projet $projet)
    {

        // Mettre à jour le projet
        if ($projet->update($request->except(['composantes', 'coordonnateur']))) {

            // Mettre à jour les composantes (many-to-many)
            $projet->composantes()->sync($request->composantes);

            // Récupérer le coordonnateur actuel
            $ancienCoordonnateur = $projet->coordonnateurs()->first();

            if ($ancienCoordonnateur) {
                // Mettre à jour la date de fin de l'ancien coordonnateur dans la table pivot
                $projet->coordonnateurs()->updateExistingPivot($ancienCoordonnateur->id, [
                    'date_fin' => now()
                ]);
            }

            // Ajouter le nouveau coordonnateur avec la date_debut et la date_fin
            $projet->coordonnateurs()->attach($request->coordonnateur, [
                'date_debut' => now(),
                'date_fin' => $request->date_fin_probable
            ]);

            return redirect()->route('projets.index')->with("statut", "Le projet a été modifié avec succès");
        }

        return redirect()->route('projets.index')->with("statut", "Echec de la modification du projet");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Supprimer le projet
        Projet::destroy($id);
        return redirect()->route('projets.index')->with("statut", "Le projet a été supprimé avec succès");
    }

    public function getListe(Request $request)
    {
        $projets = Projet::all();
        return view('projets.table')->with('projets', $projets);
    }
    public function evaluation($id)
    {
        $projet = Projet::where('id',$id)->get()->first();
        return view('projets.evaluer', ['projet' => $projet]);
    }

    public function evaluer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'taux_physique' => 'required',
            'taux_financier' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'erreur' => 'Données incohérentes',
            ], 422);
        } else {
            $input = $request->all();
            //var_dump($input);
            $projet = Projet::where('id',$request->id)->update([
                "taux_physique" => $request->taux_physique,
                "taux_financier" => $request->taux_financier,
                "difficultes" => $request->difficultes,
                "action" => $request->action,
                "statut" => $request->statut
            ]);
            if($projet){
                Realisation::create([
                    'taux_financier'=>$request->taux_financier,
                    'taux_physique'=>$request->taux_physique,
                    'etat_execution'=>$request->statut,
                    'difficultes'=>$request->difficultes,
                    'action'=>$request->action,
                    'idProj'=>$request->id,
                    'date_execution'=>$request->date_execution
                ]);
            }

            return redirect(route('projets.index'));
        }
    }

}
