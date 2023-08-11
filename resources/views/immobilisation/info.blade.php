<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <link href="{{asset('img-jb-gestion/Logo_job_gestion.png')}}" rel="icon">
  <link href="{{asset('img-jb-gestion/Logo_job_gestion.png')}}" rel="apple-touch-icon">


  <title>JOBS GESTION</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('template/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



  <!-- CSS -->
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" /> --}}


  <!-- Template Main CSS File -->
  <link href="{{asset('template/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    td{
        white-space: nowrap;
    }
</style>
</head>


<body>


    <div class="p-4">
        <div class="pagetitle">
            <div class="">
                <h1>{{$materiel->designation}}</h1>

                {{-- @can('Modofier les immobilisations') --}}
                    <div class="card float-end ">
                        {{-- @auth --}}
                        <a class="badge text-bg-success m-3"  href="{{ route('materiel.info.csv', $materiel->id) }}"> Exporter </a>
                        {{-- @endauth --}}
                        @if($materiel->statut == 'actif')
                            <a class="badge text-bg-warning m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> Modifier </a>
                        @endif
                    </div>
                {{-- @endcan --}}
                <br><br>
                <nav>

                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
                        {{-- <li class="breadcrumb-item active"><a href="{{route('materiel.index')}}">Matériel Ammorti</a></li> --}}
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
                <div class="table-responsive shadow-lg p-3 mb-5 bg-body-tertiary rounded card">
                    <table class="table table-bordered table-fixed" style="width: ">
                        <thead>
                            <tr>
                                <td colspan="6">
                                    <h4><u>{{$materiel->designation}}</u></h4>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr>
                                <td colspan="4" style="width: 500px">Code d'inventaire</td>
                                <td>{{$materiel->code_inventaire}}</td>

                            </tr>
                            <tr>
                                <td colspan="4">Désignation</td>
                                <td>{{$materiel->designation}}</td>

                            </tr>
                            <tr>
                                <td colspan="4">Type immobilisation</td>
                                <td>{{$materiel->categorie->libelle}}</td>

                            </tr>
                            <tr>
                                <td colspan="4">Etat</td>
                                <td>{{$materiel->etat}}</td>

                            </tr>
                            <tr>
                                <td colspan="4">Affectation</td>
                                <td>{{$materiel->affectation}}</td>

                            </tr>
                            <tr>
                                <td colspan="4">Fournisseur</td>
                                <td>{{$materiel->fournisseur}}</td>

                            </tr>
                            @auth
                            <tr>
                                <td colspan="4">Date d'acaht ou de mise en service</td>
                                <td>{{Carbon\Carbon::parse($materiel->date_acquisition)->format('d-m-Y') }}</td>

                            </tr>
                            <tr>
                                <td colspan="4">Prix d'achat</td>
                                <td>{{ number_format($materiel->prix_achat ,0,'.',' ').$monaie}}</td>

                            </tr>
                            <tr>
                                <td colspan="4">Autres frais</td>
                                <td>{{number_format($materiel->autres_frais ,0,'.',' ').$monaie}}</td>

                            </tr>
                            <tr>
                                <td colspan="4">T V A</td>
                                <td>{{number_format($materiel->tva ,0,'.',' ').$monaie}}</td>

                            </tr>
                            <tr>
                                <td colspan="4">Coût d'acquisition TTC</td>
                                <td>{{number_format($materiel->cout_acquisitionTtc ,0,'.',' ').$monaie}}</td>

                            </tr>

                            <tr>
                                <td colspan="4">BASE D'AMORTISSEMENT</td>
                                <td>{{number_format($materiel->base_ammortisable ,0,'.',' ').$monaie }}</td>


                            </tr>
                            <tr>
                                {{-- <td colspan="7"><br></td> --}}

                            </tr>
                            <tr>
                                <td colspan="4"> Mode d'amortissement</td>
                                <td>{{$materiel->mode_ammortissement}}</td>

                            </tr>
                            <tr>
                                <td colspan="4">Durée d'amortissement</td>
                                <td>{{$materiel->duree_ammortissement}} ans</td>

                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered table-fixed " id="tableau">
                        <thead>
                            <tr class="bg-primary text-white text-center" style="width: 70em">
                                <td style="width: 80px"></td>
                                <td style="width: 50px">ANNEE</td>
                                <td style="width: 100px">BASE</td>
                                <td style="width: 100px">TAUX</td>
                                <td style="width: 100px">CALCUL DE L'AMORTISSEMENT</td>
                                <td style="width: 100px">AMORT.</td>
                                <td style="width: 100px">V.N.C</td>
                            </tr>


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
                        </thead>
                    </table>
                    <table class="table table-bordered table-fixed " id="tableau2">
                        <thead>
                                <tr>
                                    <td colspan="7" class="text-center bg-danger text-white">
                                        CESSION, MISE AU REBUT, REINTEGRATION AU PATRIMOINE PERSONNEL
                                    </td>
                                </tr>


                                <tr class="">
                                    <td colspan="4">
                                        Date de mise au rebut :
                                    </td>
                                    @if ($materiel->date_mise_au_rebut==null)
                                        <td></td>
                                    @else
                                        <td>
                                            {{ Carbon\Carbon::parse($materiel->date_mise_au_rebut)->formatLocalized('%d %B %Y')  }}
                                        </td>
                                    @endif


                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Date de cession :
                                    </td>
                                    @if ($materiel->date_session==null)
                                        <td></td>
                                    @else
                                        <td>
                                            {{Carbon\Carbon::parse($materiel->date_session)->formatLocalized('%d %B %Y')}}
                                        </td>
                                    @endif


                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Valeur Nette Comptable :
                                    </td>
                                    <td>
                                        {{number_format($val,0,'.',' ') .$monaie}}
                                    </td>

                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Prix de vente ou valeur de reprise :
                                    </td>
                                    <td>
                                        {{number_format($materiel->prix_vente_valeur_reprise,0,'.',' ') .$monaie}}
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

                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Dont à COURT TERME :
                                    </td>
                                    <td>
                                        {{$materiel->dont_court_terme}}
                                    </td>

                                </tr>

                                <tr class="">
                                    <td colspan="4">
                                        Dont à LONG TERME :
                                    </td>
                                    <td>
                                        {{$materiel->dont_long_terme}}
                                    </td>

                                </tr>
                                {{-- Fin session mise au rebut --}}

                            @endauth


                        </tbody>
                    </table>
                </div>
        </div>
    </div>



    @auth


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
                    {{-- <div class="col-md-4">
                        <label for="mode_ammortissement" class="form-label">Mode d'ammortissement</label>
                        <input type="text" class="form-control" id="mode_ammortissement" name="mode_ammortissement" value="{{$materiel->mode_ammortissement}}" >
                    </div> --}}
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

    @endauth




    @guest


    <div class="modal  fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-title">
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center py-1 " >
                    <img src="{{asset('img-jb-gestion/logo_job_gestion.png')}}" alt="" style="width: 50%">
                </div><!-- End Logo -->

                  <form class="row g-3 needs-validation" novalidate action="{{route('user.info.authenticate')}}" method="POST">
                    @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mot de passe</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    {{-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> --}}
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Connexion</button>
                    </div>
                    {{-- <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                    </div> --}}
                  </form>
            </div>
          </div>
        </div>
      </div>

      @endguest







      <main id="main" class="main">

        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        @yield('content')
      </main>
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

      <!-- Vendor JS Files -->
      <script src="{{asset('template/vendor/apexcharts/apexcharts.min.js')}}"></script>
      <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('template/vendor/chart.js/chart.umd.js')}}"></script>
      <script src="{{asset('template/vendor/echarts/echarts.min.js')}}"></script>
      <script src="{{asset('template/vendor/quill/quill.min.js')}}"></script>
      <script src="{{asset('template/vendor/simple-datatables/simple-datatables.js')}}"></script>
      <script src="{{asset('template/vendor/tinymce/tinymce.min.js')}}"></script>
      <script src="{{asset('template/vendor/php-email-form/validate.js')}}"></script>

      <!-- Template Main JS File -->
      <script src="{{asset('template/js/main.js')}}"></script>
      <!-- Template Main JS File -->
      {{-- <script src="{{asset('template/js/main.js')}}"></script> --}}
      {{-- <script src="{{asset('js/jquery.js')}}"></script> --}}


    <!-- JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script> --}}

    </body>

</html>
