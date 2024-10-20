<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Http\Requests\StoreReponseRequest;
use App\Http\Requests\UpdateReponseRequest;
use App\Models\AnneeExercice;
use App\Models\Fournisseur;
use App\Models\ListeProduit;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ReponseController extends Controller
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
            $data = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->get();
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
            $data = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->get();
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
        foreach ($data as $reponse) {
            Reponse::controleReponse($reponse->id);
        }

        //dd( $annee_id);

        return view('reponse.index', ['data' => $data, 'ae' => $annee_id, 'type' => $type, 'st' => $structure_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //dd();
        if (isset($_GET['ae'])) {
            $annee_id = $_GET['ae'];
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
        }

        $produits = DB::table('produits')
            ->select('liste_produits.*', 'produits.libelle', 'produits.type')
            ->join('liste_produits', 'liste_produits.produit_id', '=', 'produits.id')
            ->where('liste_produits.annee_id', $annee_id)
            ->get();

        //dd($produits);
        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
            if ($type == 'tout') {
                $produits = DB::table('produits')
                    ->select('liste_produits.*', 'produits.libelle')
                    ->join('liste_produits', 'liste_produits.produit_id', '=', 'produits.id')
                    ->where('liste_produits.annee_id', $annee_id)
                    ->get();
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
        $reponse = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->where('structure_id', $user->structure_id)->get()->first();
        //dd($reponse);
        if ($reponse != null) {
            # code...
            $reponse_id = $reponse->id;
        } else {
            $reponse_id = 0;
        }

        //dd($produits);
        if ($type == 'tout') {
            # code...
            $autresProduits = Produit::where('decret', '=', 0)->get();
        } else {
            $autresProduits = Produit::where('decret', '=', 0)->where('type', $type)->get();
        }

        return view('reponse.create', ['ae' => $annee_id, 'type' => $type, 'options' => $produits, 'phase' => $phase, 'reponse_id' => $reponse_id, 'autresOptions' => $autresProduits]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReponseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'structure_id' => 'required',
            'annee_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('reponses.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $input = $request->all();

            Reponse::create($input);

            return redirect(route('reponses.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function show(Reponse $reponse)
    {
        //
        //dd($reponse);
        $autresProduits = DB::table('produits')
            ->selectRaw('produits.*,plan_approvisions.montant_total,plan_approvisions.id as prevision_id')
            ->join('plan_approvisions', 'plan_approvisions.produit_id', '=', 'produits.id')
            ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
            ->where('produits.decret', '=', 0)
            ->where('reponses.annee_id', $reponse->annee_id)
            ->where('reponses.structure_id', $reponse->structure_id)
            ->get();
        //dd($autresProduits);
        $annee = AnneeExercice::where('id', $reponse->annee_id)->get()->first();

        if ($_GET['option'] == 'prevision') {
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
                    $autresProduits = $autresProduits;
                } else {
                    if ($type == 'service') {
                        $produits = $produits->where('type', '=', 'Service');
                        $autresProduits = $autresProduits->where('type', '=', 'Service');
                    } else {
                        if ($type == 'bien') {
                            $produits = $produits->where('type', '=', 'Bien');
                            $autresProduits = $autresProduits->where('type', '=', 'Bien');
                        } else {
                            $produits = $produits->where('type', $type);
                            $autresProduits = $autresProduits->where('type', $type);
                        }
                    }
                }
            } else {
                $produits = $produits;
                $autresProduits = $autresProduits;
                $type = "tout";
            }
            $user = Auth::user();
            //dd($user->structure->phase_struct);
            $phase = $user->structure->phase_struct;

            if ($reponse != null) {
                # code...
                $reponse_id = $reponse->id;
            } else {
                $reponse_id = 0;
            }

            return view('reponse.show', ['ae' => $reponse->annee_id, 'type' => $type, 'options' => $produits, 'phase' => $phase, 'reponse_id' => $reponse_id, 'annee' => $annee, 'autresProduits' => $autresProduits]);
        } else {

            $produits = DB::table('produits')
                ->selectRaw('produits.*,plan_approvisions.montant_total,plan_approvisions.id as prevision_id')
                //->join('liste_produits', 'liste_produits.produit_id', '=', 'produits.id')
                ->join('plan_approvisions', 'plan_approvisions.produit_id', '=', 'produits.id')
                ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
                ->where('reponses.annee_id', $reponse->annee_id)
                ->where('reponses.structure_id', $reponse->structure_id)
                //->where('reponses.id', $reponse->id)
                ->get();
            //dd($produits);

            $annee_id = $reponse->annee_id;

            //dd($produits);
            if (isset($_GET['ty'])) {
                $type = $_GET['ty'];
                if ($type == 'tout') {
                    $produits = $produits;
                    $autresProduits = $autresProduits;
                } else {
                    if ($type == 'service') {
                        $produits = $produits->where('type', '=', 'Service');
                        $autresProduits = $autresProduits->where('type', '=', 'Service');
                    } else {
                        if ($type == 'bien') {
                            $produits = $produits->where('type', '=', 'Bien');
                            $autresProduits = $autresProduits->where('type', '=', 'Bien');
                        } else {
                            $produits = $produits->where('type', $type);
                            $autresProduits = $autresProduits->where('type', $type);
                        }
                    }
                }
            } else {
                $produits = $produits;
                $autresProduits = $autresProduits;
                $type = "tout";
            }

            //dd($produits);
            if (isset($_GET['ca'])) {
                $categorie = $_GET['ca'];
                if ($categorie == 'tout') {
                    $produits = $produits;
                } else {
                    if ($categorie == 'oui') {
                        $produits = $produits->where('decret', '=', 1);
                    } else {
                        if ($categorie == 'non') {
                            $produits = $produits->where('decret', '=', 0);
                        } else {
                            $produits = $produits->where('decret', $categorie);
                        }
                    }
                }
            } else {
                $produits = $produits;
                $categorie = "tout";
            }

            //dd($user->structure->phase_struct);
            $phase = $reponse->structure->phase_struct;
            $reponse = Reponse::where('annee_id', $annee_id)->where('type', '=', 'realisation')->where('structure_id', $reponse->structure_id)->get()->first();
            //dd($reponse);
            if ($reponse != null) {
                # code...
                $reponse_id = $reponse->id;
            } else {
                $reponse_id = 0;
            }

            $fournisseurs = Fournisseur::all();

            return view('realisation.show', ['ae' => $annee_id, 'type' => $type, 'options' => $produits, 'phase' => $phase, 'reponse_id' => $reponse_id, 'fournisseurs' => $fournisseurs, 'annee' => $annee, 'autresProduits' => $autresProduits, 'categorie' => $categorie]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function edit(Reponse $reponse)
    {
        //
        $option = $_GET['option'];
        return view('reponse.edit', ['reponse' => $reponse, 'option' => $option]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReponseRequest  $request
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reponse $reponse)
    {
        //
        $validator = Validator::make($request->all(), [
            'date_reouverture' => 'required',
        ]);
        //dd($request->all());

        if ($validator->fails()) {
            return redirect(route('reponses.edit', $reponse))
                ->withErrors($validator)
                ->withInput();
        } else {
            $input = array(
                'date_reouverture' =>  $request->date_reouverture,
                'ouvert'   =>  true,
            );
            //$input = $request->all();
            $reponse->update($input);

            if ($_GET['option'] == 'prevision') {
                return redirect(route('reponses.index'));
            } else {
                return redirect(route('approvisions.index'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reponse $reponse)
    {
        //
    }

    public function envoyerListe($id)
    {
        //
        $input = array(
            'envoye'   =>  true,
        );
        //$input = $request->all();
        $reponse = Reponse::where('id', $id)->update($input);

        if ($_GET['option'] == 'prevision') {
            return redirect(route('reponses.index'));
        } else {
            return redirect(route('approvisions.index'));
        }
    }

    public function getListe(Request $request)
    {
        if (isset($_GET['ae'])) {
            $annee_id = $_GET['ae'];
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
        }

        $data = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->get();

        if (User::authUserProfil()->nom != 'Administrateur') {
            $user = Auth::user();
            $data = $data->where('structure_id', $user->structure_id);
        }

        return view('reponse.table')
            ->with('data', $data)->with('ae', $annee_id);
    }

    public function getOption()
    {
        //
        if (isset($_GET['type'])) {
            $id = $_GET['type'];
            if ($id != "tout") {
                $options = Produit::where('type', $id)->get();
            } else {
                $options = Produit::all();
            }
        } else {
        }
        //dd($options);
?>
        <option value="">Sélectionner produit</option>
        <?php
        foreach ($options as $produit) {
        ?>
            <option value="<?php echo $produit->id; ?>"><?php echo $produit->libelle; ?></option>
<?php
        }
    }

    public function getProduit()
    {
        if (!empty($_GET["produit_id"])) {

            $id = $_GET["produit_id"];
            if (isset($_GET['ae'])) {
                $annee_id = $_GET['ae'];
            } else {
                $annee = AnneeExercice::anneeActive();
                $annee_id = $annee->id;
            }

            $produit = ListeProduit::where('produit_id', $id)
                ->where('annee_id', $annee_id)
                ->get()->first();

            return $produit;
        }
    }


    public function valider(Request $request, $id)
    {
        //
        $ligne = LigneCommande::where('id', $id)->get()->first();

        //User connecté
        $responsable_id = Auth::user()->id;

        $etape_ordre = $ligne->etape->ordre;

        $etape_svt = Etape::where('ordre', ($etape_ordre + 1))->get()->first();
        if ($etape_svt) {
            $result = LigneCommande::where('id', $id)->update(['etape_id' => $etape_svt->id]);
            EtapeLigneCommande::create([
                'date_validation' => date('Y-m-d'),
                'responsable_id' => $responsable_id,
                'etape_id' => $etape_svt->id,
                'ligne_commande_id' => $ligne->id,
            ]);
            if ($result) {
                \Session::flash('success', 'La validation effectuée avec succès !');
            } else {
                \Session::flash('warning', 'La validation a échoué');
            }
        } else {
            \Session::flash('warning', 'La validation a échoué');
        }

        $lignes = LigneCommande::all();
        return view('admin.ligne.index', compact('lignes'));
    }
}
