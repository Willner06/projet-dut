<?php

namespace App\Http\Controllers;

use App\Models\Encaissement;
use App\Http\Requests\StoreEncaissementRequest;
use App\Http\Requests\UpdateEncaissementRequest;
use App\Models\Cloture;
use App\Models\Compte;
use App\Models\Decaissement;
use Illuminate\Support\Facades\Auth;
use PDF;

class EncaissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {
          $this->middleware('permission:Voir les encaissements', ['only' => ['index','show']]);
          $this->middleware('permission:Créer les encaissements', ['only' => ['store']]);
          $this->middleware('permission:Modifier les encaissements', ['only' => ['update']]);
          $this->middleware('permission:Imprimer les encaissements', ['only' => ['createEncaissementPdf']]);
     }


     public $monaie="Fcfa";


    public function index()
    {
        $monaie=$this->monaie;
        $encaissements=Encaissement::get();
        return view('caisse.encaissement',compact('encaissements','monaie'));
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
     * @param  \App\Http\Requests\StoreEncaissementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEncaissementRequest $request)
    {

        $derniereCloture=Cloture::get()->last();
         $date_jour = date('Y-m-d');

         if ($derniereCloture == null) {
            $date_derniere_cloture=null;
            $status=1;
         }else{
            $date_derniere_cloture= $derniereCloture->created_at->format('Y-m-d');
            $status=$derniereCloture->status;
         }

        if ($date_derniere_cloture != $date_jour && $status == 0) {
            return redirect()->route('caisse.encaissement.index')->with('cloture','Veuillez clôturer le solde du jour précedant');

        }elseif($date_derniere_cloture != $date_jour && $status == 1){
            $compteDuJour=Compte::whereDate('created_at',date("Y-m-d"))->get();
        $cloture=Cloture::whereDate('created_at',date("Y-m-d"))->get();
        $soldeJourPrecedant=Compte::get()->last();


        // echo $compte;

        if (empty($cloture[0])) {
            $cloture= new Cloture;
            $cloture->agent_caisse=Auth::user()->nom;
            $cloture->save();
        }

        if (empty($compteDuJour[0])) {
            $compte= new Compte;
            $compte->cloture_id=$cloture->id;
            $compte->save();
            $compte_id=$compte->id;
        }else{
            $compte_id=$compteDuJour[0]->id;
        }


        $encaissement=new Encaissement;
        $encaissement->somme=$request->somme;
        $encaissement->deposant=$request->deposant;
        $encaissement->motif=$request->motif;
        // $encaissement->code=$request->code;
        $encaissement->user_id=Auth::user()->id;
        $encaissement->compte_id=$compte_id;
        $encaissement->save();
        $encaissement->num_piece="JBE-".$encaissement->id;
        $encaissement->save();


        if(!empty($compteDuJour)){
            // $compte_id= $compteDuJour[0]->id;
            $compte= Compte::findOrFail($compte_id);
            $compte->decaissement=$this->totalDecaissement(date("Y-m-d"));
            $compte->encaissement=$this->totalEncaissement(date("Y-m-d"));




            if($soldeJourPrecedant == null){
               echo $solde=0;
               $solde= $solde+$encaissement->somme;
               echo $solde.'<br>';
            }else{
                $solde = $soldeJourPrecedant->solde+$encaissement->somme;
               echo $solde.'<br>';
            }

            $totalEnc=$montanEncaissements=Encaissement::get()->sum('somme');
            $totalDec=$montanEncaissements=Decaissement::get()->sum('somme');
            $compte->solde=$solde;
            $compte->update();

        }

        return redirect()->route('caisse.encaissement.index')->with('message','Encaissement effectué avec succes');


        }elseif($date_derniere_cloture == $date_jour && $status == 0){
            $compteDuJour=Compte::whereDate('created_at',date("Y-m-d"))->get();
        $cloture=Cloture::whereDate('created_at',date("Y-m-d"))->get();
        $soldeJourPrecedant=Compte::get()->last();


        // echo $compte;

        if (empty($cloture[0])) {
            $cloture= new Cloture;
            $cloture->agent_caisse=Auth::user()->name;
            $cloture->save();
        }

        if (empty($compteDuJour[0])) {
            $compte= new Compte;
            $compte->cloture_id=$cloture->id;
            $compte->save();
            $compte_id=$compte->id;
        }else{
            $compte_id=$compteDuJour[0]->id;
        }


        $encaissement=new Encaissement;
        $encaissement->somme=$request->somme;
        $encaissement->deposant=$request->deposant;
        $encaissement->motif=$request->motif;
        // $encaissement->code=$request->code;
        $encaissement->user_id=Auth::user()->id;
        $encaissement->compte_id=$compte_id;
        $encaissement->save();
        $encaissement->num_piece="JBE-".$encaissement->id;
        $encaissement->save();


        if(!empty($compteDuJour)){
            // $compte_id= $compteDuJour[0]->id;
            $compte= Compte::findOrFail($compte_id);
            $compte->decaissement=$this->totalDecaissement(date("Y-m-d"));
            $compte->encaissement=$this->totalEncaissement(date("Y-m-d"));




            if($soldeJourPrecedant == null){
               echo $solde=0;
               $solde= $solde+$encaissement->somme;
               echo $solde.'<br>';
            }else{
                $solde = $soldeJourPrecedant->solde+$encaissement->somme;
               echo $solde.'<br>';
            }

            $totalEnc=$montanEncaissements=Encaissement::get()->sum('somme');
            $totalDec=$montanEncaissements=Decaissement::get()->sum('somme');
            $compte->solde=$solde;
            $compte->update();

        }

        return redirect()->route('caisse.encaissement.index')->with('message','Encaissement effectué avec succes');


        }elseif($date_derniere_cloture == $date_jour && $status == 1){
            return redirect()->route('caisse.encaissement.index')->with('cloture','Caisse Cloturée pour aujourd\'hui');
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Encaissement  $encaissement
     * @return \Illuminate\Http\Response
     */
    public function show(Encaissement $encaissement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Encaissement  $encaissement
     * @return \Illuminate\Http\Response
     */
    public function edit(Encaissement $encaissement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEncaissementRequest  $request
     * @param  \App\Models\Encaissement  $encaissement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEncaissementRequest $request, Encaissement $encaissement)
    {

         $compteDuJour=Compte::find($encaissement->compte_id);

         $compteDuJour->encaissement;

         $encaissementModifier= $compteDuJour->encaissement-$encaissement->somme;
         $totalEncaissement= $encaissementModifier+ $request->somme;

         $compteDuJour->solde;

         $soldeModifier= $compteDuJour->solde-$encaissement->somme;
         $solde= $soldeModifier+ $request->somme;

         $compteDuJour->encaissement=$totalEncaissement;
         $compteDuJour->solde=$solde;
        $compteDuJour->update();


        $encaissement->somme=$request->somme;
        $encaissement->deposant=$request->deposant;
        $encaissement->motif=$request->motif;
        $encaissement->update();




        return redirect()->back()->with('message','Encaissement modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Encaissement  $encaissement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Encaissement $encaissement)
    {
        //
    }


    public function totalEncaissement($date){
        $montanEncaissements=Encaissement::whereDate('created_at',$date)->sum('somme');
        return $montanEncaissements;
    }

    public function totalDecaissement($date){
        $montanDecaissements=Decaissement::whereDate('created_at',$date)->sum('somme');
        return $montanDecaissements;
    }


    public function createEncaissementPdf($id){
        $encaissement=Encaissement::findOrFail($id);

        $pdf = PDF::loadView('caisse.exportEncaissement', compact('encaissement'));

        return $pdf->setPaper('a4', 'portrait')
            ->setWarnings(true)
            ->stream();
    }

}
