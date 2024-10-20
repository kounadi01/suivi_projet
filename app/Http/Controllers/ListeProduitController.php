<?php

namespace App\Http\Controllers;

use App\Models\ListeProduit;
use App\Http\Requests\StoreListeProduitRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateListeProduitRequest;
use App\Models\AnneeExercice;
use App\Models\Phase;
use App\Models\Produit;

class ListeProduitController extends Controller
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
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
        }

        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
            if ($type == 'tout') {
                $produits = Produit::where('decret', '=', 1)->get();
            } else {
                if ($type == 'service') {
                    $produits = Produit::where('decret', '=', 1)->where('type', '=', 'Service')->get();
                } else {
                    if ($type == 'bien') {
                        $produits = Produit::where('decret', '=', 1)->where('type', '=', 'Bien')->get();
                    } else {
                        $produits = Produit::where('decret', '=', 1)->where('type', $type)->get();
                    }
                }
            }
        } else {
            $produits = Produit::where('decret', '=', 1)->get();
            $type = "tout";
        }

        $data = ListeProduit::where('annee_id', $annee_id)->get();

        $phases = Phase::all();

        return view('liste-produit.index', ['data' => $data, 'ae' => $annee_id, 'produits' => $produits, 'phases' => $phases, 'type' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $annee_id = $_GET['ae'];

        $annees = AnneeExercice::where('id', '!=', $annee_id)->get()->pluck('annee_exercice', 'id');
        return view('liste-produit.copier', ['annees' => $annees, 'annee' => $annee_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreListeProduitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
            if ($type == 'tout') {
                $produits = Produit::where('decret', '=', 1)->get();
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

        $exploration = $request->input('exploration');
        $developpement = $request->input('developpement');
        $exploitation = $request->input('exploitation');
        $rehabilitation = $request->input('rehabilitation');
        //dd($max[1]);
        foreach ($produits as $i => $produit) {
            $data = array(
                'annee_id' => $request->input('ae'),
                'produit_id' => $produit->id,
                //'phase_id' => 0,
                'produit' => $produit->libelle,
                'exploration' => $exploration[$produit->id],
                'developpement' => $developpement[$produit->id],
                'exploitation' => $exploitation[$produit->id],
                'rehabilitation' => $rehabilitation[$produit->id],
                //'pourcentage' => 0,
            );

            $resul = ListeProduit::where('annee_id', $request->input('ae'))
                ->where('produit_id', $produit->id)
                ->get()->first();

            if ($resul != null) {
                ListeProduit::where('id', $resul->id)->update($data);
            } else {
                ListeProduit::create($data);
            }
        }

        return redirect()->route('listeProduits.index', ['ae' => $_GET['ae']])->with("statut", "La validation  a bien été effectuée avec succés");
    }

    public function copier(Request $request)
    {
        //
        $annee_old = $request->input('annee_old');
        $annee_new = $request->input('annee_id');
        //dd($request->all());
        $liste = ListeProduit::where('annee_id', $annee_old)->get();
        //dd($liste);

        //dd($max[1]);
        foreach ($liste as $i => $produit) {
            $data = array(
                'annee_id' => $annee_new,
                'produit_id' => $produit->produit_id,
                //'phase_id' => 0,
                'produit' => $produit->produit,
                'exploration' => $produit->exploration,
                'developpement' => $produit->developpement,
                'exploitation' => $produit->exploitation,
                'rehabilitation' => $produit->rehabilitation,
                //'pourcentage' => 0,
            );

            $resul = ListeProduit::where('annee_id', $annee_new)
                ->where('produit_id', $produit->id)
                ->get()->first();

            if ($resul != null) {
                ListeProduit::where('id', $resul->id)->update($data);
            } else {
                ListeProduit::create($data);
            }
        }

        return redirect()->route('listeProduits.index', ['ae' => $annee_new])->with("statut", "La liste  a  été copiée avec succés");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListeProduit  $listeProduit
     * @return \Illuminate\Http\Response
     */
    public function show(ListeProduit $listeProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListeProduit  $listeProduit
     * @return \Illuminate\Http\Response
     */
    public function edit(ListeProduit $listeProduit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateListeProduitRequest  $request
     * @param  \App\Models\ListeProduit  $listeProduit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateListeProduitRequest $request, ListeProduit $listeProduit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListeProduit  $listeProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListeProduit $listeProduit)
    {
        //

    }

    public function getListe(Request $id)
    {
        $annee_id = $_GET['ae'];
        $data = ListeProduit::where('annee_id', $annee_id)->get();
        $phases = Phase::all();
        $produits = Produit::all();
        $type = "tout";

        return view('liste-produit.table')
            ->with('data', $data)->with('ae', $annee_id)->with('phases', $phases)
            ->with('produits', $produits)
            ->with('type', $type);
    }
}
