<?php

namespace App\Http\Controllers;

use App\Models\PlanApprovision;
use App\Http\Requests\StorePlanApprovisionRequest;
use App\Http\Requests\UpdatePlanApprovisionRequest;
use App\Models\AnneeExercice;
use App\Models\Produit;
use App\Models\Reponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanApprovisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlanApprovisionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        //dd($request->all());
        //User connecté
        $user = Auth::user();
        $structure_id = $user->structure_id;

        //Recuperer l'année
        $annee = AnneeExercice::where('id', $_GET['ae'])
            ->get()->first();

        //Vérifier si la demande est déja envoyée
        $reponse = Reponse::where('annee_id', $_GET['ae'])
            ->where('structure_id', $structure_id)
            ->where('type', '=', 'prevision')
            ->get()->first();

        if ($reponse == "") {
            $from_data = array(
                'type' => 'prevision',
                'date_debut' => $annee->date_debut_prevision,
                'date_fin' => $annee->date_fin_prevision,
                'envoye' => 0,
                'ouvert' => 1,
                //'date_reouverture' => '',
                'structure_id' => $structure_id,
                'annee_id' => $_GET['ae'],
            );
            $reponse = Reponse::create($from_data);
        }

        if ($reponse) {
            // Récupérer les données JSON
            $data = json_decode(file_get_contents('php://input'), true);
            //$data = $request->all();
            //dd($data);

            foreach ($data as $row) {
                $from_data = array(
                    'liste_produit_id'  =>  $row['liste_produit_id'],
                    'produit_id'  =>  $row['produit_id'],
                    'reponse_id'   =>  $reponse->id,
                    'montant_total'   =>  $row['montant_total'],
                    'taux'   =>  $row['taux'],
                    'montant_local'   =>  $row['montant_local'],
                );
                if ($row['montant_total'] != null) {
                    try {
                        //code...
                        $result = PlanApprovision::where('reponse_id', $reponse->id)
                            ->where('produit_id', $row['produit_id'])->get()->first();
                        if ($result != null) {
                            $result->update($from_data);
                        } else {
                            PlanApprovision::create($from_data);
                        }
                    } catch (\Throwable $th) {
                        //throw $th;
                        \Session::flash('warning', 'L\'enregistrement a échoué');
                    }
                }
            }
        } else {
            \Session::flash('warning', 'L\'enregistrement a échoué');
        }

        // $lignes = LigneCommande::all();
        // return view('admin.ligne.index', compact('lignes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanApprovision  $planApprovision
     * @return \Illuminate\Http\Response
     */
    public function show(PlanApprovision $planApprovision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanApprovision  $planApprovision
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanApprovision $planApprovision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlanApprovisionRequest  $request
     * @param  \App\Models\PlanApprovision  $planApprovision
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanApprovisionRequest $request, PlanApprovision $planApprovision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanApprovision  $planApprovision
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanApprovision $planApprovision)
    {
        //
    }
}
