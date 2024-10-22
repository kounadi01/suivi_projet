<?php

namespace App\Http\Controllers;

use App\Models\Coordonateur;
use App\Http\Requests\StoreCoordonateurRequest;
use App\Http\Requests\UpdateCoordonateurRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoordonateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Coordonateur::all();
        return view('coordonateur.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coordonateur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCoordonateurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|min:8',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        
        } else {
            Coordonateur::create($request->all());
            return redirect(route('coordonateurs.index'))->with('success', 'Coordonateur créé avec succès');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coordonateur  $coordonateur
     * @return \Illuminate\Http\Response
     */
    public function show(Coordonateur $coordonateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coordonateur  $coordonateur
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordonateur $coordonateur)
    {
        return view('coordonateur.edit', ['coordonateur' => $coordonateur]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoordonateurRequest  $request
     * @param  \App\Models\Coordonateur  $coordonateur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coordonateur $coordonateur)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|min:8',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        
        } else {
            $coordonateur->update($request->all());
            return redirect(route('coordonateurs.index'))->with('success', 'Coordonateur modifié avec succès');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coordonateur  $coordonateur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coordonateur::destroy($id);
        return redirect(route('coordonateurs.index'))->with('success', 'Coordonateur supprimé avec succès');
    }

    public function getListe(Request $request)
    {
        $coordonateurs = Coordonateur::all();
        return view('coordonateur.table', ['data' => $coordonateurs]);
    }
}
