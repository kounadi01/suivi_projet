<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Http\Requests\StoreBailleurRequest;
use App\Http\Requests\UpdateBailleurRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BailleurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bailleur::all();
        return view('bailleur.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bailleur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBailleurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'sigle' => 'required|string|max:50',
            'telephone' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }
        else {
            
            Bailleur::create($request->all());
            return redirect(route('bailleurs.index'))->with('success', 'Bailleur créé avec succès');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function show(Bailleur $bailleur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function edit(Bailleur $bailleur)
    {
        return view('bailleur.edit', ['bailleur' => $bailleur]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBailleurRequest  $request
     * @param  \App\Models\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bailleur $bailleur)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'sigle' => 'required|string|max:50',
            'telephone' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        
        } else {
            $bailleur->update($request->all());
            return redirect(route('bailleurs.index'))->with('success', 'Bailleur modifié avec succès');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bailleur::destroy($id);
        return redirect(route('bailleurs.index'))->with('success', 'Bailleur supprimé avec succès');
    }

    public function getListe(Request $request)
    {
        $bailleurs = Bailleur::all();

        return view('bailleur.table')
            ->with('data', $bailleurs);
    }
}
