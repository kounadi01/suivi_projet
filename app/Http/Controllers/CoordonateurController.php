<?php

namespace App\Http\Controllers;

use App\Models\Coordonateur;
use App\Http\Requests\StoreCoordonateurRequest;
use App\Http\Requests\UpdateCoordonateurRequest;

class CoordonateurController extends Controller
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
     * @param  \App\Http\Requests\StoreCoordonateurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoordonateurRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoordonateurRequest  $request
     * @param  \App\Models\Coordonateur  $coordonateur
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoordonateurRequest $request, Coordonateur $coordonateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coordonateur  $coordonateur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordonateur $coordonateur)
    {
        //
    }
}
