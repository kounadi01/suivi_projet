<?php

namespace App\Http\Controllers;

use App\Models\Coordonner;
use App\Http\Requests\StoreCoordonnerRequest;
use App\Http\Requests\UpdateCoordonnerRequest;

class CoordonnerController extends Controller
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
     * @param  \App\Http\Requests\StoreCoordonnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoordonnerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coordonner  $coordonner
     * @return \Illuminate\Http\Response
     */
    public function show(Coordonner $coordonner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coordonner  $coordonner
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordonner $coordonner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoordonnerRequest  $request
     * @param  \App\Models\Coordonner  $coordonner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoordonnerRequest $request, Coordonner $coordonner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coordonner  $coordonner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordonner $coordonner)
    {
        //
    }
}
