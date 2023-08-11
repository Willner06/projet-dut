<?php

namespace App\Http\Controllers;

use App\Models\Decaissement;
use App\Http\Requests\StoreDecaissementRequest;
use App\Http\Requests\UpdateDecaissementRequest;
use App\Models\Cloture;
use App\Models\Compte;
use App\Models\Employe;
use App\Models\Encaissement;
use App\Models\Motif;
use App\Models\Reglement;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class DecaissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $monaie="Fcfa";


     function __construct()
     {
          $this->middleware('permission:Voir les décaissements', ['only' => ['index','show']]);
          $this->middleware('permission:Créer les décaissements', ['only' => ['store']]);
          $this->middleware('permission:Modifier les décaissements', ['only' => ['update']]);
          $this->middleware('permission:Imprimer les décaissements', ['only' => ['createDecaissementPdf']]);
     }


    public function index()
    {
        $monaie=$this->monaie;
        $decaissements=Decaissement::orderBy('created_at','DESC')->get();
        $employers=Employe::get();
        return view('caisse.indexDecaissement',compact('decaissements','monaie','employers'));
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
     * @param  \App\Http\Requests\StoreDecaissementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDecaissementRequest $request)
    {

         $derniereCloture=Cloture::get()->last() ?? '';
         $date_jour = date('Y-m-d');

         if ($derniereCloture == null) {
            $date_derniere_cloture=null;
            $status=1;
         }else{
            $date_derniere_cloture= $derniereCloture->created_at->format('Y-m-d');
            $status=$derniereCloture->status;
         }

        if ($date_derniere_cloture != $date_jour && $status == 0) {
            return redirect()->route('caisse.decaissement.index')->with('cloture','Veuillez clôturer le solde du jour précedant');

        }elseif($date_derniere_cloture != $date_jour && $status == 1){
            $compteDuJour=Compte::whereDate('created_at',date("Y-m-d"))->get();
        $cloture=Cloture::whereDate('created_at',date("Y-m-d"))->get();
        $soldeJourPrecedant=Compte::get()->last();

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


        $decaissement=new Decaissement;
        $decaissement->somme=$request->somme;
        // $decaissement->employe_id=2;
        // $decaissement->demandeur=Employe::find($request->employe_id)->nom." ".Employe::find($request->employe_id)->prenom;
        $decaissement->user_id=Auth::user()->id;
        $decaissement->autorisePar='BOUNDAMAS ODOUMA Manfred Jefferson';
        $decaissement->compte_id=$compte_id;
        $decaissement->code=$request->code;
        $decaissement->save();
        $decaissement->num_piece="JB-".$decaissement->id;
        $decaissement->save();

        $decaissement->employes()->attach($request->employe_id);

            $motif=new Motif;
            $motif->libelle=$request->motif;
            $motif->description=$request->description;
            $motif->decaissement_id=$decaissement->id;
            $motif->save();

        if ($request->motif == "carburant") {
            $reglement= new Reglement;
            $reglement->motif_id=$motif->id;
            $reglement->reglement=false;
            $reglement->save();
        }




        if(!empty($compteDuJour)){
            // $compte_id= $compteDuJour[0]->id;
            $compte= Compte::findOrFail($compte_id);
            $compte->decaissement=$this->totalDecaissement(date("Y-m-d"));
            $compte->encaissement=$this->totalEncaissement(date("Y-m-d"));




            if($soldeJourPrecedant == null){
                 $solde=0 ;
                $solde= $solde-$decaissement->somme;
                 $solde.'<br>';
             }else{
                 $solde = $soldeJourPrecedant->solde-$decaissement->somme;
                 $solde.'<br>';
             }


            $totalEnc=$montanEncaissements=Encaissement::get()->sum('somme');
            $totalDec=$montanEncaissements=Decaissement::get()->sum('somme');
            $compte->solde=$solde;
            $compte->update();

        }
        echo 'ok';
        // if($decaissement){
                        return redirect()->route('caisse.decaissement.index')->with('message','Décaissement éffectué avec succès');
        // }else{
        //     return redirect()->route('caisse.decaissement.index')->with('failed','Décaissment non éffectué');
        // }

        }elseif($date_derniere_cloture == $date_jour && $status == 0){
            $compteDuJour=Compte::whereDate('created_at',date("Y-m-d"))->get();
            $cloture=Cloture::whereDate('created_at',date("Y-m-d"))->get();
            $soldeJourPrecedant=Compte::get()->last();

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


            $decaissement=new Decaissement;
            $decaissement->somme=$request->somme;
            // $decaissement->employe_id=2;
            // dd($request->employe_id);

            // dd( $permissions = Employe::pluck('id','id')->all());
            // $decaissement->demandeur=Employe::find($request->employe_id)->nom." ".Employe::find($request->employe_id)->prenom;
            $decaissement->user_id=Auth::user()->id;
            $decaissement->caissier=Auth::user()->nom." ".Auth::user()->prenom;
            $decaissement->autorisePar='BOUNDAMAS ODOUMA Manfred Jefferson';
            $decaissement->compte_id=$compte_id;
            $decaissement->code=$request->code;
            $decaissement->save();
            $decaissement->num_piece="JB-".$decaissement->id;
            $decaissement->save();

            // foreach ($request->employe_id as $employe) {
            //     echo $employe; echo '</br>';
            // }

            $decaissement->employes()->attach($request->employe_id);


                $motif=new Motif;
                $motif->libelle=$request->motif;
                $motif->description=$request->description;
                $motif->decaissement_id=$decaissement->id;
                $motif->save();

            if ($request->motif == "carburant") {
                $reglement= new Reglement;
                $reglement->motif_id=$motif->id;
                $reglement->reglement=false;
                $reglement->save();
            }




            if(!empty($compteDuJour)){
                // $compte_id= $compteDuJour[0]->id;
                $compte= Compte::findOrFail($compte_id);
                $compte->decaissement=$this->totalDecaissement(date("Y-m-d"));
                $compte->encaissement=$this->totalEncaissement(date("Y-m-d"));




                if($soldeJourPrecedant == null){
                     $solde=0 ;
                    $solde= $solde-$decaissement->somme;
                     $solde.'<br>';
                 }else{
                     $solde = $soldeJourPrecedant->solde-$decaissement->somme;
                     $solde.'<br>';
                 }


                $totalEnc=$montanEncaissements=Encaissement::get()->sum('somme');
                $totalDec=$montanEncaissements=Decaissement::get()->sum('somme');
                $compte->solde=$solde;
                $compte->update();

            }
            // if($decaissement){
                            return redirect()->route('caisse.decaissement.index')->with('message','Décaissement éffectué avec succès');
            // }else{
            //     return redirect()->route('caisse.decaissement.index')->with('failed','Décaissment non éffectué');
            // }

        }elseif($date_derniere_cloture == $date_jour && $status == 1){
            return redirect()->route('caisse.decaissement.index')->with('cloture','Caisse Cloturée pour aujourd\'hui');
        }


    }

    public function totalEncaissement($date){
        $montanEncaissements=Encaissement::whereDate('created_at',$date)->sum('somme');
        return $montanEncaissements;
    }

    public function totalDecaissement($date){
        $montanDecaissements=Decaissement::whereDate('created_at',$date)->sum('somme');
        return $montanDecaissements;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Decaissement  $decaissement
     * @return \Illuminate\Http\Response
     */
    public function show(Decaissement $decaissement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Decaissement  $decaissement
     * @return \Illuminate\Http\Response
     */
    public function edit(Decaissement $decaissement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDecaissementRequest  $request
     * @param  \App\Models\Decaissement  $decaissement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDecaissementRequest $request, Decaissement $decaissement)
    {


        $compteDuJour=Compte::find($decaissement->compte_id);


        $decaissementModifier= $compteDuJour->decaissement-$decaissement->somme;
        $totalDecaissement= $decaissementModifier+ $request->somme;


        $soldeModifier= $compteDuJour->solde+$decaissement->somme;
        $solde= $soldeModifier - $request->somme;

        $compteDuJour->decaissement=$totalDecaissement;
        $compteDuJour->solde=$solde;
       $compteDuJour->update();


        // $decaissement=new Decaissement;
        $decaissement->somme=$request->somme;
        // $decaissement->employe_id=$request->employe_id;
        // $decaissement->user_id=Auth::user()->id;
        $decaissement->autorisePar='BOUNDAMAS ODOUMA Manfred Jefferson';
        // $decaissement->compte_id=$compte_id;
        $decaissement->code=$request->code;
        // $decaissement->save();
        // $decaissement->num_piece="JB-".$decaissement->id;
        $decaissement->update();

        $decaissement->employes()->sync($request->employe_id);

        $motif=Motif::find($decaissement->id);


        if ($motif->libelle == "carburant" && $request->motif != "carburant") {
            $reglement = Reglement::where('motif_id',$motif->id)->first();
            $reglement->delete();
        }


        $motif->libelle=$request->motif;
        $motif->description=$request->description;
        // $motif->decaissement_id=$decaissement->id;
        $motif->update();

        if ($request->motif == "carburant") {
            $reglement= new Reglement;
            $reglement->motif_id=$motif->id;
            $reglement->reglement=false;
            $reglement->save();
        }
        return redirect()->route('caisse.decaissement.index')->with('success','Décaissment éffectué avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Decaissement  $decaissement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Decaissement $decaissement)
    {
        //
    }


//*/*/*/*/*/*/*/*/**/*/*/*/*//*/**/*/*//*/*///***/*/*/*/**/*/*/*/*/*/ */ */ */ */ */ */ */ */ */ */
// ENSEMBLE DES FONCTIONS LIEES AU TRANSPORT

// trie du transport par moi

    public function transportParMois($mois, $annee){
        $communications=Decaissement::whereMonth('created_at',$mois)->whereYear('created_at', $annee)->with('motif')
        ->whereHas('motif',function($query){
            $query->where('libelle','communication');
        })->get();

        $totalMoisEnCour= 0;

        foreach ($communications as $key => $com) {
            $totalMoisEnCour= $totalMoisEnCour+$com->somme;
        }

        return array($communications,$totalMoisEnCour);
    }


// vue de la fiche de transport
    public function transportIndex(){
        // $moisEnCour=date("m");
        // $anneeEnCour=date("Y");

        if (Route::is('caisse.decaissement.searchTransport')) {
            $monaie=$this->monaie;
            $date=$_POST['query'];

            $anneeEnCour=$date[0].$date[1].$date[2].$date[3];
            $moisEnCour=$date[5].$date[6];
            $carbonDate = Carbon::parse($date)->locale(app()->getLocale());
            $date = $carbonDate->isoFormat('MMMM YYYY');
        }else{
            $moisEnCour=date("m");
            $anneeEnCour=date("Y");
            $carbonDate = Carbon::now()->locale(app()->getLocale());
            $date = $carbonDate->isoFormat('MMMM YYYY');
        }


        $prospections=Decaissement::whereMonth('created_at',$moisEnCour)->whereYear('created_at', $anneeEnCour)->with('motif')
                        ->whereHas('motif',function($query){
                            $query->where('libelle','prospection');
                        })->get();

        $interventions=Decaissement::whereMonth('created_at',$moisEnCour)->whereYear('created_at', $anneeEnCour)->with('motif')
                        ->whereHas('motif',function($query){
                            $query->where('libelle','intervention');
                        })->get();
        $procedures=Decaissement::whereMonth('created_at',$moisEnCour)->whereYear('created_at', $anneeEnCour)->with('motif')
                    ->whereHas('motif',function($query){
                        $query->where('libelle','procedure administrative');
                    })->get();
        $livraisons=Decaissement::whereMonth('created_at',$moisEnCour)->whereYear('created_at', $anneeEnCour)->with('motif')
                    ->whereHas('motif',function($query){
                        $query->where('libelle','livraison sur vente');
                    })->get();
        $surveys=Decaissement::whereMonth('created_at',$moisEnCour)->whereYear('created_at', $anneeEnCour)->with('motif')
                    ->whereHas('motif',function($query){
                        $query->where('libelle','survey');
                    })->get();

        $monaie=$this->monaie;

        $transportDuMois=Decaissement::whereMonth('created_at',$moisEnCour)->whereYear('created_at', $anneeEnCour)->with('motif')
        ->whereHas('motif',function($query){
            $query->whereNotIn('libelle',['carburant','communication','autre']);
        })->get();


        $total=$this->totalMois($transportDuMois);
        $totalProspections=$this->totalMois($prospections);
        $totalProcedures=$this->totalMois($procedures);
        $totalSurveys=$this->totalMois($surveys);
        $totalLivraisons=$this->totalMois($livraisons);
        $totalInterventions=$this->totalMois($interventions);


        return view('caisse.ficheTransport',compact('prospections','interventions','procedures','livraisons','surveys','transportDuMois','monaie','date','total','totalProspections','totalProcedures','totalSurveys','totalLivraisons','totalInterventions'));
    }


    // calcule des frais
    public function totalMois($decaissements){
        $totalMois= 0;

    foreach ($decaissements as $decaissement) {
        $totalMois= $totalMois+$decaissement->somme;
    }
    return $totalMois;
}

// FIN DE TRANSPORT
//*/*/*/*/*/*/*/*/**/*/*/*/*//*/**/*/*//*/*///***/*/*/*/**/*/*/*/*/*/ */ */ */ */ */ */ */ */ */ */




//**/*/**//*/*/*/*/*/*/*/***/***//**/*/**/*/*/*//*/****/**/* */ */ */ */ */ */ */ */ */

//  ENSEMBLE DES FUNCTIONS DE COMMUNICATION


    public function searchCommunication(Request $request){

        $monaie=$this->monaie;
        $date=$_POST['query'];

        $annee=$date[0].$date[1].$date[2].$date[3];
        $mois=$date[5].$date[6];

        $CommunicationEnCour=self::communicationParMois($mois, $annee);
        $communications=$CommunicationEnCour[0];
        $totalMoisEnCour=$CommunicationEnCour[1];
        $date=strtotime($date);

        return view('caisse.ficheCommunication',compact('communications','monaie','totalMoisEnCour','date'));

    }


    // trie de communication par mois
    public function communicationParMois($mois, $annee){
        $communications=Decaissement::whereMonth('created_at',$mois)->whereYear('created_at', $annee)->with('motif')
        ->whereHas('motif',function($query){
            $query->where('libelle','communication');
        })->get();

        $totalMoisEnCour= 0;

        foreach ($communications as $key => $com) {
            $totalMoisEnCour= $totalMoisEnCour+$com->somme;
        }

        return array($communications,$totalMoisEnCour);
    }




// vue de la fiche de communication
    public function communicationIndex(){
        $monaie=$this->monaie;
        $moisEnCour=date("m");
        $anneeEnCour=date("Y");
        $moisAnterieur=date("m", strtotime('-1 month'));
        if ($moisEnCour == 1) {
            $AnneeAnterieure=date("Y", strtotime("-1 year"));
        }else{
            $AnneeAnterieure=date('Y');
        }

        $communicationEnCour=self::communicationParMois($moisEnCour, $anneeEnCour);
        $communications=$communicationEnCour[0];
        $totalMoisEnCour=$communicationEnCour[1];

        $communicationAnterieur=self::communicationParMois($moisAnterieur, $AnneeAnterieure);
        $communicationAnterieurs=$communicationAnterieur[0];
        $totalMoisAnterieur=$communicationAnterieur[1];

        $difference=$totalMoisEnCour-$totalMoisAnterieur;

        return view('caisse.ficheCommunication',compact('communications','monaie','totalMoisEnCour','totalMoisAnterieur','difference'));
    }


// FIN COMMUNICATION

// fiche autre decaissements

public function autreDecaissementParMois($mois, $annee){
    $autres=Decaissement::whereMonth('created_at',$mois)->whereYear('created_at', $annee)->with('motif')
    ->whereHas('motif',function($query){
        $query->where('libelle','autre');
    })->get();

    $totalMoisEnCour= 0;

    foreach ($autres as $key => $car) {
        $totalMoisEnCour= $totalMoisEnCour+$car->somme;
    }

    return array($autres,$totalMoisEnCour);
}


public function autreDecaissementIndex(){
    $monaie=$this->monaie;
    $moisEnCour=date("m");
    $anneeEnCour=date("Y");
    $moisAnterieur=date("m", strtotime('-1 month'));
    if ($moisEnCour == 1) {
        $AnneeAnterieure=date("Y", strtotime("-1 year"));
    }else{
        $AnneeAnterieure=date('Y');
    }

    $autreEnCour=self::autreDecaissementParMois($moisEnCour, $anneeEnCour);
    $autres=$autreEnCour[0];
    $totalMoisEnCour=$autreEnCour[1];

    $autreAnterieur=self::autreDecaissementParMois($moisAnterieur, $AnneeAnterieure);
    $autreAnterieurs=$autreAnterieur[0];
    $totalMoisAnterieur=$autreAnterieur[1];

    $difference=$totalMoisEnCour-$totalMoisAnterieur;

    return view('caisse.autreDecaissement',compact('autres','monaie','totalMoisEnCour','totalMoisAnterieur','difference'));
}

public function searchAutreDecaissement(Request $request){

    $monaie=$this->monaie;
    $date=$_POST['query'];

    $annee=$date[0].$date[1].$date[2].$date[3];
    $mois=$date[5].$date[6];

    $autreEnCour=self::autreDecaissementParMois($mois, $annee);
    $autres=$autreEnCour[0];
    $totalMoisEnCour=$autreEnCour[1];
    $date=strtotime($date);

    return view('caisse.autreDecaissement',compact('autres','monaie','totalMoisEnCour','date'));

}



// FIN AUTRE DECAISSEMENT



//*/*/*/*/*/*/*/*/*/**/*//**/*/*/**/*/**/*////***/*/*/*/*/*/*/*/*/** */ */ */ */ */ */




//**/*/*/*/**/*/*/*//*///*//*/**/*/*/*/*/*/*//*/*/*/*//*/ */ */ *//*/*/*//*//*/*/*/*/


// FONCTIONS LIEES AU CARBURANT




    // trie de carburant par mois
    public function carburantParMois($mois, $annee){
        $carburants=Decaissement::whereMonth('created_at',$mois)->whereYear('created_at', $annee)->with('motif')
        ->whereHas('motif',function($query){
            $query->where('libelle','carburant');
        })->get();

        $totalMoisEnCour= 0;

        foreach ($carburants as $key => $car) {
            $totalMoisEnCour= $totalMoisEnCour+$car->somme;
        }

        return array($carburants,$totalMoisEnCour);
    }

    // vue index de la fiche de carburant
    public function carburantIndex(){
        $monaie=$this->monaie;
        $moisEnCour=date("m");
        $anneeEnCour=date("Y");

        $moisAnterieur=date("m", strtotime("-1 month"));
        if ($moisEnCour == 1) {
            $AnneeAnterieure=date("Y", strtotime("-1 year"));
        }else{
            $AnneeAnterieure=date('Y');
        }

        $CarburantEnCour=self::carburantParMois($moisEnCour, $anneeEnCour);
        $carburants=$CarburantEnCour[0];
        $totalMoisEnCour=$CarburantEnCour[1];

        $CarburantAnterieur=self::carburantParMois($moisAnterieur, $AnneeAnterieure);
        $carburantAnterieurs=$CarburantAnterieur[0];
        $totalMoisAnterieur=$CarburantAnterieur[1];


        return view('caisse.ficheCarburant',compact('monaie','carburants','totalMoisEnCour','carburantAnterieurs', 'totalMoisAnterieur'));
    }
    // recherche de carburant
    public function searchCarburant(Request $request){

        $monaie=$this->monaie;
        $date=$_POST['query'];

        $annee=$date[0].$date[1].$date[2].$date[3];
        $mois=$date[5].$date[6];

        $CarburantEnCour=self::carburantParMois($mois, $annee);
        $carburants=$CarburantEnCour[0];
        $totalMoisEnCour=$CarburantEnCour[1];

        return view('caisse.ficheCarburant',compact('monaie','carburants','totalMoisEnCour', 'mois', 'annee'));

    }


// FIN DE CARBURANT

///*/*//*//*/*/*/*/*/*/*/*/*/*//*/*/*/*/**/**/***/*/*/*/*/*/*/*/*/*/***//*/*///*/* */ */ */ */

// ENSEMBLE DES FONCTIONS DE CLOTURE DE CAISSE

    // vue fiche de clôture de caisse

    public function clotureDeCaisseIndex()
    {
        $monaie=$this->monaie;

        if (Route::is('cloture.search')) {
            $date=$_POST['query'];

            $anneeEnCour=$date[0].$date[1].$date[2].$date[3];
            $moisEnCour=$date[5].$date[6];
            $date=strtotime($date);
            $date=date("M Y",$date);

            $clotures=Cloture::whereMonth('created_at',$moisEnCour)
            ->whereYear('created_at',$anneeEnCour)->get();
        }else{
            $moisEnCour=date("m");
            $anneeEnCour=date("Y");
            $date=date("M Y");

            $clotures=Cloture::whereMonth('created_at',$moisEnCour)
            ->whereYear('created_at',$anneeEnCour)
            ->orWhere('status',0)->get();


        }
        $compte=Compte::get()->last();
        // $date=date("m");


        // $clotures=Cloture::whereMonth('created_at',$moisEnCour)
        // ->whereYear('created_at',$anneeEnCour)
        // ->orWhere('status',0)->get();


        return view('caisse.clotureCaisse',compact('monaie','clotures', 'compte'));
    }

    public function createDecaissementPdf($id){
        $decaissement=Decaissement::findOrFail($id);

        $pdf = PDF::loadView('caisse.exportDecaissement', compact('decaissement'));

        return $pdf->setPaper('a4', 'portrait')
            ->setWarnings(true)
            ->stream();
    }











}
