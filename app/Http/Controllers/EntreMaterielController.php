<?php

namespace App\Http\Controllers;

use App\Models\EntreMateriel;
use App\Http\Requests\StoreEntreMaterielRequest;
use App\Http\Requests\UpdateEntreMaterielRequest;
use App\Models\MaterielIntermediaire;

class EntreMaterielController extends Controller
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
     * @param  \App\Http\Requests\StoreEntreMaterielRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntreMaterielRequest $request)
    {
        $entre = new EntreMateriel;

        $entre->quantite=$request->quantite;
        $entre->date_achat=$request->date_achat;
        $entre->cout_achat=$request->cout_achat;
        $entre->materiel_id=$request->materiel_id;
        $entre->save();

        return redirect()->back()->with('Enregistré avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntreMateriel  $entreMateriel
     * @return \Illuminate\Http\Response
     */
    public function show(EntreMateriel $entreMateriel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntreMateriel  $entreMateriel
     * @return \Illuminate\Http\Response
     */
    public function edit(EntreMateriel $entreMateriel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEntreMaterielRequest  $request
     * @param  \App\Models\EntreMateriel  $entreMateriel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntreMaterielRequest $request, EntreMateriel $entreMateriel)
    {

        $entreMateriel->quantite=$request->quantite;
        $entreMateriel->date_achat=$request->date_achat;
        $entreMateriel->cout_achat=$request->cout_achat;
        $entreMateriel->materiel_id=$request->materiel_id;
        $entreMateriel->update();

        return redirect()->back()->with('Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntreMateriel  $entreMateriel
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntreMateriel $entreMateriel)
    {
        $entreMateriel->delete();

        return redirect()->back()->with('Supprimé avec succès');
    }
}
