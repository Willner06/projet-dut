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
        // $decaissementParJour=Decaissement::where('');
        // echo $decaissementParSemestre = Decaissement::selectRaw('YEAR(created_at) as year, QUARTER(created_at) as quarter, SUM(somme) as total_somme')
        // ->groupBy('year', 'quarter')
        // ->get() .'<br>';

         $decaissements_mois = Decaissement::selectRaw('YEAR(created_at) as year, MONTH(created_at) as mois, SUM(somme) as total_somme')
        ->groupBy('year', 'mois')
        ->get() .'<br>';

        // echo $decaissementSemaine = Decaissement::selectRaw('YEAR(created_at) as year, MONTH(created_at) as mois, WEEK(created_at) as semaines, SUM(somme) as total_somme')
        // ->groupBy('year','mois', 'semaines')
        // ->get() .'<br>';

        // echo $decaissementJour = Decaissement::selectRaw('YEAR(created_at) as year, MONTH(created_at) as mois, DAY(created_at) as jour, SUM(somme) as total_somme')
        // ->groupBy('year','mois', 'jour')
        // ->get() .'<br>'.'<br>';

        // echo $decaissements = Decaissement::selectRaw('YEAR(created_at) as annee, QUARTER(created_at) as semestre, MONTH(created_at) as mois, WEEK(created_at) as semaine, DAY(created_at) as jour, SUM(somme) as total_somme')
        // ->groupBy('annee','semestre','mois','semaine', 'jour')
        // ->get() .'<br>';



 $decaissements_mois = DB::table('decaissements')
->select(
    // DB::raw('DATE(created_at) as date'),
        //  DB::raw('WEEK(created_at) as semaine'),
         DB::raw('MONTH(created_at) as mois'),
        //  DB::raw('QUARTER(created_at) as trimestre'),
         DB::raw('YEAR(created_at) as annee'),
         DB::raw('sum(somme) as total'))
->groupBy(
    // DB::raw('DATE(created_at)'),
        //   DB::raw('WEEK(created_at)'),


          DB::raw('YEAR(created_at)'),
        //   DB::raw('QUARTER(created_at)'),
          DB::raw('MONTH(created_at)'))
->get();


// echo $annee=$decaissements->pluck('annee').'<br>';
// echo $trimestre=$decaissements->trimestre.'<br>';
// echo $mois=$decaissements->mois.'<br>';
// // echo $mois=$decaissements->pluck('date').'<br>';
// echo $total=$decaissements->pluck('total').'<br>';

        // echo $decaissementTrimestre = Decaissement::selectRaw('YEAR(created_at) as annee, QUARTER(created_at) as trimestre, MONTH(created_at) as mois, SUM(somme) as total_somme')
        // ->groupBy('annee','trimestre', 'mois')
        // ->get() .'<br>';

        // echo $total=$decaissementTrimestre->pluck('total_somme');




        // $lava = new Lavacharts; // See note below for Laravel
        // $finances = Lava::DataTable();
        // $finances->addStringColumn('Mois')
        //          ->addNumberColumn('CA')
        //          ->addNumberColumn('Bénéfice')
        //          ->addRow(['janv-2016',  rand(1000,5000), rand(1000,5000)])
        //          ->addRow(['fev-2016',  rand(1000,5000), rand(1000,5000)])
        //          ->addRow(['mar-2016',  rand(1000,5000), rand(1000,5000)]);
        // }

        // $lava::ColumnChart('Finances', $finances, [
        //     'title' => 'Chiffre d\'affaire et bénéfice',
        //     'titleTextStyle' => [
        //         'color'    => '#000',
        //         'fontSize' => 14
        //     ]
        // ]);

        // return view('cheminDeNotreVue',compact('lava'));



    // $start = Carbon::now()->startOfYear();
    // $end = Carbon::now()->endOfYear();



    // $encaissements = Encaissement::whereBetween('created_at', [$start, $end])->get();
    // $decaissements = Decaissement::whereBetween('created_at', [$start, $end])->get();


    // $encaissementsByDay = $encaissements->groupBy(function ($entry) {
    //     return $entry->created_at->format('M');
    // })->map(function ($items) {
    //     return $items->sum('somme');
    // });

    // $decaissementsByDay = $decaissements->groupBy(function ($entry) {
    //     return $entry->created_at->format('M');
    // })->map(function ($items) {
    //     return $items->sum('somme');
    // });


    // $totalEncaissementsParMois = Encaissement::selectRaw('SUM(somme) as total_encaissements, DATE_FORMAT(created_at, "%Y-%m") as date')
    //                                         ->groupBy('date')
    //                                         ->get();

    //     $totalDecaissementsParMois = Decaissement::selectRaw('SUM(somme) as total_decaissements, DATE_FORMAT(created_at, "%Y-%m") as date')
    //             ->groupBy('date')
    //             ->get();








//                 $decaissements_annee = DB::table('decaissements')
//                 ->select(DB::raw('YEAR(created_at) as annee, SUM(somme) as total_decaissements'))
//                 ->groupBy(DB::raw('YEAR(created_at)'))
//                 ->get();

//             $encaissements_annee = DB::table('encaissements')
//                 ->select(DB::raw('YEAR(created_at) as annee, SUM(somme) as total_encaissements'))
//                 ->groupBy(DB::raw('YEAR(created_at)'))
//                 ->get();



//         //         // echo  $decaissements_mois = DB::table('decaissements')
//         //         // ->select(DB::raw('sum(somme) as total_decaissements'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') as mois"))
//         //         // ->groupBy('mois')
//         //         // ->get();

//         //    echo $encaissements_mois = DB::table('encaissements')
//         //    ->select(DB::raw('sum(somme) as total_encaissements'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') as mois"))
//         //    ->groupBy('mois')
//         //    ->get();


//  $somme_par_mois = DB::table('encaissements as e')
// ->join('comptes as ce', 'e.compte_id', '=', 'ce.id')
// ->join('decaissements as d', 'd.compte_id', '=', 'ce.id')
// ->selectRaw('YEAR(e.created_at) as annee, MONTH(e.created_at) as mois, SUM(e.somme) as encaissements, SUM(d.somme) as decaissements')
// ->groupBy('annee', 'mois')
// ->get();

//  $somme_par_trimestre = DB::table('encaissements as e')
// ->join('comptes as ce', 'e.compte_id', '=', 'ce.id')
// ->join('decaissements as d', 'd.compte_id', '=', 'ce.id')
// ->selectRaw('YEAR(e.created_at) as annee, QUARTER(e.created_at) as trimestre, SUM(e.somme) as encaissements, SUM(d.somme) as decaissements')
// ->groupBy('annee', 'trimestre')
// ->get();

//  $somme_par_annee = DB::table('encaissements as e')
// ->join('comptes as ce', 'e.compte_id', '=', 'ce.id')
// ->join('decaissements as d', 'd.compte_id', '=', 'ce.id')
// ->selectRaw('YEAR(e.created_at) as annee, SUM(e.somme) as encaissements, SUM(d.somme) as decaissements')
// ->groupBy('annee')
// ->get();

//  $results = DB::table('encaissements as e')
// ->join('comptes as ce', 'e.compte_id', '=', 'ce.id')
// ->join('decaissements as d', 'd.compte_id', '=', 'ce.id')
// ->selectRaw('DATE(e.created_at) as jour, SUM(e.somme) as encaissements, SUM(d.somme) as decaissements')
// ->groupBy('jour')
// ->get().'<br>';

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

// echo $results_semestre = DB::table('comptes')
// ->selectRaw('YEAR(created_at) as annee, QUARTER(created_at) as semestre, SUM(decaissement) as decaissements, SUM(encaissement) as encaissements')
// ->groupBy('annee', 'semestre')
// ->get();


        return view('caisse.dashboard', compact('resultat_annee','resultat_mois','resultat_jour','resultat_trimestre','resultat_semaine'));
    }



    public function marchandiseDashboard(){
        return redirect()->route('marchandise.categorie.index');
    }



    public function tiersHome(){

        $monaie=$this->monaie;
        // echo  $chiffre_affaire_total = DB::table('suivi_tiers AS st')
        //             ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        //             ->select('t.nom', 't.prenom', DB::raw('SUM( st.credit) AS chiffre_affaire'))
        //             ->where('t.statut','client')
        //             ->groupBy('st.tiers_id', 't.nom', 't.prenom')
        //             ->get();





        // tout les tiers réunis


        //  $b = DB::table('suivi_tiers')
        // ->select(
        //     // DB::raw('DATE(created_at) as date'),
        //         //  DB::raw('WEEK(created_at) as semaine'),
        //          DB::raw('sum(credit) as credits'),
        //         //  DB::raw('QUARTER(created_at) as trimestre'),
        //          DB::raw('tiers_id as noms'))
        // ->groupBy(
        //     // DB::raw('DATE(created_at)'),
        //         //   DB::raw('WEEK(created_at)'),


        //         //   DB::raw('YEAR(created_at)'),
        //         //   DB::raw('QUARTER(created_at)'),
        //           DB::raw('noms'))
        // ->get();

        // foreach ($b as $c) {
        //     echo $c->credits.'<br>';
        // }

        //////////////////////////////////////








            // par client CA

     $caParClient = DB::table('suivi_tiers AS st')
            ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
            ->select('t.nom', 't.prenom', DB::raw('SUM( st.debit) AS ca'))
            ->where('t.statut','client')
            ->groupBy('st.tiers_id', 't.nom', 't.prenom')
            ->get();



     $caTotalClient = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        // ->select(DB::raw('SUM(credit) AS chiffre_affaire_total'))
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
        // ->select(DB::raw('SUM(credit) AS chiffre_affaire_total'))
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
        // ->select(DB::raw('SUM(credit) AS chiffre_affaire_total'))
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
        // ->select(DB::raw('SUM(credit) AS chiffre_affaire_total'))
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
        // ->select(DB::raw('SUM(credit) AS chiffre_affaire_total'))
        ->where('t.statut','fournisseur')
        ->sum('debit');



    $totalmontantRegle = DB::table('suivi_tiers AS st')
        ->join('tiers AS t', 't.id', '=', 'st.tiers_id')
        // ->select(DB::raw('SUM(credit) AS chiffre_affaire_total'))
        ->where('t.statut','fournisseur')
        ->sum('credit');

    $montantNonRegle=($totalmontantRegle - $totalAcha)* -1;


        return view('tiers.home',compact('monaie','caParClient','caTotalClient','caMensuel','totalDebitClient','montantNomRecouvre', 'caParAutretiers','caTotalAutre','caMensuelAutre','totalDebitAutre','montantNomRecouvreAutre'  ,'achatMensuel','achatParFournisseur','totalAcha','totalmontantRegle','montantNonRegle'));
    }


}
