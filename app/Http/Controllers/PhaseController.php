<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use App\Http\Requests\StorePhaseRequest;
use App\Http\Requests\UpdatePhaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Phase::all();

        return view('phase.index', ['data' => $data]);
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
     * @param  \App\Http\Requests\StorePhaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('phases.create'))
                ->withErrors($validator)
                ->withInput();
        } else {
            $input = $request->all();
            //var_dump($input);
            Phase::create($input);

            return redirect(route('phases.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function show(Phase $phase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function edit(Phase $phase)
    {
        //
        return view('phase.edit', ['phase' => $phase]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhaseRequest  $request
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phase $phase)
    {
        //
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('phases.edit', $phase))
                ->withErrors($validator)
                ->withInput();
        } else {
            $input = $request->all();
            //var_dump($input);
            $phase->update($input);

            return redirect(route('phases.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $result = Phase::destroy($id);

        return redirect(route('phases.index'));
    }

    public function getListe(Request $request)
    {
        $phases = Phase::all();

        return view('phase.table')
            ->with('data', $phases);
    }
}
