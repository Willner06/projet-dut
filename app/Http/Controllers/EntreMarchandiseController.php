<?php

namespace App\Http\Controllers;

use App\Models\EntreMarchandise;
use App\Http\Requests\StoreEntreMarchandiseRequest;
use App\Http\Requests\UpdateEntreMarchandiseRequest;
use App\Models\Marchandise;
use App\Models\StockMarchandise;

class EntreMarchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entres=EntreMarchandise::get();
        $marchandises=Marchandise::get();
        return view('marchandise.entre',compact('entres','marchandises'));
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
     * @param  \App\Http\Requests\StoreEntreMarchandiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntreMarchandiseRequest $request)
    {
        $marchandise= Marchandise::find($request->marchandise_id);

        $st=StockMarchandise::where('marchandise_id',$marchandise->id)->first();



        // $stockExist=StockMarchandise::find($marchandise->stock->id);


        $entree= new EntreMarchandise();

        $entree->fournisseur=$request->fournisseur;
        $entree->quantite=$request->quantite;
        $entree->motif=$request->motif;
        $entree->date_achat=$request->date_achat;
        $entree->marchandise_id=$request->marchandise_id;
        $entree->save();

        if (empty($st)) {

            // $stockExist=StockMarchandise::find($marchandise->stock->id);
            // if (empty($stockExist->stock)) {
            $stocks= new StockMarchandise;
            $stocks->entre=$request->quantite;
            $stocks->stock=$request->quantite;
            $stocks->stock_theorique=$request->quantite;
            $stocks->marchandise_id= $request->marchandise_id;
            $stocks->save();
            echo "ex pas";
        }
        // }

        if(!empty($st)){

            // $stockExist=StockMarchandise::find($marchandise->stock->id);
            // if (!empty($stockExist->stock)) {

            $stock= StockMarchandise::find($marchandise->stock->id);
            $stock->entre=$stock->entre+$request->quantite;
            $stock->stock=$marchandise->stock->stock+ $request->quantite;
            $stock->stock_theorique=$marchandise->stock->stock_theorique + $request->quantite;
            $stock->update();
            echo "ex ";

        }
        // }

        // if (empty($stockExist->stock)) {
        //     $stocks= new StockMarchandise;
        //     $stocks->entre=$request->quantite;
        //     $stocks->stock=$request->quantite;
        //     $stocks->marchandise_id= $request->marchandise_id;
        //     $stocks->save();
        //     echo "ex pas";
        // }

        // if (!empty($stockExist->stock)) {

        //     $stock= StockMarchandise::find($marchandise->stock->id);
        //     $stock->entre=$stock->entre+$request->quantite;
        //     $stock->stock=$marchandise->stock->stock+ $request->quantite;
        //     $stock->update();
        //     echo "ex ";

        // }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntreMarchandise  $entreMarchandise
     * @return \Illuminate\Http\Response
     */
    public function show(EntreMarchandise $entreMarchandise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntreMarchandise  $entreMarchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(EntreMarchandise $entreMarchandise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEntreMarchandiseRequest  $request
     * @param  \App\Models\EntreMarchandise  $entreMarchandise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntreMarchandiseRequest $request, EntreMarchandise $entre)
    {
        echo $entre;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntreMarchandise  $entreMarchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntreMarchandise $entre)
    {
        // echo $entre;
        // $entre->delete();

        // echo $entre->marchandise->id;

        $marchandise= Marchandise::find($entre->marchandise->id);


        $stock= StockMarchandise::find($marchandise->stock->id);
            $stock->entre=$stock->entre-$entre->quantite;
            $stock->stock=$marchandise->stock->stock- $entre->quantite;
            $stock->update();

        $entre->delete();


        return redirect()->back();

    }
}
