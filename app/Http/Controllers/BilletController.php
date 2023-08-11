<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use App\Http\Requests\StoreBilletRequest;
use App\Http\Requests\UpdateBilletRequest;
use App\Models\Compte;
use App\Models\Piece;

class BilletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $monaie="Fcfa";
    public function index()
    {
         $inventaires=Billet::orderBy('created_at', 'DESC')->get();
        $monaie=$this->monaie;
        return view('caisse.inventaire',compact('inventaires','monaie'));
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
     * @param  \App\Http\Requests\StoreBilletRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBilletRequest $request)
    {
        $compte=Compte::get()->last();
        $billet = new Billet;
        $billet->b10000=$request->b_10000;
        $billet->b5000=$request->b_5000;
        $billet->b2000=$request->b_2000;
        $billet->b1000=$request->b_1000;
        $billet->b500=$request->b_500;

        // $piece = new Piece;
        // $piece->p500=$request->p_500;
        // $piece->p100=$request->p_100;
        // $piece->p50=$request->p_50;
        // $piece->p25=$request->p_25;
        // $piece->p10=$request->p_10;
        // $piece->p5=$request->p_5;
        // $piece->p1=$request->p_1;
        // $piece->save();


        $billet->p500=$request->p_500;
        $billet->p100=$request->p_100;
        $billet->p50=$request->p_50;
        $billet->p25=$request->p_25;
        $billet->p10=$request->p_10;
        $billet->p5=$request->p_5;
        $billet->p1=$request->p_1;
        $billet->soldeInventaire=$request->soldeInventaire;

        $billet->save();

        // $compte->solde_theorique= $compte->solde;
        $compte->solde= $request->soldeInventaire;
        $compte->update();
        // echo $request->soldeInventaire.'fcfa';

        return redirect()->route('caisse.suivi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Billet  $billet
     * @return \Illuminate\Http\Response
     */
    public function show(Billet $billet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Billet  $billet
     * @return \Illuminate\Http\Response
     */
    public function edit(Billet $billet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBilletRequest  $request
     * @param  \App\Models\Billet  $billet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBilletRequest $request, Billet $billet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billet  $billet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billet $billet)
    {
        //
    }
}
