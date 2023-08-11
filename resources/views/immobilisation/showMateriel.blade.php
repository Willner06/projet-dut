@extends('layouts.appImmo')
@section('content')
@php
    header('Content-type: text/html; charset=utf-8');
@endphp
    <div>
        <div class="pagetitle">
            <div class="">
                <h1>{{$materiel->designation}}</h1>

                    <div class="card float-end d-inline">

                        <a class="badge text-bg-success m-3" href="{{ route('materiel.info.csv', $materiel->id) }}"> Exporter </a>
                        @can('Modifier les immobilisations')

                            @if($materiel->statut == 'actif')
                                <a class="badge text-bg-warning m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> Modifier </a>
                            @else
                            @can('supprimer/modifier les immobilisations au rebut')
                                <a class="badge text-bg-warning m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> Modifier </a>
                            @endcan
                            @endif

                        @endcan
                    </div>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a href="{{route('home')}}">Accueil</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('materiel.categorie.index')}}">Matériels ammortissables</a></li>
                        <li class="breadcrumb-item "><a href="{{route('materiel.categorie.show', $materiel->categorie->id)}}">{{$materiel->categorie->libelle}}</a></li>
                        <li class="breadcrumb-item active">{{$materiel->designation}}</li>
                    </ol>
                </nav>
            <br><br>
            </div>

        </div><!-- End Page Title -->

        <div class="row">
            {{-- @foreach ($categorie->marchandises as $marchandise)
                <div class="col-sm-3">
                    <div class="card rounded-4">
                        <div class="card-body">
                          <h5 class="card-title">{{$marchandise->designation}}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">{{$categorie->marchandises->first()->entres->count()}}</h6>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                          <div class="float-end">
                            <a href="#" class="card-link text-bg-danger badge">Supprimer</a>
                            <a href="{{route('marchandise.show', $marchandise->id)}}" class=" text-bg-warning badge">Voir</a>
                          </div>
                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>
                @endforeach --}}
                <div class="table-responsive card">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="7">
                                    <h4><u>Fiche d'immobilisation {{$materiel->designation}}</u></h4>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr>
                                <td colspan="4">Code d'inventaire</td>
                                <td>{{$materiel->code_inventaire}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Désignation</td>
                                <td>{{$materiel->designation}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Type immobilisation</td>
                                <td>{{$materiel->categorie->libelle}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Etat</td>
                                <td>{{$materiel->etat}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Affectation</td>
                                <td>{{$materiel->affectation}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Fournisseur</td>
                                <td>{{$materiel->fournisseur}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Date d'acaht ou de mise en service</td>
                                <?php setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr'); ?>
                                <td>{{ Carbon\Carbon::parse($materiel->date_acquisition)->format('d-m-Y') }}</td>

                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Prix d'achat</td>
                                <td>{{ number_format($materiel->prix_achat ,0,'.',' ').$monaie}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Autres frais</td>
                                <td>{{number_format($materiel->autres_frais ,0,'.',' ').$monaie}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">T V A</td>
                                <td>{{number_format($materiel->tva ,0,'.',' ').$monaie}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Coût d'acquisition TTC</td>
                                <td>{{number_format($materiel->cout_acquisitionTtc ,0,'.',' ').$monaie}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            {{-- <tr>
                                <td colspan="4">TVA déduite</td>
                                <td>{{$materiel->tva .$monaie}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr> --}}
                            <tr>
                                <td colspan="7"><br></td>

                            </tr>
                            <tr>
                                <td colspan="4">BASE D'AMORTISSEMENT</td>
                                <td>{{number_format($materiel->base_ammortisable ,0,'.',' ').$monaie }}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                {{-- <td colspan="7"><br></td> --}}
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4"> Mode d'amortissement</td>
                                <td>{{$materiel->mode_ammortissement}}</td>
                                <td></td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                            <tr>
                                <td colspan="4">Durée d'amortissement</td>
                                <td>{{$materiel->duree_ammortissement}}</td>
                                <td>Ans</td>
                                <td></td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="7"><br></td>
                            </tr>
                            <tr class="bg-primary text-white text-center">
                                <td></td>
                                <td>ANNEE</td>
                                <td>BASE</td>
                                <td>TAUX</td>
                                <td>CALCUL DE L'AMORTISSEMENT</td>
                                <td>AMORT.</td>
                                <td>V.N.C</td>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="text-center">
                                <td>
                                    {{$id}}
                                </td>
                                <td>
                                    {{$annee=Carbon\Carbon::parse($materiel->date_acquisition)->format('Y')}}
                                </td>
                                <td>
                                    {{number_format($materiel->base_ammortisable,0,'.',' ') .$monaie}}
                                </td>
                                <td>
                                    {{round($taux,0)."%"}}
                                </td>
                                <td>{{number_format(round($amortissement_premiere_annee,0),0,'.',' ') .$monaie}}</td>
                                <td>{{number_format(round($amortissement_premiere_annee,0),0,'.',' ') .$monaie}}</td>
                                <td>{{number_format($vncd=round($materiel->base_ammortisable - $amortissement_premiere_annee,0),0,'.',' ') .$monaie}}</td>

                                @php
                                    if (date('Y') == $annee) {
                                        $a_actuel=date('Y');
                                        $val=$vncd;
                                    }
                                    // else{
                                    //     $a_actuel=0;
                                    //     $val=0;
                                    // }
                                @endphp

                            </tr>
                            @php
                                round($vnc=$materiel->base_ammortisable - $amortissement_premiere_annee,0);
                                $id=2;
                                $annee=$annee+1;
                            @endphp
                                @for ($i = 1; $i < $materiel->duree_ammortissement; $i++)

                                        <tr class="text-center">
                                            <td>
                                                {{$id++}}
                                            </td>
                                            <td>
                                                {{ $an= $annee++}}
                                            </td>
                                            <td>
                                                {{number_format(round($materiel->base_ammortisable,0),0,'.',' ') .$monaie}}
                                            </td>
                                            <td>
                                                {{round($taux,0)."%"}}
                                            </td>
                                            <td>{{number_format(round($amortissement_annuel,0),0,'.',' ') .$monaie}}</td>
                                            <td>{{number_format(round($amortissement_annuel,0),0,'.',' ') .$monaie}}</td>
                                            <td>{{number_format(round(($vnc=$vnc-($amortissement_annuel)),0),0,'.',' ') .$monaie}}</td>
                                        </tr>

                                        @php
                                            if (date('Y') == $an) {
                                                $a_actuel=date('Y');
                                                $val=$vnc;
                                            }
                                            // else{
                                            //     $a_actuel=0;
                                            //     $val=0;
                                            // }
                                        @endphp

                                @endfor




                                <tr class="text-center">
                                    <td>
                                        {{$id}}
                                    </td>
                                    <td>
                                        {{$da=$annee}}
                                    </td>
                                    <td>
                                        {{number_format(round($materiel->base_ammortisable,0),0,'.',' ') .$monaie}}
                                    </td>
                                    <td>
                                        {{round($taux,0)."%"}}
                                    </td>
                                    <td>{{number_format(round($vnc,0),0,'.',' ') .$monaie}}</td>
                                    <td>{{number_format(round($vnc,0),0,'.',' ') .$monaie}}</td>
                                    <td>{{number_format(round($vncf=$vnc-$vnc,0),0,'.',' ') .$monaie}}</td>
                                </tr>
                                <tr>
                                    <td colspan="7"><br></td>
                                </tr>

                                @php
                                    if (date('Y') >= $da) {
                                        $a_actuel=date('Y');
                                        $val=$vncf;
                                    }
                                    // else{
                                    //     $a_actuel=0;
                                    //     $val=0;
                                    // }
                                @endphp


                                    @php

                                    // if ($a_actuel != 0) {
                                        $p_cession =$materiel->prix_vente_valeur_reprise - $val;
                                    // }else{
                                    //     $p_cession=0;
                                    // }
                                    @endphp

                                {{-- Début cession mise au rebut --}}
                            </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                                <tr>
                                    <td colspan="7" class="text-center bg-danger text-white">
                                        CESSION, MISE AU REBUT, REINTEGRATION AU PATRIMOINE PERSONNEL :
                                    </td>
                                </tr>
                        </thead>

                                <tr class="">
                                    <td colspan="4">
                                        Date de mise au rebut :
                                    </td>
                                    @if ($materiel->date_mise_au_rebut==null)
                                        <td></td>
                                    @else
                                        <td>
                                            {{ Carbon\Carbon::parse($materiel->date_mise_au_rebut)->format('d-m-Y')}}
                                        </td>
                                    @endif

                                    <td>
                                        {{-- {{$materiel->base_ammortisable}} --}}
                                    </td>
                                    <td>
                                        {{-- {{round(($sommeDerniereAnnee * 100) / $materiel->base_ammortisable,1)."%"}} --}}
                                    </td>
                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Date de cession :
                                    </td>
                                    @if ($materiel->date_session==null)
                                        <td></td>
                                    @else
                                        <td>
                                            {{Carbon\Carbon::parse($materiel->date_session)->format('d-m-Y')}}
                                        </td>
                                    @endif

                                    <td>
                                        {{-- {{$materiel->base_ammortisable}} --}}
                                    </td>
                                    <td>
                                        {{-- {{round(($sommeDerniereAnnee * 100) / $materiel->base_ammortisable,1)."%"}} --}}
                                    </td>
                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Valeur Nette Comptable :
                                    </td>
                                    <td>
                                        {{number_format($val,0,'.',' ') .$monaie}}
                                    </td>
                                    <td>
                                        {{-- {{$materiel->base_ammortisable}} --}}
                                    </td>
                                    <td>
                                        {{-- {{round(($sommeDerniereAnnee * 100) / $materiel->base_ammortisable,1)."%"}} --}}
                                    </td>
                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Prix de vente ou valeur de reprise :
                                    </td>
                                    <td>
                                        {{number_format($materiel->prix_vente_valeur_reprise,0,'.',' ') .$monaie}}
                                    </td>
                                    <td>
                                        {{-- {{$materiel->base_ammortisable}} --}}
                                    </td>
                                    <td>
                                        {{-- {{round(($sommeDerniereAnnee * 100) / $materiel->base_ammortisable,1)."%"}} --}}
                                    </td>
                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        <b><u>Plus-value globale prévisionnelle:</u></b>
                                    </td>
                                    <td>
                                        {{-- @if ($materiel->plus_value_globale != null)
                                        {{number_format($materiel->plus_value_globale,0,'.',' ') .$monaie}}
                                        @else --}}
                                        {{number_format($p_cession,0,'.',' ') .$monaie}}
                                        {{-- @endif --}}
                                    </td>
                                    <td>
                                        {{-- {{$materiel->base_ammortisable}} --}}
                                    </td>
                                    <td>
                                        {{-- {{round(($sommeDerniereAnnee * 100) / $materiel->base_ammortisable,1)."%"}} --}}
                                    </td>
                                </tr>


                                <tr class="">
                                    <td colspan="4">
                                        <b><u>Plus-value globale réelle:</u></b>
                                    </td>
                                    <td>
                                        @if ($materiel->plus_value_globale != null)
                                        {{number_format($materiel->plus_value_globale,0,'.',' ') .$monaie}}
                                        @else

                                        @endif
                                    </td>
                                    <td>
                                        {{-- {{$materiel->base_ammortisable}} --}}
                                    </td>
                                    <td>
                                        {{-- {{round(($sommeDerniereAnnee * 100) / $materiel->base_ammortisable,1)."%"}} --}}
                                    </td>
                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Dont à COURT TERME :
                                    </td>
                                    <td>
                                        {{$materiel->dont_court_terme}}
                                    </td>
                                    <td>
                                        {{-- {{$materiel->base_ammortisable}} --}}
                                    </td>
                                    <td>
                                        {{-- {{round(($sommeDerniereAnnee * 100) / $materiel->base_ammortisable,1)."%"}} --}}
                                    </td>
                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Dont à LONG TERME :
                                    </td>
                                    <td>
                                        {{$materiel->dont_long_terme}}
                                    </td>
                                    <td>
                                        {{-- {{$materiel->base_ammortisable}} --}}
                                    </td>
                                    <td>
                                        {{-- {{round(($sommeDerniereAnnee * 100) / $materiel->base_ammortisable,1)."%"}} --}}
                                    </td>
                                </tr>
                                {{-- Fin session mise au rebut --}}



                        </tbody>
                    </table>
                </div>
        </div>
    </div>



    <div class="modal modal-lg fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-title">
                <h3 class="m-3">{{$materiel->designation}}</h3>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" action="{{route('materiel.update', $materiel->id)}}">
                    @csrf
                    @method('put')
                    <div class="col-md-6">
                        <label for="categorie" class="form-label">Catégorie (Type immobilisation)</label>
                        {{-- <input type="text" class="form-control" id="categorie_id" name="categorie_id" > --}}
                        <select class="form-select" id="categorie_id" name="categorie_id" >
                            @foreach ($categories as $categorie)
                            @if ($materiel->categorie->id == $categorie->id)
                                <option selected value="{{$materiel->categorie->id}}">{{$materiel->categorie->libelle}}</option>
                            @else
                                <option  value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="code_inventaire" class="form-label">Code inventaire</label>
                        <input type="text" class="form-control" id="code_inventaire" name="code_inventaire" value="{{$materiel->code_inventaire}}" >
                    </div>
                    {{-- <div class="col-md-4">
                        <label for="type_immobilisation" class="form-label">Type immobilisation</label>
                        <input type="text" class="form-control" id="type_immobilisation" name="type_immobilisation" >
                      </div> --}}
                    <div class="col-md-6">
                      <label for="designation" class="form-label">Désignation</label>
                      <input type="text" class="form-control" id="designation" name="designation" value="{{$materiel->designation}}" >
                    </div>

                    <div class="col-md-6">
                        <label for="date_acquisition" class="form-label">Date d'achat ou mise en service</label>
                        <input type="date" class="form-control" id="date_acquisition" name="date_acquisition" value="{{$materiel->date_acquisition}}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="prix_achat" class="form-label">Prix d'achat</label>
                        <input type="number" class="form-control" id="prix_achat" oninput="prix_acquisition()" name="prix_achat" value="{{$materiel->prix_achat}}" >
                    </div>
                    <div class="col-md-3">
                        <label for="autres_frais" class="form-label">Autres frais</label>
                        <input type="number" class="form-control" id="autres_frais" oninput="prix_acquisition()" name="autres_frais" value="{{$materiel->autres_frais}}" >
                    </div>
                    <div class="col-md-3">
                        <label for="tva" class="form-label">TVA déduite</label>
                        <input type="number" class="form-control" id="tva" oninput="prix_acquisition()" name="tva" value="{{$materiel->tva}}" >
                    </div>
                    <div class="col-md-3">
                        <label for="cout_acquisitionTtc" class="form-label">Coût d'acquisition TTC</label>
                        <input type="number" class="form-control" id="cout_acquisitionTtc" name="cout_acquisitionTtc" value="{{$materiel->cout_acquisitionTtc}}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="affectation" class="form-label">Affectation</label>
                        <input type="text" class="form-control" id="affectation" name="affectation" value="{{$materiel->affectation}}" >
                    </div>
                    <div class="col-md-4">
                        <label for="etat" class="form-label">Etat</label>
                        <input type="text" class="form-control" id="etat" name="etat" value="{{$materiel->etat}}" >
                    </div>
                    <div class="col-md-4">
                        <label for="fournisseur" class="form-label">Fournisseur</label>
                        <input type="text" class="form-control" id="fournisseur" name="fournisseur" value="{{$materiel->fournisseur}}" >
                    </div>


                    <div class="col-md-4">
                        <label for="base_ammortisable" class="form-label">Base ammortissable</label>
                        <input type="number" class="form-control" id="base_ammortisable" name="base_ammortisable" value="{{$materiel->base_ammortisable}}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="mode_ammortissement" class="form-label">Mode d'ammortissement</label>
                        <select class="form-select" id="mode_ammortissement" name="mode_ammortissement" required>
                          {{-- @foreach ($categories as $categorie) --}}
                          <option selected value="L">L</option>
                          {{-- @endforeach --}}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="duree_ammortissement" class="form-label">Durée d'ammortissement</label>
                        <input type="number" class="form-control" id="duree_ammortissement" name="duree_ammortissement" value="{{$materiel->duree_ammortissement}}" >
                    </div>


                    <div class="col-md-4">
                        <label for="date_mise_au_rebut" class="form-label">Date mise au rebut</label>

                        {{-- @if ($materiel->date_mise_au_rebut==null) --}}
                            <input type="date" class="form-control" id="date_mise_au_rebut" name="date_mise_au_rebut" value="{{$materiel->date_mise_au_rebut}}">
                        {{-- @else
                            <input type="text" class="form-control" id="date_mise_au_rebut" name="date_mise_au_rebut" value="{{$materiel->date_mise_au_rebut->format('d-m-Y')}}">
                        @endif --}}


                    </div>
                    <div class="col-md-4">
                        <label for="date_session" class="form-label">Date cession</label>

                        {{-- @if ($materiel->date_session==null) --}}
                            <input type="date" class="form-control" id="date_session" name="date_session" value="{{$materiel->date_session}}" oninput="cession()">
                        {{-- @else
                            <input type="text" class="form-control" id="date_session" name="date_session" value="{{$materiel->date_session->format('d-m-Y')}}">
                        @endif --}}

                    </div>
                    <div class="col-md-4">
                        <label for="valeur_net_comptable" class="form-label">Valeur net comptable</label>
                        <input type="number" class="form-control" id="valeur_net_comptable" name="valeur_net_comptable" value="{{$materiel->valeur_net_comptable}}" >
                    </div>
                    <div class="col-md-6">
                        <label for="prix_vente_valeur_reprise" class="form-label">Prix vente valeur reprise</label>
                        <input type="number" class="form-control" id="prix_vente_valeur_reprise" name="prix_vente_valeur_reprise" value="{{$materiel->prix_vente_valeur_reprise}}" >
                    </div>
                    <div class="col-md-6">
                        <label for="plus_value_globale" class="form-label">Plus value globale réelle</label>
                        <input type="number" class="form-control" id="plus_value_globale" name="plus_value_globale" value="{{$materiel->plus_value_globale}}" >
                    </div>
                    <div class="col-md-6">
                        <label for="dont_court_terme" class="form-label">Dont à court terme</label>
                        <input type="number" class="form-control" id="dont_court_terme" name="dont_court_terme" value="{{$materiel->dont_court_terme}}" >
                    </div>
                    <div class="col-md-6">
                        <label for="dont_long_terme" class="form-label">Dont à long terme</label>
                        <input type="number" class="form-control" id="dont_long_terme" name="dont_long_terme" value="{{$materiel->dont_long_terme}}" >
                    </div>

                    <div class="col-12">
                      <button class="btn btn-success float-end" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>



      <script>
       function cession(){
        if ($('#date_session').val() != '') {
            $('#plus_value_globale').attr('required', true);
            $('#valeur_net_comptable').attr('required', true);
            console.log('non_null')
        }else{
            $('#plus_value_globale').attr('required', false);
            $('#valeur_net_comptable').attr('required', false);
            console.log('null')
        }
       }
        function prix_acquisition(){
            prix_achat=$('#prix_achat').val()*1;
            autres_frais=$('#autres_frais').val()*1;
            tva=$('#tva').val()*1;

            cout_acquisition= (prix_achat+autres_frais-tva);
            $('#cout_acquisitionTtc').val(cout_acquisition);
            $('#base_ammortisable').val(cout_acquisition);

        }
    </script>


@endsection
