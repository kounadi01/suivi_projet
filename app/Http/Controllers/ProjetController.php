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
use App\Models\Societe;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projets = Projet::all();
        //dd($projets);
        return view('projets.index', ['projets' => $projets]);
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
            $coordonnateurs = Coordonateur::pluck('nom', 'id');
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

         if($annee == NULL){
            return redirect()->route('projets.index')->with("statut", "Echec! Créer une année active d'abord");
         }
         
         // Ajouter l'année active à la requête avant la création du projet
         $data = $request->except(['composantes', 'coordonnateur']);
         $data['idAnn'] = $annee->id; // Ajouter l'ID de l'année d'exercice active
         
         // Créer le projet avec les données, y compris l'année d'exercice
         if ($projet = Projet::create($data)){
            // Attacher les composantes (many-to-many)
            $projet->composantes()->sync($request->composantes);
            
            $projet->coordonnateurs()->sync([
                $request->coordonnateur => [
                    'date_debut' => $request->date_demarrage,
                    'date_fin' => $request->date_fin_probable
                ]
            ]);

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
            $coordonnateurs = Coordonateur::pluck('nom', 'id');
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
        if($projet->update($request->except(['composantes', 'coordonnateur']))){

        // Mettre à jour les composantes (many-to-many)
            $projet->composantes()->sync($request->composantes);

            // Mettre à jour le coordonnateur via la table pivot (many-to-many)
            $projet->coordonnateurs()->sync([$request->coordonnateur]);

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

}
