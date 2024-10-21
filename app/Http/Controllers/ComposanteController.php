<?php

namespace App\Http\Controllers;

use App\Models\Composante;
use App\Http\Requests\StoreComposanteRequest;
use App\Http\Requests\UpdateComposanteRequest;

class ComposanteController extends Controller
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
     * @param  \App\Http\Requests\StoreComposanteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComposanteRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComposanteRequest  $request
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComposanteRequest $request, Composante $composante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Composante $composante)
    {
        //
    }
}
