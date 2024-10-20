<?php

namespace App\Http\Controllers;

use App\Models\PlanRealisation;
use App\Http\Requests\StorePlanRealisationRequest;
use App\Http\Requests\UpdatePlanRealisationRequest;
use App\Models\AnneeExercice;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Reponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlanRealisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (isset($_GET['ae'])) {
            $annee_id = $_GET['ae'];
            if ($annee_id != 0) {
                $data = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->get();
            } else {
                $data = Reponse::where('type', '=', 'prevision')->get();
            }
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
            $data = Reponse::where('annee_id', $annee_id)->where('type', '=', 'realisation')->get();
        }

        if (isset($_GET['st'])) {
            $structure_id = $_GET['st'];
            if ($structure_id != 0) {
                $data = $data->where('structure_id', $structure_id);
            } else {
                $data = $data;
            }
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
            $structure_id = 0;
            $data = Reponse::where('annee_id', $annee_id)->where('type', '=', 'realisation')->get();
        }

        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
            if ($type == 'tout') {
                $produits = Produit::all();
            } else {
                if ($type == 'service') {
                    $produits = Produit::where('type', '=', 'Service')->get();
                } else {
                    if ($type == 'bien') {
                        $produits = Produit::where('type', '=', 'Bien')->get();
                    } else {
                        $produits = Produit::where('type', $type)->get();
                    }
                }
            }
        } else {
            $produits = Produit::all();
            $type = "tout";
        }

        if (User::authUserProfil()->nom != 'Administrateur') {
            $user = Auth::user();
            $data = $data->where('structure_id', $user->structure_id);
        }

        //dd($data);

        return view('realisation.index', ['data' => $data, 'ae' => $annee_id, 'type' => $type, 'st' => $structure_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (isset($_GET['ae'])) {
            $annee_id = $_GET['ae'];
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
        }

        $user = Auth::user();
        $reponse = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->where('structure_id', $user->structure_id)->get()->first();
        // $produits = DB::table('produits')
        //     ->selectRaw('liste_produits.*,produits.libelle,produits.type,plan_approvisions.montant_total,plan_approvisions.id as prevision_id')
        //     ->join('liste_produits', 'liste_produits.produit_id', '=', 'produits.id')
        //     ->join('plan_approvisions', 'plan_approvisions.liste_produit_id', '=', 'liste_produits.id')
        //     ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
        //     ->where('liste_produits.annee_id', $annee_id)
        //     ->where('reponses.structure_id', $user->structure_id)
        //     ->where('reponses.id', $reponse->id)
        //     ->get();
        $produits = DB::table('produits')   
            ->selectRaw('produits.*,plan_approvisions.montant_total,plan_approvisions.id as prevision_id')
            ->join('plan_approvisions', 'plan_approvisions.produit_id', '=', 'produits.id')
            ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
            ->where('reponses.annee_id', $reponse->annee_id)
            ->where('reponses.structure_id', $reponse->structure_id)
            ->get();    

        //dd($produits);
        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
            if ($type == 'tout') {
                $produits = $produits;
            } else {
                if ($type == 'service') {
                    $produits = $produits->where('type', '=', 'Service');
                } else {
                    if ($type == 'bien') {
                        $produits = $produits->where('type', '=', 'Bien');
                    } else {
                        $produits = $produits->where('type', $type);
                    }
                }
            }
        } else {
            $produits = $produits;
            $type = "tout";
        }

        //dd($user->structure->phase_struct);
        $phase = $user->structure->phase_struct;
        $reponse = Reponse::where('annee_id', $annee_id)->where('type', '=', 'realisation')->where('structure_id', $user->structure_id)->get()->first();
        //dd($reponse);
        if ($reponse != null) {
            # code...
            $reponse_id = $reponse->id;
        } else {
            $reponse_id = 0;
        }

        $fournisseurs = Fournisseur::all();

        //dd($produits);

        return view('realisation.create', ['ae' => $annee_id, 'type' => $type, 'options' => $produits, 'phase' => $phase, 'reponse_id' => $reponse_id, 'fournisseurs' => $fournisseurs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlanRealisationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //
        $user = Auth::user();
        $structure_id = $user->structure_id;

        //Recuperer l'année
        $annee = AnneeExercice::anneeActive();
        $annee_id = $annee->id;

        $reponse = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->where('structure_id', $user->structure_id)->get()->first();
        // $produits = DB::table('produits')
        //     ->selectRaw('liste_produits.*,produits.libelle,produits.type,plan_approvisions.montant_total,plan_approvisions.id as prevision_id')
        //     ->join('liste_produits', 'liste_produits.produit_id', '=', 'produits.id')
        //     ->join('plan_approvisions', 'plan_approvisions.liste_produit_id', '=', 'liste_produits.id')
        //     ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
        //     ->where('liste_produits.annee_id', $annee_id)
        //     ->where('reponses.structure_id', $user->structure_id)
        //     ->where('reponses.id', $reponse->id)
        //     ->get();
        
        $produits = DB::table('produits')   
            ->selectRaw('produits.*,plan_approvisions.montant_total,plan_approvisions.id as prevision_id')
            ->join('plan_approvisions', 'plan_approvisions.produit_id', '=', 'produits.id')
            ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
            ->where('reponses.annee_id', $reponse->annee_id)
            ->where('reponses.structure_id', $reponse->structure_id)
            ->get();    

        //dd($produits);
        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
            if ($type == 'tout') {
                $produits = $produits;
            } else {
                if ($type == 'service') {
                    $produits = $produits->where('type', '=', 'Service');
                } else {
                    if ($type == 'bien') {
                        $produits = $produits->where('type', '=', 'Bien');
                    } else {
                        $produits = $produits->where('type', $type);
                    }
                }
            }
        } else {
            $produits = $produits;
            $type = "tout";
        }

        $prevision = $request->input('prevision_id');
        $fournisseur = $request->input('fournisseur');
        $montant_total = $request->input('montant_total');
        $montant_local = $request->input('montant_local');
        $fichier = $request->file('fichier');
        //dd($fournisseur);

        //Vérifier si la demande est déja envoyée
        $reponse = Reponse::where('annee_id', $annee->id)
            ->where('structure_id', $structure_id)
            ->where('type', '=', 'realisation')
            ->get()->first();

        if ($reponse == "") {
            $from_data = array(
                'type' => 'realisation',
                'date_debut' => $annee->date_debut_realisation,
                'date_fin' => $annee->date_fin_realisation,
                'envoye' => 0,
                'ouvert' => 1,
                'structure_id' => $structure_id,
                'annee_id' => $annee_id,
            );
            $reponse = Reponse::create($from_data);
        }

        if ($reponse) {
            foreach ($produits as $i => $produit) {

                $fournisseurs = '';
                $checksub = [];
                //dd($fournisseur[$produit->id]);
                if(isset($fournisseur[$produit->id])){
                    if ($fournisseur[$produit->id] != null) {
                        foreach ($fournisseur[$produit->id] as $_subcat) {
                            $checksub[] = $_subcat;
                        }
                        $fournisseurs = implode(';', $checksub);
                    }
                }
                

                if ($fichier != null) {
                    if (isset($fichier[$produit->id])) {
                        //dd($fichier[$produit->id]);
                        $fich = $this->enregisterFichier($request, $fichier[$produit->id]);
                    } else {
                        $fich = "";
                    }
                } else {
                    $fich = "";
                }
                //dd($fichier);
                //dd($fournisseur);
                $resul = PlanRealisation::where('plan_approvision_id', $prevision[$produit->id])
                    ->where('reponse_id', $reponse->id)
                    ->get()->first();

                if ($fich == "") {
                    if ($resul != null) {
                        $fich = $resul->fichier;
                    }
                }
                $data = array(
                    'plan_approvision_id' => $prevision[$produit->id],
                    'fournisseur_id' => 0,
                    'fournisseurs' => $fournisseurs,
                    'reponse_id' => $reponse->id,
                    'montant_total' => $montant_total[$produit->id],
                    'montant_local' => $montant_local[$produit->id],
                    'fichier' => $fich
                );

                if ($resul != null) {
                    PlanRealisation::where('id', $resul->id)->update($data);
                } else {
                    PlanRealisation::create($data);
                }
            }
        }

        return redirect(route('approvisions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanRealisation  $planRealisation
     * @return \Illuminate\Http\Response
     */
    public function show(PlanRealisation $planRealisation)
    {
        //
        $produits = DB::table('produits')
            ->select('plan_approvisions.*', 'liste_produits.produit_id', 'produits.libelle', 'produits.type')
            ->join('liste_produits', 'liste_produits.produit_id', '=', 'produits.id')
            ->join('plan_approvisions', 'plan_approvisions.liste_produit_id', '=', 'liste_produits.id')
            ->where('liste_produits.annee_id', $reponse->annee_id)
            ->where('plan_approvisions.reponse_id', $reponse->id)
            ->get();

        //dd($produits);
        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
            if ($type == 'tout') {
                $produits = $produits;
            } else {
                if ($type == 'service') {
                    $produits = $produits->where('type', '=', 'Service');
                } else {
                    if ($type == 'bien') {
                        $produits = $produits->where('type', '=', 'Bien');
                    } else {
                        $produits = $produits->where('type', $type);
                    }
                }
            }
        } else {
            $produits = $produits;
            $type = "tout";
        }
        $user = Auth::user();
        //dd($user->structure->phase_struct);
        $phase = $user->structure->phase_struct;
        //$reponse = Reponse::where('annee_id', $annee_id)->where('structure_id', $user->structure_id)->get()->first();
        //dd($reponse);
        if ($reponse != null) {
            # code...
            $reponse_id = $reponse->id;
        } else {
            $reponse_id = 0;
        }

        //dd($produits);

        return view('reponse.show', ['ae' => $reponse->annee_id, 'type' => $type, 'options' => $produits, 'phase' => $phase, 'reponse_id' => $reponse_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanRealisation  $planRealisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reponse $reponse)
    {
        //
        return view('realisation.edit', ['reponse' => $reponse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlanRealisationRequest  $request
     * @param  \App\Models\PlanRealisation  $planRealisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reponse $reponse)
    {
        //
        //
        $validator = Validator::make($request->all(), [
            'date_reouverture_realisation' => 'required',
        ]);
        //dd($request->all());

        if ($validator->fails()) {
            return redirect(route('approvisions.edit', $reponse))
                ->withErrors($validator)
                ->withInput();
        } else {
            $input = array(
                'date_reouverture' =>  $request->date_reouverture,
                'ouvert'   =>  true,
            );
            //$input = $request->all();
            $reponse->update($input);

            return redirect(route('approvisions.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanRealisation  $planRealisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanRealisation $planRealisation)
    {
        //
    }

    public function getListe(Request $request)
    {
        if (isset($_GET['ae'])) {
            $annee_id = $_GET['ae'];
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
        }

        $reponses = Reponse::where('annee_id', $annee_id)->where('type', '=', 'realisation')->get();

        return view('reponse.table')
            ->with('data', $reponses)->with('ae', $annee_id);
    }

    public function envoyerListe($id)
    {
        //
        $input = array(
            'envoye'   =>  true,
        );
        //$input = $request->all();
        $reponse = Reponse::where('id', $id)->update($input);

        return redirect(route('approvisions.index'));
    }
}
