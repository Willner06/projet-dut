<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use Illuminate\Support\Str;


class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = Employe::get();
        $id=1;
        return view('employe.index', compact('employes','id'));
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
     * @param  \App\Http\Requests\StoreEmployeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeRequest $request)
    {
        if (!Str::endsWith($request->email, '@jobs-conseil.com')) {
            return back()->withErrors(['email' => 'L\'adresse email doit se terminer par "@jobs-conseil.com"']);
        }
        $employe = new Employe();
        $employe->nom= $request->nom;
        $employe->email= $request->email;
        $employe->prenom= $request->prenom;
        $employe->fonction= $request->fonction;
        $employe->save();

        return redirect()->route('employes.index')->with('message', 'Employer enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeRequest  $request
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeRequest $request, Employe $employe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->route('employes.index')->with('message', 'Employer retiré avec succès');
    }
}
