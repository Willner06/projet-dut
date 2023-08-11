<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use App\Http\Requests\StoreMaterielRequest;
use App\Http\Requests\UpdateMaterielRequest;
use App\Models\CategorieMateriel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MaterielController extends Controller
{
    public $monaie=" Fcfa";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiels=Materiel::get();
        $categories=CategorieMateriel::get();
        return view('immobilisation.indexmateriel', compact('materiels','categories','monaie'));
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
     * @param  \App\Http\Requests\StoreMaterielRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaterielRequest $request)
    {
        $materiel= new Materiel;

        $materiel->categorie_id=$request->categorie_id;
        $materiel->code_inventaire=$request->code_inventaire;
        $materiel->designation=$request->designation;
        $materiel->date_acquisition=$request->date_acquisition;
        $materiel->prix_achat=$request->prix_achat;
        $materiel->autres_frais=$request->autres_frais;
        $materiel->cout_acquisitionTtc=$request->cout_acquisitionTtc;
        $materiel->tva=$request->tva;
        $materiel->affectation=$request->affectation;
        $materiel->etat=$request->etat;
        $materiel->fournisseur=$request->fournisseur;
        $materiel->qr_code=$request->qr_code;
        $materiel->base_ammortisable=$request->base_ammortisable;
        $materiel->mode_ammortissement=$request->mode_ammortissement;
        $materiel->duree_ammortissement=$request->duree_ammortissement;

        $path = 'qrcode/'.$request->designation."_".time().'.png';

        $materiel->qr_code=$path;

        $materiel->save();
        QrCode::format('png')->merge('img-jb-gestion/logo.png', 0.1, true)->size(300)->generate(route('materiel.info',$materiel->id), $path);
        return redirect()->route('materiel.show',$materiel->id)->with('message','Matériel ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function show(Materiel $materiel)
    {
        $monaie=$this->monaie;
        $categories=CategorieMateriel::get();

                // Valeur brute du matériel
        $valeur_brute = $materiel->base_ammortisable;
        // Durée d'amortissement en années
        $duree_amortissement = $materiel->duree_ammortissement;

        $date_mise_en_service = $materiel->date_acquisition;


        $date_fin=date('d-m-Y', strtotime($date_mise_en_service. $duree_amortissement.' year' ));
        $nb_jour=365*$duree_amortissement;



        $annee_mise_en_service = date('Y', strtotime($date_mise_en_service));
        $annee_fin = date('Y', strtotime($date_fin));



        // $debut_premiere_anne="$annee_mise_en_service-01-01";
        $fin_premiere_annee="$annee_mise_en_service-12-31";

        $debut_derniere_anne="$annee_fin-01-01";
        // $fin_derniere_annee="$annee_fin-12-31";

        // Taux d'amortissement annuel
        $taux_amortissement_annuel = 1 / $duree_amortissement;
        $taux_amortissement_journalier = 1 / $nb_jour;

        // $date_fin=date('d-m-Y', strtotime($date_mise_en_service. $duree_amortissement.' year' ));



        $nb_jour_premiere_anne=$this->nombreDeJour($date_mise_en_service, $fin_premiere_annee);
        $nb_jour_derniere_anne=$this->nombreDeJour($debut_derniere_anne, $date_fin);


        $amortissement_premiere_annee=(round($taux_amortissement_journalier*$nb_jour_premiere_anne*$valeur_brute,0));
        $amortissement_derniere_annee=(round($nb_jour_derniere_anne*$taux_amortissement_journalier*$valeur_brute,0));

        $amortissement_derniere_annee+$amortissement_premiere_annee;


        $amortissement_annuel=(round($taux_amortissement_annuel*$valeur_brute,0));

        $id=1;

        $taux=round(($taux_amortissement_annuel * 100),0);
        return view('immobilisation.showMateriel', compact('materiel','monaie','categories','amortissement_derniere_annee','amortissement_premiere_annee','amortissement_annuel','id','taux'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function edit(Materiel $materiel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMaterielRequest  $request
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaterielRequest $request, Materiel $materiel)
    {
        $materiel->categorie_id=$request->categorie_id;
        $materiel->code_inventaire=$request->code_inventaire;
        $materiel->designation=$request->designation;
        $materiel->date_acquisition=$request->date_acquisition;
        $materiel->prix_achat=$request->prix_achat;
        $materiel->autres_frais=$request->autres_frais;
        $materiel->cout_acquisitionTtc=$request->cout_acquisitionTtc;
        $materiel->tva=$request->tva;
        $materiel->affectation=$request->affectation;
        $materiel->etat=$request->etat;
        $materiel->fournisseur=$request->fournisseur;
        // $materiel->qr_code=$request->qr_code;
        $materiel->base_ammortisable=$request->base_ammortisable;
        $materiel->mode_ammortissement=$request->mode_ammortissement;
        $materiel->duree_ammortissement=$request->duree_ammortissement;

        $materiel->date_mise_au_rebut=$request->date_mise_au_rebut;
        $materiel->date_session=$request->date_session;
        $materiel->valeur_net_comptable=$request->valeur_net_comptable;
        $materiel->prix_vente_valeur_reprise=$request->prix_vente_valeur_reprise;
        $materiel->plus_value_globale=$request->plus_value_globale;
        $materiel->dont_court_terme=$request->dont_court_terme;
        $materiel->dont_long_terme=$request->dont_long_terme;


        if($materiel->date_mise_au_rebut == null && $materiel->date_session == null) {
            echo $materiel->statut="actif";
        }
        if($materiel->date_mise_au_rebut != null && $materiel->date_session == null) {
            echo $materiel->statut="mise_au_rebut";
        }
        if($materiel->date_mise_au_rebut == null && $materiel->date_session != null) {
            echo $materiel->statut="cede";
        }
        if($materiel->date_mise_au_rebut != null && $materiel->date_session != null) {
            echo $materiel->statut="mise_au_rebut";
        }

        if ( file_exists($materiel->qr_code) ) {
            unlink($materiel->qr_code);
            echo 'supprimer';
            // echo $materiel->qr_code;
        }else{
            echo 'n\'existe pas';
            echo $materiel->qr_code;
        }

        // unlink($materiel->qr_code);
        // echo $materiel->date_acquisition;
        $path = 'qrcode/'.$request->designation."_".time().'.png';

        $materiel->qr_code=$path;

        QrCode::format('png')->merge('img-jb-gestion/logo.png', 0.1, true)->size(300)->generate(route('materiel.info',$materiel->id), $path);

        $materiel->update();


        return redirect()->back()->with('message','Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materiel $materiel)
    {
        unlink($materiel->qr_code);
        $materiel->delete();
        return redirect()->back()->with('message','Matériel supprimer');
    }

    public function generateQrcode(){
    //     $image = QrCode::format('png')
    //                      ->merge('img-jb-gestion/logo.png', 0.5, true)
    //                      ->size(500)->errorCorrection('H')
    //                      ->generate('A simple example of QR code!');
    //   return response($image)->header('Content-type','image/png');

    // $qrcode=QrCode::size(300)->generate(route('materiel.show',1));

    return view('immobilisation.qrcode');
        // phpinfo();

    }

// public function infoMateriel(Materiel $materiel)
// {
//     $monaie=$this->monaie;
//     $categories=CategorieMateriel::get();
//     return view('immobilisation.info', compact('materiel','monaie','categories'));
// }

public function infoMateriel(Materiel $materiel)
{
    $monaie=$this->monaie;
    $categories=CategorieMateriel::get();

// Valeur brute du matériel
$valeur_brute = $materiel->base_ammortisable;
// Durée d'amortissement en années
$duree_amortissement = $materiel->duree_ammortissement;

$date_mise_en_service = $materiel->date_acquisition;


$date_fin=date('d-m-Y', strtotime($date_mise_en_service. $duree_amortissement.' year' ));
$nb_jour=365*$duree_amortissement;



$annee_mise_en_service = date('Y', strtotime($date_mise_en_service));
$annee_fin = date('Y', strtotime($date_fin));



// $debut_premiere_anne="$annee_mise_en_service-01-01";
$fin_premiere_annee="$annee_mise_en_service-12-31";

$debut_derniere_anne="$annee_fin-01-01";
// $fin_derniere_annee="$annee_fin-12-31";

// Taux d'amortissement annuel
$taux_amortissement_annuel = 1 / $duree_amortissement;
$taux_amortissement_journalier = 1 / $nb_jour;

// $date_fin=date('d-m-Y', strtotime($date_mise_en_service. $duree_amortissement.' year' ));



$nb_jour_premiere_anne=$this->nombreDeJour($date_mise_en_service, $fin_premiere_annee);
$nb_jour_derniere_anne=$this->nombreDeJour($debut_derniere_anne, $date_fin);


$amortissement_premiere_annee=(round($taux_amortissement_journalier*$nb_jour_premiere_anne*$valeur_brute,0));
$amortissement_derniere_annee=(round($nb_jour_derniere_anne*$taux_amortissement_journalier*$valeur_brute,0));

$amortissement_derniere_annee+$amortissement_premiere_annee;


$amortissement_annuel=(round($taux_amortissement_annuel*$valeur_brute,0));

$id=1;

$taux=round(($taux_amortissement_annuel * 100),0);

return view('immobilisation.info', compact('materiel','monaie','categories','amortissement_derniere_annee','amortissement_premiere_annee','amortissement_annuel','id','taux'));


}


public function dateDeFin($date_acquisition, $duree){
    // On transforme les 2 dates en timestamp
    $date_acquisition = $date_acquisition;

    //durée à rajouter : 6 mois;
    $duree = 1;

    //la première étape est de transformer cette date en timestamp
    $date_acquisitionTimestamp = strtotime($date_acquisition);

    //on calcule la date de fin
    return $dateFin = date('d-m-Y', strtotime($date_acquisition. $duree.' year' ));
}

public function dateDeLaPremiereAnnee($date_acquisition){

    $anneePremiereAnnee=$date_acquisition->format('y');
    return $datePremiereAnne="01-01-$anneePremiereAnnee";

}

public function nombreDeJour($date_acquisition, $dateFin){
    // On transforme les 2 dates en timestamp
    $date1 = strtotime($date_acquisition);
    $date2 = strtotime($dateFin);

    // On récupère la différence de timestamp entre les 2 précédents
    $nbJoursTimestamp = $date2 - $date1;

    // ** Pour convertir le timestamp (exprimé en secondes) en jours **
    // On sait que 1 heure = 60 secondes * 60 minutes et que 1 jour = 24 heures donc :
    return $nbJours = ($nbJoursTimestamp/86400); // 86 400 = 60*60*24
}

public function export_materiel(){
    $categories=CategorieMateriel::get();
    $monaie='Fcfa';
    return view('immobilisation.exportCsv', compact('categories','monaie'));
 }


public function csv(Materiel $materiel)
{
    $monaie=$this->monaie;
    $categories=CategorieMateriel::get();

// Valeur brute du matériel
$valeur_brute = $materiel->base_ammortisable;
// Durée d'amortissement en années
$duree_amortissement = $materiel->duree_ammortissement;

$date_mise_en_service = $materiel->date_acquisition;


$date_fin=date('d-m-Y', strtotime($date_mise_en_service. $duree_amortissement.' year' ));
$nb_jour=364*$duree_amortissement;



$annee_mise_en_service = date('Y', strtotime($date_mise_en_service));
$annee_fin = date('Y', strtotime($date_fin));



// $debut_premiere_anne="$annee_mise_en_service-01-01";
$fin_premiere_annee="$annee_mise_en_service-12-31";

$debut_derniere_anne="$annee_fin-01-01";
// $fin_derniere_annee="$annee_fin-12-31";

// Taux d'amortissement annuel
$taux_amortissement_annuel = 1 / $duree_amortissement;
$taux_amortissement_journalier = 1 / $nb_jour;

// $date_fin=date('d-m-Y', strtotime($date_mise_en_service. $duree_amortissement.' year' ));



$nb_jour_premiere_anne=$this->nombreDeJour($date_mise_en_service, $fin_premiere_annee);
$nb_jour_derniere_anne=$this->nombreDeJour($debut_derniere_anne, $date_fin);


$amortissement_premiere_annee=(round($taux_amortissement_journalier*$nb_jour_premiere_anne*$valeur_brute,0));
$amortissement_derniere_annee=(round($nb_jour_derniere_anne*$taux_amortissement_journalier*$valeur_brute,0));

$amortissement_derniere_annee+$amortissement_premiere_annee;


$amortissement_annuel=(round($taux_amortissement_annuel*$valeur_brute,0));

$id=1;

$taux=round(($taux_amortissement_annuel * 100),0);

return view('immobilisation.csvMateriel', compact('materiel','monaie','categories','amortissement_derniere_annee','amortissement_premiere_annee','amortissement_annuel','id','taux'));


}


}
