<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use App\Http\Requests\StoreTierRequest;
use App\Http\Requests\UpdateTierRequest;
use App\Models\Encaissement;

class TierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public $monaie="Fcfa";

    function __construct()
     {
          $this->middleware('permission:Voir les tiers', ['only' => ['indexFournisseur']]);
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
     * @param  \App\Http\Requests\StoreTierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTierRequest $request)
    {
        $tier=new Tier;
        $nomNum=mb_substr($request->nom, 0, 3,'UTF-8');


        if ($request->button== "fournisseur") {
            $numero="40".$nomNum;
            $statut="fournisseur";
        }

        if ($request->button== "client") {
            $numero="41".$nomNum;
            $statut="client";
        }

        if ($request->button== "autre") {

            //  $lasttier=Tier::where('statut','autre')->get()->last();
            //  if (empty($lasttier)) {
            //      $numero="42".$nomNum;
            //     $statut="autre";
            //  }else{
            //     $nombre= intval($lasttier->numero);
            //     $numero=($nombre+1).$nomNum;
            //     $statut="autre";
            //  }

             if ($request->type_compte== "Personnel")
             {
                $numero="42".$nomNum;
                $statut="autre";
             }else if($request->type_compte== "Organismes sociaux")
             {
                $numero="43".$nomNum;
                $statut="autre";
             }else if($request->type_compte== "Etat et collectivités publiques")
             {
                $numero="44".$nomNum;
                $statut="autre";
             }else if($request->type_compte== "Organismes internationaux")
             {
                $numero="45".$nomNum;
                $statut="autre";
             }else if($request->type_compte== "Apporteurs, associés et groupe")
             {
                $numero="46".$nomNum;
                $statut="autre";
             }else if($request->type_compte== "Débiteurs et créditeurs divers")
             {
                $numero="47".$nomNum;
                $statut="autre";
             }else if($request->type_compte== "Créances et dettes hors activités ordinaires (HAO)")
             {
                $numero="48".$nomNum;
                $statut="autre";
             }

        }

        $tier->numero=$numero;
        $tier->nom=$request->nom;
        $tier->prenom=$request->prenom;
        $tier->nif=$request->nif;
        $tier->localisation=$request->localisation;
        $tier->telephone=$request->telephone;
        $tier->mail=$request->mail;
        $tier->statut=$statut;
        $tier->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function show(Tier $tier)
    {
        $monaie=$this->monaie;
        $encaissements=Encaissement::get();
        return view('tiers.showTiers', compact('tier','encaissements','monaie'));
    }

    public function showFournisseur(Tier $tier)
    {
        $monaie=$this->monaie;
        $encaissements=Encaissement::get();
        return view('tiers.showFournisseur', compact('tier','encaissements','monaie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function edit(Tier $tier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTierRequest  $request
     * @param  \App\Models\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTierRequest $request, Tier $tier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tier $tier)
    {
        $tier->delete();
        return redirect()->back();
    }


    public function indexFournisseur()
    {
        $tiers=Tier::where('statut','fournisseur')->get();
        return view('tiers.indexFournisseur', compact('tiers'));
    }

    public function indexClient()
    {
        $tiers=Tier::where('statut','client')->get();
        return view('tiers.indexClient', compact('tiers'));
    }

    public function indexAutre()
    {
        $tiers=Tier::where('statut','autre')->get();
        return view('tiers.indexAutre', compact('tiers'));
    }


    public function csv(Tier $tier)
    {
        $monaie=$this->monaie;
        $encaissements=Encaissement::get();
        return view('tiers.csvfournisseur', compact('tier','encaissements','monaie'));
    }
}
