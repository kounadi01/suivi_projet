<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Http\Requests\StoreFournisseurRequest;
use App\Http\Requests\UpdateFournisseurRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Fournisseur::all();

        return view('fournisseur.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('fournisseur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFournisseurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nom' => 'required|unique:fournisseurs,nom',
            'ifu' => 'required|unique:fournisseurs,ifu',
            'telephone' => 'required',
            'email' => 'required',
            'responsable' => 'required'
        ]);

        if ($validator->fails()) {
            // return redirect(route('fournisseurs.create'))
            //     ->withErrors($validator)
            //     ->withInput();
            return response()->json([
                'erreur' => 'Données incohérentes',
            ], 422);
        } else {
            $input = $request->all();

            Fournisseur::create($input);

            return redirect(route('fournisseurs.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
        return view('fournisseur.edit', ['fournisseur' => $fournisseur]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFournisseurRequest  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        //
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'responsable' => 'required'
        ]);

        if ($validator->fails()) {
            // return redirect(route('fournisseurs.edit', $fournisseur))
            //     ->withErrors($validator)
            //     ->withInput();
            return response()->json([
                'erreur' => 'Données incohérentes',
            ], 422);
        } else {
            $input = $request->all();
            //var_dump($input);
            $fournisseur->update($input);

            return redirect(route('fournisseurs.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $result = Fournisseur::destroy($id);

        return redirect(route('fournisseurs.index'));
    }

    public function getListe(Request $request)
    {
        $fournisseurs = Fournisseur::all();

        return view('fournisseur.table')
            ->with('data', $fournisseurs);
    }
}
