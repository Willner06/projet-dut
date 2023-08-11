<?php

namespace App\Http\Controllers;

use App\Models\CategorieMateriel;
use App\Http\Requests\StoreCategorieMaterielRequest;
use App\Http\Requests\UpdateCategorieMaterielRequest;
use Illuminate\Http\Request;

class CategorieMaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $monaie="Fcfa";
    public function index()
    {
        $monaie=$this->monaie;
        $categories= CategorieMateriel::get();



        $cout_total=0;
        foreach ($categories as $categorie) {
            $cout=0;
            foreach ($categorie->materiels->where('statut','!=','mise_au_rebut') as $mat) {
                $cout=$cout+$mat->cout_acquisitionTtc;
            }
            $cout_total=$cout_total+$cout;
        }
        return view('immobilisation.categorie.index', compact('categories','monaie', 'cout_total'));
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
     * @param  \App\Http\Requests\StoreCategorieMaterielRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categorie = new CategorieMateriel();
        $categorie->libelle = $request->libelle;
        $categorie->save();
        return redirect()->route('materiel.categorie.index')->with('message','Catégorie enregistrée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategorieMateriel  $categorieMateriel
     * @return \Illuminate\Http\Response
     */
    public function show(CategorieMateriel $categorie)
    {
        // echo $categorie;
        $monaie=$this->monaie;
        return view('immobilisation.show', compact('categorie','monaie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorieMateriel  $categorieMateriel
     * @return \Illuminate\Http\Response
     */
    public function edit(CategorieMateriel $categorieMateriel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategorieMaterielRequest  $request
     * @param  \App\Models\CategorieMateriel  $categorieMateriel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorieMaterielRequest $request, CategorieMateriel $categorieMateriel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorieMateriel  $categorieMateriel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorieMateriel $categorieMateriel)
    {
        $categorieMateriel->delete();
        return redirect()->back()->with('message',' Catégorie supprimée avec succès');
    }
}
