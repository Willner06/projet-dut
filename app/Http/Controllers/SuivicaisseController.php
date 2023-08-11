<?php

namespace App\Http\Controllers;

use App\Models\Suivicaisse;
use App\Http\Requests\StoreSuivicaisseRequest;
use App\Http\Requests\UpdateSuivicaisseRequest;
use App\Models\Cloture;
use App\Models\Compte;
use App\Models\Decaissement;
use App\Models\Encaissement;

class SuivicaisseController extends Controller
{
    public $monaie="Fcfa";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monaie=$this->monaie;
        $date=date("Y-m-d");
        $encaissements=Encaissement::whereDate('created_at',$date)->get();
        $decaissements=Decaissement::whereDate('created_at',$date)->get();
        $transactions=$decaissements->merge($encaissements);

        if (Compte::get()->last() == null) {
            $soldeTehorique=0;
        }else{
            if (Compte::get()->last()->solde_theorique == null) {
                $soldeTehorique=Compte::get()->last()->solde;
            }else{
                $soldeTehorique=Compte::get()->last()->solde_theorique;
            }
        }

        if (Cloture::get()->last() == null) {
            $solde_reel=0;
        }else{
            $solde_reel=Cloture::get()->last()->solde_reel;
        }




        return view('caisse.suivi',compact('monaie','decaissements','encaissements','transactions','soldeTehorique','solde_reel'));
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
     * @param  \App\Http\Requests\StoreSuivicaisseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSuivicaisseRequest $request)
    {
        $suivi = new Suivicaisse;
        $suivi->date=$request->date;
        $suivi->num_piece=$request->num_piece;
        $suivi->code=$request->code;
        $suivi->libelle=$request->libelle;
        $suivi->montant=$request->montant;
        $suivi->save();
        return redirect()->route('caisse.suivi.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suivicaisse  $suivicaisse
     * @return \Illuminate\Http\Response
     */
    public function show(Suivicaisse $suivicaisse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suivicaisse  $suivicaisse
     * @return \Illuminate\Http\Response
     */
    public function edit(Suivicaisse $suivicaisse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSuivicaisseRequest  $request
     * @param  \App\Models\Suivicaisse  $suivicaisse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSuivicaisseRequest $request, Suivicaisse $suivicaisse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suivicaisse  $suivicaisse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suivicaisse $suivicaisse)
    {
        //
    }
}
