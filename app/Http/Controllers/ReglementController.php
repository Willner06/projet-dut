<?php

namespace App\Http\Controllers;

use App\Models\Reglement;
use App\Http\Requests\StoreReglementRequest;
use App\Http\Requests\UpdateReglementRequest;
use App\Models\Motif;

class ReglementController extends Controller
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
     * @param  \App\Http\Requests\StoreReglementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReglementRequest $request)
    {

        $reglement=Reglement::find($request->validation);

        if ($reglement->denomination == null) {
            $reglement->denomination=$request->denomination;
            $reglement->reglement=true;
        }
        // if ($request->reglement == "on") {
        //     $reglement->reglement=true;
        // }

        $reglement->update();
        return redirect()->route('caisse.decaissement.carburant');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reglement  $reglement
     * @return \Illuminate\Http\Response
     */
    public function show(Reglement $reglement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reglement  $reglement
     * @return \Illuminate\Http\Response
     */
    public function edit(Reglement $reglement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReglementRequest  $request
     * @param  \App\Models\Reglement  $reglement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReglementRequest $request, Reglement $reglement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reglement  $reglement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reglement $reglement)
    {
        //
    }
}
