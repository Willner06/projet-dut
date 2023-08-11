<?php

namespace App\Http\Controllers;

use App\Models\Cloture;
use App\Http\Requests\StoreClotureRequest;
use App\Http\Requests\UpdateClotureRequest;
use App\Models\Compte;
use App\Models\Decaissement;
use App\Models\Encaissement;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;

class ClotureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     function __construct()
     {
        //   $this->middleware('permission:Cloture de caisse', ['only' => ['controle']]);
        //   $this->middleware('permission:decaissement-create', ['only' => ['create','store']]);
        //   $this->middleware('permission:decaissement-edit', ['only' => ['edit','update']]);
        //   $this->middleware('permission:decaissement-delete', ['only' => ['destroy']]);
     }


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
     * @param  \App\Http\Requests\StoreClotureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClotureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cloture  $cloture
     * @return \Illuminate\Http\Response
     */
    public function show(Cloture $cloture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cloture  $cloture
     * @return \Illuminate\Http\Response
     */
    public function edit(Cloture $cloture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClotureRequest  $request
     * @param  \App\Models\Cloture  $cloture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClotureRequest $request, $id)
    {

    }


    public function controle(UpdateClotureRequest $request, $id)
    {
        $cloture = Cloture::findOrFail($id);

        $date= $cloture->created_at;
         $decaissements= Decaissement::whereDate('created_at', $date)->get();
         $encaissements= Encaissement::whereDate('created_at', $date)->get();

         $compte= Compte::where('cloture_id', $cloture->id)->first();


        foreach ($decaissements as $decaissement) {
            $decaissement->etat="controlle";
            $decaissement->update();
        }

        foreach ($encaissements as $encaissement) {
            $encaissement->etat="controlle";
            $encaissement->update();
        }


        $cloture->commentaire=$request->commentaire;
        $cloture->solde_reel=$request->solde_reel;
        $cloture->controlleur=Auth::user()->nom;
        $cloture->date_controle=date("d-m-Y H:i:s");
        $cloture->ecart=$cloture->solde_reel-$cloture->compte->solde;
        $cloture->status=true;
        $cloture->solde_theorique= $compte->solde;

        $compte->solde_theorique= $compte->solde;
        $compte->solde= $request->solde_reel;
        $compte->update();
        $cloture->update();


        return redirect()->route('caisse.clotureDeCaisse');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cloture  $cloture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cloture $cloture)
    {
        //
    }


}
