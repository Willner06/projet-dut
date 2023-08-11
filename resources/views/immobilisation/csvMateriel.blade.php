@php

header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=$materiel->designation.xls");

header('Cache-Control: max-age=0');

@endphp

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

    /* table{
        margin: 15px;
    } */

    table thead tr {
        border: 1px solid black;
        font-size: 25px;
    }

    table{
        border: 1px solid black;
    }

    table tbody tr td {
        border: 1px solid black;
    }
    .cout{
        float: right;
    }
    .categorie{
        background-color: rgb(21, 88, 233);
        color: #fff;
        text-align: center;
        font-size: 20px;
    }
    .materiel{
        background-color: rgb(207, 200, 200);
    }
    .tr-cout{
        background-color: #eef3dc
    }
    .cout-total{

    }

    .thead tr{
        background-color:rgb(240, 240, 50);
    }
</style>
</head>


<body>


    <div class="p-4">
        <div class="pagetitle">
            <div class="">
                <h1>{{$materiel->designation}}</h1>

                {{-- @can('Modofier les immobilisations') --}}
                    {{-- <div class="card float-end">
                        <a class="badge text-bg-warning m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> Modifier </a>
                    </div> --}}
                {{-- @endcan --}}
                <nav>
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
                        {{-- <li class="breadcrumb-item active"><a href="{{route('materiel.index')}}">Matériel Ammorti</a></li> --}}
                        {{-- <li class="breadcrumb-item active">{{$materiel->designation}}</li> --}}
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

                <div >
                    <table class="">
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
                            @auth
                            <tr>
                                <td colspan="4">Date d'acaht ou de mise en service</td>
                                <td>{{Carbon\Carbon::parse($materiel->date_acquisition)->format('d-m-Y') }}</td>
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
                                <tr>
                                    <td colspan="7" class="text-center bg-danger text-white">
                                        CESSION, MISE AU REBUT, REINTEGRATION AU PATRIMOINE PERSONNEL :
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
                                            {{ Carbon\Carbon::parse($materiel->date_mise_au_rebut)->format('d-m-Y')  }}
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

                            @endauth


                        </tbody>
                    </table>
                </div>
        </div>
    </div>



        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
