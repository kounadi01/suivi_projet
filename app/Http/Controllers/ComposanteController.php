<?php

namespace App\Http\Controllers;

use App\Models\Composante;
use App\Http\Requests\StoreComposanteRequest;
use App\Http\Requests\UpdateComposanteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComposanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Composante::all();

        return view('composante.index', ['data' => $data]);
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
     * @param  \App\Http\Requests\StoreComposanteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        
        } else {
            $input = $request->all();
            //var_dump($input);
            Composante::create($input);

            return redirect(route('composantes.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function show(Composante $composante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function edit(Composante $composante)
    {
        return view('composante.edit', ['composante' => $composante]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComposanteRequest  $request
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Composante $composante)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        
        } else {
            $input = $request->all();
            //var_dump($input);
            $composante->update($input);

            return redirect(route('composantes.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Composante::destroy($id);

        return redirect(route('composantes.index'));
    }
    
    public function getListe(Request $request)
    {
        $composantes = Composante::all();

        return view('composante.table')
            ->with('data', $composantes);
    }
    
}
