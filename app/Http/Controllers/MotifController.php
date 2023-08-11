<?php

namespace App\Http\Controllers;

use App\Models\Motif;
use App\Http\Requests\StoreMotifRequest;
use App\Http\Requests\UpdateMotifRequest;

class MotifController extends Controller
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
     * @param  \App\Http\Requests\StoreMotifRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMotifRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motif  $motif
     * @return \Illuminate\Http\Response
     */
    public function show(Motif $motif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motif  $motif
     * @return \Illuminate\Http\Response
     */
    public function edit(Motif $motif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMotifRequest  $request
     * @param  \App\Models\Motif  $motif
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMotifRequest $request, Motif $motif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motif  $motif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motif $motif)
    {
        //
    }
}
