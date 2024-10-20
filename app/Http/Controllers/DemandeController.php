<?php

namespace App\Http\Controllers;

use App\Models\AnneeExercice;
use App\Models\Demande;
use App\Models\Produit;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produits = Produit::all()->pluck('libelle','id');
        $structure_id = Auth::user()->structure_id;
        $annee_active = AnneeExercice::anneeActive()->id;
        $annees = AnneeExercice::orderBy('annee_exercice')->get()->pluck('annee_exercice','id');

        if (User::authUserProfil()->nom != 'Administrateur') {
            $structures = Structure::where('id',$structure_id)->pluck('nom_struct','id');
            $demandes = Demande::where('structure_id',$structure_id)->get();
        }else{
            $structures = Structure::where('type_struct','!=','Etat')->pluck('nom_struct','id');
            $demandes = Demande::all();
        }


        return view('demande.index', ['demandes' => $demandes,'structures' => $structures,'structure_id' => $structure_id,'produits' => $produits,'annees' => $annees,'annee_active' => $annee_active]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $produits = Produit::all()->pluck('libelle','id');
        $structure_id = Auth::user()->structure_id;
        $annee_active = AnneeExercice::anneeActive()->id;
        $annees = AnneeExercice::orderBy('annee_exercice')->get()->pluck('annee_exercice','id');

        if (User::authUserProfil()->nom != 'Administrateur') {
            $structures = Structure::where('id',$structure_id)->pluck('nom_struct','id');
        }else{
            $structures = Structure::where('type_struct','!=','Etat')->pluck('nom_struct','id');
        }
        return view('demande.create',['structures' => $structures,'produits' => $produits,'annee_active' => $annee_active,'annees' => $annees,'structure_id' => $structure_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'structure_id' => 'required',
            'annee_id' => 'required',
            'produit_id' => 'required',
            // 'fichier' => 'required',
            'type' => 'required',
            'montant_total' => 'required',
            'montant_local' => 'required'
        ]);

        // dd($request->all());
        if ($validator->fails()) {
            return response()->json([
                'erreur' => 'Données incohérentes',
            ], 422);
        } else {
            $input = $request->structure_id;
            //dd($request->structure_id);
            $fichier = $this->enregisterFichier($request, 'fichier');

            $data = array([
                'structure_id' => $request->structure_id,
                'annee_id' => $request->annee_id,
                'produit_id' => $request->produit_id,
                'fichier' => $fichier,
                'type' => $request->type,
                'montant_total' => $request->montant_total,
                'montant_local' => $request->montant_local
            ]);

            // dd($data);

            Demande::create([
                'structure_id' => $request->structure_id,
                'annee_id' => $request->annee_id,
                'produit_id' => $request->produit_id,
                'fichier' => $fichier,
                'type' => $request->type,
                'montant_total' => $request->montant_total,
                'montant_local' => $request->montant_local
            ]);

            return redirect(route('demandes.index'))->with("statut", "La demande  a bien été ajoutée avec succés");;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function show(Demande $demande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function edit(Demande $demande)
    {
        //
        $produits = Produit::all()->pluck('libelle','id');
        $structure_id = $demande->structure_id;
        $annee_active = $demande->annee_id;
        $annees = AnneeExercice::orderBy('annee_exercice')->get()->pluck('annee_exercice','id');

        if (User::authUserProfil()->nom != 'Administrateur') {
            $structures = Structure::where('id',$structure_id)->pluck('nom_struct','id');
        }else{
            $structures = Structure::where('type_struct','!=','Etat')->pluck('nom_struct','id');
        }
        return view('demande.edit', ['demande' => $demande,'annees' => $annees,'produits' => $produits,'structures' => $structures,'annee_active' => $annee_active,'structure_id' => $structure_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demande $demande)
    {
        //
        $validator = Validator::make($request->all(), [
            'structure_id' => 'required',
            'annee_id' => 'required',
            'produit_id' => 'required',
            'fichier' => 'required',
            'type' => 'required',
            'montant_total' => 'required',
            'montant_local' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'erreur' => 'Données incohérentes',
            ], 422);
        } else {
            $input = $request->all();

            $demande->update($input);

            return redirect(route('demandes.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $result = Demande::destroy($id);

        return redirect(route('demandes.index'));
    }

    public function getListe(Request $request)
    {
        
        if (User::authUserProfil()->nom != 'Administrateur') {
            $structure_id = Auth::user()->structure_id;
            $demandes = Demande::where('structure_id',$structure_id)->get();
        }else{
            $demandes = Demande::all();
        }

        return view('demande.table')
            ->with('demandes', $demandes);
    }

    public function valider($id)
    {
        //
        $demande = Demande::where('id',$id)->get()->first();

        if ($demande != "") {
            # code...
            if ($demande->refuse == 0) {
                $demande->update(['accepte' => 1]);
            }else{
                $demande->update(['refuse' => 0]);
            }
        }

        return redirect(route('demandes.index'));
    }

    public function rejeter($id)
    {
        //
        $demande = Demande::where('id',$id)->get()->first();

        if ($demande != "") {
            $demande->update(['accepte' => 0,'refuse' => 1]);
        }

        return redirect(route('demandes.index'));

    }
}
