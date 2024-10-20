<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Produit::all();

        return view('produit.index', ['data' => $data]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('produits.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            //$input = $request->all();
            if ($request->decret == null) {
                $decret = 0;
            } else {
                $decret = $request->decret;
            }
            $input = array(
                'type' => $request->type,
                'libelle' => $request->libelle,
                'decret' => $decret,
            );

            Produit::create($input);

            return redirect(route('produits.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        //
        return view('produit.edit', ['produit' => $produit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        //
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('produits.edit', $produit))
                ->withErrors($validator)
                ->withInput();
        } else {
            $input = $request->all();

            if ($request->decret == null) {
                $decret = 0;
            } else {
                $decret = $request->decret;
            }
            $input = array(
                'type' => $request->type,
                'libelle' => $request->libelle,
                'decret' => $decret,
            );
            $produit->update($input);

            return redirect(route('produits.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $result = Produit::destroy($id);

        return redirect(route('produits.index'));
    }

    public function getListe(Request $request)
    {
        $produits = Produit::all();

        return view('produit.table')
            ->with('data', $produits);
    }
}
