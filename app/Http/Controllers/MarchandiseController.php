<?php

namespace App\Http\Controllers;

use App\Models\Marchandise;
use App\Http\Requests\StoreMarchandiseRequest;
use App\Http\Requests\UpdateMarchandiseRequest;
use App\Models\CategorieMarchandise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MarchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public $monaie="Fcfa";

     function __construct()
     {
          $this->middleware('permission:Voir les marchandises', ['only' => ['index']]);
        //   $this->middleware('permission:decaissement-create', ['only' => ['create','store']]);
        //   $this->middleware('permission:decaissement-edit', ['only' => ['edit','update']]);
        //   $this->middleware('permission:decaissement-delete', ['only' => ['destroy']]);
     }
    public function index()
    {
        $marchandises=Marchandise::get();
        $categories=CategorieMarchandise::get();
        return view('marchandise.index',compact('marchandises','categories'));
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
     * @param  \App\Http\Requests\StoreMarchandiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarchandiseRequest $request)
    {
        $marchandise=new Marchandise;
        $marchandise->reference=$request->reference;
        $marchandise->designation=$request->designation;
        $marchandise->prix_unitaire=$request->prix_unitaire;
        $marchandise->lieu=$request->lieu;
        $marchandise->user_id=Auth::user()->id;
        $marchandise->categorie_id=$request->categorie_id;
        $marchandise->save();

        return redirect()->route('marchandise.show', $marchandise->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marchandise  $marchandise
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marchandise=Marchandise::findOrFail($id);
        $monaie=$this->monaie;
        return view('marchandise.show', compact('marchandise','monaie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marchandise  $marchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(Marchandise $marchandise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarchandiseRequest  $request
     * @param  \App\Models\Marchandise  $marchandise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarchandiseRequest $request, Marchandise $marchandise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marchandise  $marchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $marchandise= Marchandise::findOrFail($id);
        // $marchandise->delete();
        // return redirect()->back();
        echo "ok";



    }


}
