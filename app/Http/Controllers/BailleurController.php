<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Http\Requests\StoreBailleurRequest;
use App\Http\Requests\UpdateBailleurRequest;

class BailleurController extends Controller
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
     * @param  \App\Http\Requests\StoreBailleurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBailleurRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBailleurRequest  $request
     * @param  \App\Models\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBailleurRequest $request, Bailleur $bailleur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bailleur $bailleur)
    {
        //
    }
}
