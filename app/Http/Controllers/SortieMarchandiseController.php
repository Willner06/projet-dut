<?php

namespace App\Http\Controllers;

use App\Models\SortieMarchandise;
use App\Http\Requests\StoreSortieMarchandiseRequest;
use App\Http\Requests\UpdateSortieMarchandiseRequest;
use App\Models\Marchandise;
use App\Models\StockMarchandise;

class SortieMarchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties=SortieMarchandise::get();
        $marchandises=Marchandise::get();
        return view('marchandise.sortie',compact('sorties','marchandises'));
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
     * @param  \App\Http\Requests\StoreSortieMarchandiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSortieMarchandiseRequest $request)
    {
        $marchandise= Marchandise::find($request->marchandise_id);

        $st=StockMarchandise::where('marchandise_id',$marchandise->id)->first();





        if (empty($st)) {

            // $stockExist=StockMarchandise::find($marchandise->stock->id);
            // if (empty($stockExist->stock)) {
            // $stocks= new StockMarchandise;
            // $stocks->entre=$request->quantite;
            // $stocks->stock=$request->quantite;
            // $stocks->marchandise_id= $request->marchandise_id;
            // $stocks->save();
            echo "ex pas";
        }
        // }

        if(!empty($st)){

            // $stockExist=StockMarchandise::find($marchandise->stock->id);
            // if (!empty($stockExist->stock)) {


                if($request->quantite > $marchandise->stock->stock){
                    echo "bade";
                }else{

                    $sortie= new SortieMarchandise;

                    $sortie->beneficiaire=$request->beneficiaire;
                    $sortie->quantite=$request->quantite;
                    $sortie->motif=$request->motif;
                    $sortie->date_sortie=$request->date_sortie;
                    $sortie->marchandise_id=$request->marchandise_id;
                    $sortie->save();

                    $stock= StockMarchandise::find($marchandise->stock->id);
                    echo $stock->sorti=$stock->sorti+$request->quantite;
                    echo $stock->stock=$marchandise->stock->stock - $request->quantite;
                    $stock->stock_theorique=$marchandise->stock->stock_theorique - $request->quantite;
                    $stock->update();
                    echo "ex ";
                }

        }

        // if (empty($stockExist->stock)) {
        //     $stocks= new StockMarchandise;
        //     $stocks->entre=$request->quantite;
        //     $stocks->stock=$request->quantite;
        //     $stocks->marchandise_id= $request->marchandise_id;
        //     // $stocks->save();
        //     echo "ex pas";
        // }

        // if (!empty($stockExist->stock)) {

        //     if($request->quantite > $marchandise->stock->stock){
        //         echo "bade";
        //     }else{
        //         $stock= StockMarchandise::find($marchandise->stock->id);
        //         echo $stock->sorti=$stock->sorti+$request->quantite;
        //         echo $stock->stock=$marchandise->stock->stock - $request->quantite;
        //         // $stock->update();
        //         echo "ex ";
        //     }


        // }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SortieMarchandise  $sortieMarchandise
     * @return \Illuminate\Http\Response
     */
    public function show(SortieMarchandise $sortieMarchandise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SortieMarchandise  $sortieMarchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(SortieMarchandise $sortieMarchandise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSortieMarchandiseRequest  $request
     * @param  \App\Models\SortieMarchandise  $sortieMarchandise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSortieMarchandiseRequest $request, SortieMarchandise $sortieMarchandise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SortieMarchandise  $sortieMarchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(SortieMarchandise $sortie)
    {
        $marchandise= Marchandise::find($sortie->marchandise->id);


        $stock= StockMarchandise::find($marchandise->stock->id);
            $stock->entre=$stock->sorti-$sortie->quantite;
            $stock->stock=$marchandise->stock->stock + $sortie->quantite;
            $stock->update();

        $sortie->delete();


        return redirect()->back();
    }
}
