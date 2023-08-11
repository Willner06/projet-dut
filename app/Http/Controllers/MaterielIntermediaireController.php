<?php

namespace App\Http\Controllers;

use App\Models\MaterielIntermediaire;
use App\Http\Requests\StoreMaterielIntermediaireRequest;
use App\Http\Requests\UpdateMaterielIntermediaireRequest;

class MaterielIntermediaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     public $monaie=" Fcfa";

     function __construct()
     {
          $this->middleware('permission:Voir les immobilisations', ['only' => ['index']]);
        //   $this->middleware('permission:decaissement-create', ['only' => ['create','store']]);
        //   $this->middleware('permission:decaissement-edit', ['only' => ['edit','update']]);
        //   $this->middleware('permission:decaissement-delete', ['only' => ['destroy']]);
     }

    public function index()
    {
        $id=1;
        $intermediaires=MaterielIntermediaire::get();
        $monaie=$this->monaie;
        $cout_total=0;
        foreach ($intermediaires as $intermediaire) {




        // foreach ($intermediaires as $intermediaire) {

            $cout_par_entre=0;
            $cout_par_type=0;
            foreach ($intermediaire->entres as $entre) {
                 $cout_par_entre= $entre->cout_achat*$entre->quantite;
                  $cout_par_type=$cout_par_type + $cout_par_entre;
        // }
            // echo $cout_total=$cout_total + $cout_par_entre; echo '</br>';
            }

            $cout_total=$cout_total + $cout_par_type;
        }

        return view('immobilisation.intermediaire.index',compact('intermediaires','id','monaie','cout_total'));
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
     * @param  \App\Http\Requests\StoreMaterielIntermediaireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaterielIntermediaireRequest $request)
    {
        $materielIntermediaire= new MaterielIntermediaire;
        $materielIntermediaire->designation=$request->designation;
        $materielIntermediaire->save();

        return redirect()->route('materiel.intermediaire.index')->with('message', 'Matériel ajouté avec succes');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaterielIntermediaire  $materielIntermediaire
     * @return \Illuminate\Http\Response
     */
    public function show(MaterielIntermediaire $materielIntermediaire)
    {
        $monaie=$this->monaie;
        $intermediaire=$materielIntermediaire;
        return view('immobilisation.intermediaire.show', compact('intermediaire','monaie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterielIntermediaire  $materielIntermediaire
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterielIntermediaire $materielIntermediaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMaterielIntermediaireRequest  $request
     * @param  \App\Models\MaterielIntermediaire  $materielIntermediaire
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaterielIntermediaireRequest $request, MaterielIntermediaire $materielIntermediaire)
    {
        $id=1;
        $materielIntermediaire->designation=$request->designation;
        $materielIntermediaire->update();

        return redirect()->route('materiel.intermediaire.index')->with('message', 'Matériel modifié avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterielIntermediaire  $materielIntermediaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterielIntermediaire $materielIntermediaire)
    {
        $materielIntermediaire->delete();
        return redirect()->route('materiel.intermediaire.index');
    }

    public function exportIntermediaire(){
        $intermediaires=MaterielIntermediaire::get();
        $monaie=$this->monaie;
        $cout_total=0;
        foreach ($intermediaires as $intermediaire) {




        // foreach ($intermediaires as $intermediaire) {

            $cout_par_entre=0;
            $cout_par_type=0;
            foreach ($intermediaire->entres as $entre) {
                 $cout_par_entre= $entre->cout_achat*$entre->quantite;
                  $cout_par_type=$cout_par_type + $cout_par_entre;
        // }
            // echo $cout_total=$cout_total + $cout_par_entre; echo '</br>';
            }

            $cout_total=$cout_total + $cout_par_type;
        }
        return view('immobilisation.intermediaire.exportCsv', compact('intermediaires','monaie','cout_total'));
    }
}
