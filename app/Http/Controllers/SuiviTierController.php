<?php

namespace App\Http\Controllers;

use App\Models\SuiviTier;
use App\Http\Requests\StoreSuiviTierRequest;
use App\Http\Requests\UpdateSuiviTierRequest;

class SuiviTierController extends Controller
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
     * @param  \App\Http\Requests\StoreSuiviTierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSuiviTierRequest $request)
    {
        $suivi=new SuiviTier;
        $suivi->pointage=$request->pointage;
        $suivi->code_journal=$request->code_journal;
        $suivi->date=$request->date;
        $suivi->numero_piece=$request->numero_piece;
        $suivi->libelle=$request->libelle;
        $suivi->date_echeance=$request->date_echeance;
        $suivi->debit=$request->debit;
        $suivi->credit=$request->credit;
        $suivi->tiers_id=$request->tier_id;
        $suivi->statut=$request->statut;
        $suivi->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuiviTier  $suiviTier
     * @return \Illuminate\Http\Response
     */
    public function show(SuiviTier $suiviTier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuiviTier  $suiviTier
     * @return \Illuminate\Http\Response
     */
    public function edit(SuiviTier $suiviTier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSuiviTierRequest  $request
     * @param  \App\Models\SuiviTier  $suiviTier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSuiviTierRequest $request, SuiviTier $suiviTier)
    {

        $suiviTier->pointage=$request->pointage;
        $suiviTier->code_journal=$request->code_journal;
        $suiviTier->date=$request->date;
        $suiviTier->numero_piece=$request->numero_piece;
        $suiviTier->libelle=$request->libelle;
        $suiviTier->date_echeance=$request->date_echeance;
        $suiviTier->debit=$request->debit;
        $suiviTier->credit=$request->credit;
        $suiviTier->tiers_id=$request->tier_id;
        $suiviTier->statut=$request->statut;
        $suiviTier->update();
        return redirect()->back()->with('message', 'Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuiviTier  $suiviTier
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuiviTier $suiviTier)
    {
        $suiviTier->delete();
        return redirect()->back()->with('success', 'upprimé avec succès');
    }
}
