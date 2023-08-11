<?php

namespace App\Http\Controllers;

use App\Models\Decaissement;
use App\Models\Encaissement;
use App\Models\SuiviTier;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;
use Carbon\Carbon;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $monaie="F cfa";
    public function caisseHome()
    {
         $decaissements_mois = Decaissement::selectRaw('YEAR(created_at) as year, MONTH(created_at) as mois, SUM(somme) as total_somme')
        ->groupBy('year', 'mois')
        ->get() .'<br>';


 $decaissements_mois = DB::table('decaissements')
->select(
         DB::raw('MONTH(created_at) as mois'),
         DB::raw('YEAR(created_at) as annee'),
         DB::raw('sum(somme) as total'))
->groupBy(
          DB::raw('YEAR(created_at)'),
          DB::raw('MONTH(created_at)'))
->get();



 $resultat_mois = DB::table('comptes')
->selectRaw('YEAR(created_at) as annee, MONTH(created_at) as mois, SUM(decaissement) as decaissements, SUM(encaissement) as encaissements')
->groupBy('annee','mois')
->get();

$resultat_annee = DB::table('comptes')
->selectRaw('YEAR(created_at) as annee, SUM(decaissement) as decaissements, SUM(encaissement) as encaissements')
->groupBy('annee')
->get();

 $resultat_jour = DB::table('comptes')
->selectRaw('YEAR(created_at) as annee, MONTH(created_at) as mois, DATE(created_at) as date, SUM(decaissement) as decaissements, SUM(encaissement) as encaissements')
->groupBy('annee','mois','date')
->get();

$resultat_trimestre = DB::table('comptes')
->selectRaw('YEAR(created_at) as annee, QUARTER(created_at) as trimestre, SUM(decaissement) as decaissements, SUM(encaissement) as encaissements')
->groupBy('annee','trimestre')
->get();

$resultat_semaine = DB::table('comptes')
->selectRaw('YEAR(created_at) as annee, MONTH(created_at) as mois, WEEK(created_at) as semaine, SUM(decaissement) as decaissements, SUM(encaissement) as encaissements')
->groupBy('annee','mois','semaine')
->get();


        return view('caisse.dashboard', compact('resultat_annee','resultat_mois','resultat_jour','resultat_trimestre','resultat_semaine'));
    }





    public function tiersHome(){

        $monaie=$this->monaie;


            // par client CA

     $caParClient = DB::table('suivi_tiers AS st')
            ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
            ->select('t.nom', 't.prenom', DB::raw('SUM( st.debit) AS ca'))
            ->where('t.statut','client')
            ->groupBy('st.tiers_id', 't.nom', 't.prenom')
            ->get();



     $caTotalClient = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        ->where('t.statut','client')
        ->sum('credit');


     $caMensuel = DB::table('suivi_tiers AS st')
     ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        ->select(DB::raw('YEAR(st.created_at) AS annee, MONTH(st.created_at) AS mois, SUM(st.debit) AS ca'))
        ->where('t.statut','client')
        ->groupBy('annee','mois')
        ->get();


     $totalDebitClient = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        ->where('t.statut','client')
        ->sum('debit');



     $montantNomRecouvre=$totalDebitClient - $caTotalClient;


            ////////////////////////////////////



// Autres tiers

    $caParAutretiers = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        ->select('t.nom', 't.prenom', DB::raw('SUM( st.debit) AS ca'))
        ->where('t.statut','autre')
        ->groupBy('st.tiers_id', 't.nom', 't.prenom')
        ->get();



    $caTotalAutre = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        ->where('t.statut','autre')
        ->sum('credit');


    $caMensuelAutre = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
           ->select(DB::raw('YEAR(st.created_at) AS annee, MONTH(st.created_at) AS mois, SUM(st.debit) AS ca'))
           ->where('t.statut','autre')
           ->groupBy('annee','mois')
           ->get();


    $totalDebitAutre = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        ->where('t.statut','autre')
        ->sum('debit');

    $montantNomRecouvreAutre=$totalDebitAutre - $caTotalAutre;
        /////////////////////////*



    // Fournissuers

    $achatMensuel = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
           ->select(DB::raw('YEAR(st.created_at) AS annee, MONTH(st.created_at) AS mois, SUM(st.debit) AS ca'))
           ->where('t.statut','fournisseur')
           ->groupBy('annee','mois')
           ->get();

    $achatParFournisseur = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
           ->select('t.nom', 't.prenom', DB::raw('SUM( st.debit) AS ca'))
           ->where('t.statut','fournisseur')
           ->groupBy('st.tiers_id', 't.nom', 't.prenom')
           ->get();

    $totalAcha = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        ->where('t.statut','fournisseur')
        ->sum('debit');



    $totalmontantRegle = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        ->where('t.statut','fournisseur')
        ->sum('credit');

    $montantNonRegle=($totalmontantRegle - $totalAcha)* -1;


        return view('tiers.home',compact('monaie','caParClient','caTotalClient','caMensuel','totalDebitClient','montantNomRecouvre', 'caParAutretiers','caTotalAutre','caMensuelAutre','totalDebitAutre','montantNomRecouvreAutre'  ,'achatMensuel','achatParFournisseur','totalAcha','totalmontantRegle','montantNonRegle'));
    }


}
