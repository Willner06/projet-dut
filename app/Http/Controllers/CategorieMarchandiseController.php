<?php

namespace App\Http\Controllers;

use App\Models\CategorieMarchandise;
use App\Http\Requests\StoreCategorieMarchandiseRequest;
use App\Http\Requests\UpdateCategorieMarchandiseRequest;

class CategorieMarchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= CategorieMarchandise::get();
        return view('marchandise.categories.index',compact('categories'));
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
     * @param  \App\Http\Requests\StoreCategorieMarchandiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategorieMarchandiseRequest $request)
    {
        $categorie = new CategorieMarchandise;
        $categorie->libelle=$request->libelle;
        $categorie->save();
        return redirect()->route('marchandise.categorie.index')->with('message', 'Catégorie enregistrée avec succes');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategorieMarchandise  $categorieMarchandise
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorie=CategorieMarchandise::findOrfail($id);
        echo $categorie;

        return view('marchandise.categories.show',compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorieMarchandise  $categorieMarchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(CategorieMarchandise $categorieMarchandise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategorieMarchandiseRequest  $request
     * @param  \App\Models\CategorieMarchandise  $categorieMarchandise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorieMarchandiseRequest $request, CategorieMarchandise $categorieMarchandise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorieMarchandise  $categorieMarchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorieMarchandise $categorieMarchandise)
    {
        $categorieMarchandise->delete();
        return redirect()->route('marchandise.categorie.index');
    }
}
