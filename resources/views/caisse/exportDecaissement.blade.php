<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" media="print" href="{{asset('css/app.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="print" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">




  <!-- Vendor CSS Files -->




  <!-- CSS -->
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" /> --}}


    <title>Document</title>
</head>

<style>
    *{
        font-family: serif;
    }
    img{
        width:60%;
    }
    #logo{
        float: right;
        /* background-color: red; */
        text-align: center;
        margin-top: 10%;
        width: 25%
    }
    #cadre{
        /* text-align: left; */
        /* height: 08%; */
        /* margin-bottom: -40%;
        margin-top: 20%; */
        border: 3px solid;
        margin-top: 6%;
    }
    #numero_text{
        /* background-color: #fff; */
        /* margin-top: 33%; */
        margin-left: 5%;
    }
    #corps{
        /* background-color: red; */
    }
    .pointille{
        /* border-bottom: 2px #000000 dotted; */
        margin-left: 01%;
        /* background-color: #fff; */
        font-weight: bold;
        width: 300%
    }
    #num_piece{
        color: #4154f4;
    }

</style>
<body>
    <section>
        <div id="entete">

            <div id="logo">
                <img src="{{asset('img-jb-gestion/logo.png')}}" alt="" >
                <div id="cadre">
                    <h3 id="numero_text">N° : <span id="num_piece">{{$decaissement->num_piece}}</span></h3>
                </div>
            </div>
            <div  id="info">
                <h4 class="text-danger bg-primary">
                    JOBS CONSEIL <br>
                    Avenue de Cointet <br>
                    BP : 2522 Libreville / GABON <br>
                    +241 77 75 07 37 <br>
                    <span style="color:#4154f4">jobs@jobs-conseil.com</span> <br>
                    www.jobs-conseil.com <br>
                </h4>
            </div>
        </div>
        <br>
        <br>
        <br>

        @php
            $lettre = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
        @endphp

        <div id="corps">
            <u><h3 style="text-align:center; background-color:#fff">FICHE DE DECAISSEMENT</h3></u>

            <div>
                <p class="d-inline bg-danger">Je soussigné(e) : <span class="pointille " >{{$decaissement->user->nom}}</span> </p>
                <p>Fonction :  <span class="pointille" >{{$decaissement->user->fonction}}</span></p>
                <p>Déclare avoir remis la somme de (en chiffre et en lettre)  :  <span class="pointille" >{{ number_format($decaissement->somme,0,'.',' ')}}</span>  <span>({{ " ".ucfirst($lettre->format($decaissement->somme)) }}) <span class="pointille">Fcfa</span></span></p>
                <p>A (Demandeur(s)) :  <span class="pointille" >
                    @foreach ($decaissement->employes as $employe)
                            {{$employe->nom.' '.$employe->prenom.';' ?? ''}}
                    @endforeach
                </span></p>
                <p>Motif(s) de la sortie :  <span class="pointille" >{{$decaissement->motif->libelle.", ".$decaissement->motif->description}}</span></p>
                <br>
                <p>En foi de quoi, la présente fiche est établie pour servir et valoir ce que de droit.</p>
                <br>
                <u><b>Caissier</b></u>
                <p>Nom :  <span class="pointille" >{{$decaissement->user->nom}}</span></p>
                <p>Signature :  <span class="*" ></span></p>

                <u><b>Demandeur</b></u>
                <p>Nom(s) :  <span class="pointille" >
                    @foreach ($decaissement->employes as $employe)
                                {{$employe->nom.' '.$employe->prenom.';' ?? ''}}
                    @endforeach
                </span></p>
                <p>Signature :  <span class="*" ></span></p>

                <u><b>Autorisé(e) par</b></u>
                <p>Nom :  <span class="pointille" >{{$decaissement->autorisePar}}</span></p>
                <p>Signature :  <span class="*" ></span></p>

                <br>
                <br>
                <br>
                <br>
                <p style="float:right; margin-right:10%">Fait à Libreville le <span>{{$decaissement->created_at->format("d/m/Y")}}</span></p>
            </div>
        </div>
    </section>
</body>
</html>
