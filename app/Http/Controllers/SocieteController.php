<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use App\Http\Requests\StoreSocieteRequest;
use App\Http\Requests\UpdateSocieteRequest;
use Illuminate\Http\Request;

class SocieteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $societes = Societe::all();

        return view('societes.index_societes',['societes' => $societes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('societes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSocieteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocieteRequest $request)
    {
        $input = $request->all();
    
        if ($structure = Societe::create($input)){
            return redirect()->route("societes.index")->with("statut", "La société  a bien été ajoutée avec succès");

        }
        return redirect()->route("societes.index")->with("statut", "Echec de l'ajout de la société ");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function show(Societe $societe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function edit(Societe $societe)
    {
        return view('societes.edit')->with('societe',$societe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSocieteRequest  $request
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocieteRequest $request, Societe $societe)
    {
       
        if ($societe->update($request->all())){
            return redirect()->route("societes.index")->with("statut", "La société a été modifiée avec succés");

        }
        return redirect()->route("societes.index")->with("statut", "Echec de modification de la société ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Societe::destroy($id);
       
        return redirect(route('societes.index'));
    }

    public function getListe(Request $request) 
    {
        $societes = Societe::all();

        return view('societes.table')
            ->with('societes', $societes);
    }
}
