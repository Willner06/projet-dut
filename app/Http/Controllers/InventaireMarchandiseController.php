<?php

namespace App\Http\Controllers;

use App\Models\InventaireMarchandise;
use App\Http\Requests\StoreInventaireMarchandiseRequest;
use App\Http\Requests\UpdateInventaireMarchandiseRequest;
use App\Models\Marchandise;
use App\Models\StockMarchandise;

class InventaireMarchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marchandises=Marchandise::get();
        $inventaires=InventaireMarchandise::get();
        $count=1;
        return view('marchandise.indexInventaire', compact('marchandises','inventaires','count'));

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
     * @param  \App\Http\Requests\StoreInventaireMarchandiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventaireMarchandiseRequest $request)
    {
        $marchandise=Marchandise::findOrFail($request->marchandise_id);
        $st=StockMarchandise::where('marchandise_id',$marchandise->id)->first();


        $inventaire= new InventaireMarchandise;
       echo '<br>'.$inventaire->reference=$marchandise->reference;
       echo '<br>'.$inventaire->designation=$marchandise->designation;
       echo '<br>'.$inventaire->categorie=$marchandise->categorie->libelle;
       echo '<br>'.$inventaire->prix_unitaire=$marchandise->prix_unitaire;
        if ($marchandise->stock->entre == null) {
            echo $marchandise->stock->entre=0;
            $inventaire->quantite_entre=$marchandise->stock->entre;
        }else{
            $inventaire->quantite_entre=$marchandise->stock->entre;
            echo"en";
        }

        if ($marchandise->stock->sorti == null) {
            echo $marchandise->stock->sorti=0;
            $inventaire->quantite_sorti=$marchandise->stock->sorti;
        }else{
            $inventaire->quantite_sorti=$marchandise->stock->sorti;
            echo"so";
        }
       echo '<br>'.$inventaire->quantite_stock=$request->quantite_stock;
       echo '<br>'.$inventaire->agent_superviseur=$request->agent_superviseur;
       echo '<br>'.$inventaire->agent_2=$request->agent_2;
       echo '<br>'.$inventaire->lieu=$request->lieu;
       echo '<br>'.$inventaire->commentaire=$request->commentaire;
       echo '<br>'.$inventaire->valeur_stock=$request->prix_unitaire*$request->quantote_stock;

       $inventaire->save();





       $stock= StockMarchandise::find($marchandise->stock->id);
       if ($marchandise->stock->entre == null) {
            $marchandise->stock->entre=0;
            $stock->entre=$marchandise->stock->entre;
       }else{
            $stock->entre=$marchandise->stock->entre;
       }

       if ($marchandise->stock->sorti == null) {
            $marchandise->stock->sorti=0;
        }else{
            $stock->sorti=$marchandise->stock->sorti;
        }
        $stock->stock_theorique=$stock->stock;
        $stock->stock=$request->quantite_stock;
        $stock->update();
       return redirect()->route('marchandise.inventaire.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InventaireMarchandise  $inventaireMarchandise
     * @return \Illuminate\Http\Response
     */
    public function show(InventaireMarchandise $inventaire)
    {
        // echo $inventaire;

        return view('marchandise.showInventaire', compact('inventaire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InventaireMarchandise  $inventaireMarchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(InventaireMarchandise $inventaireMarchandise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInventaireMarchandiseRequest  $request
     * @param  \App\Models\InventaireMarchandise  $inventaireMarchandise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventaireMarchandiseRequest $request, InventaireMarchandise $inventaire)
    {
        $marchandise=Marchandise::findOrFail($request->marchandise_id);
        $st=StockMarchandise::where('marchandise_id',$marchandise->id)->first();


        $inventaire= InventaireMarchandise::findOrFail($inventaire->id);
       echo '<br>'.$inventaire->reference=$marchandise->reference;
       echo '<br>'.$inventaire->designation=$marchandise->designation;
       echo '<br>'.$inventaire->categorie=$marchandise->categorie->libelle;
       echo '<br>'.$inventaire->prix_unitaire=$marchandise->prix_unitaire;
        if ($marchandise->stock->entre == null) {
            echo $marchandise->stock->entre=0;
            $inventaire->quantite_entre=$marchandise->stock->entre;
        }else{
            $inventaire->quantite_entre=$marchandise->stock->entre;
            echo"en";
        }

        if ($marchandise->stock->sorti == null) {
            echo $marchandise->stock->sorti=0;
            $inventaire->quantite_sorti=$marchandise->stock->sorti;
        }else{
            $inventaire->quantite_sorti=$marchandise->stock->sorti;
            echo"so";
        }
       echo '<br>'.$inventaire->quantite_stock=$request->quantite_stock;
       echo '<br>'.$inventaire->agent_superviseur=$request->agent_superviseur;
       echo '<br>'.$inventaire->agent_2=$request->agent_2;
       echo '<br>'.$inventaire->lieu=$request->lieu;
       echo '<br>'.$inventaire->commentaire=$request->commentaire;
       echo '<br>'.$inventaire->valeur_stock=$request->prix_unitaire*$request->quantote_stock;

       $inventaire->update();





       $stock= StockMarchandise::find($marchandise->stock->id);
       if ($marchandise->stock->entre == null) {
            $marchandise->stock->entre=0;
            $stock->entre=$marchandise->stock->entre;
       }else{
            $stock->entre=$marchandise->stock->entre;
       }

       if ($marchandise->stock->sorti == null) {
            $marchandise->stock->sorti=0;
        }else{
            $stock->sorti=$marchandise->stock->sorti;
        }
       $stock->stock=$request->quantite_stock;
       $stock->update();

       return redirect()->route('marchandise.inventaire.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InventaireMarchandise  $inventaireMarchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventaireMarchandise $inventaireMarchandise)
    {
        //
    }
}
