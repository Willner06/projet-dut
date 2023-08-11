@extends('layouts.app')
@section('content')

<style>
    .carte{
        cursor: pointer;
        box-shadow: 1px 1px 10px black;
    }

    #transportDuMois{
        display: block;

    }

    #transportSurvey{
        display: none;
    }

    #transportProspection{
        display: none;
    }

    #transportLivraison{
        display: none;
    }

    #transportProcedure{
        display: none;
    }

    #transportIntervention{
        display: none;
    }
</style>
    {{-- section total --}}
    <div class="pagetitle">
        <div class="">
            <h1>Transport</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Frais de transport</li>
                </ol>
            </nav>
        </div>

    </div><!-- End Page Title -->
    <section>
        <div>
            <h5 class=" float-end " style="width:350px">
                <div class="search-bar header pt-2 pe-2">
                    <form class="search-form d-flex align-items-center" method="POST" action="{{route('caisse.decaissement.searchTransport')}}">
                        @csrf
                      <input type="month" name="query" placeholder="Search" title="Entrez le mois recherché" max="{{date("Y-m")}}" required>
                      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                  </div><!-- End Search Bar -->
            </h5>
        </div><br><br> <br>
        <div class="card">
            <div class="row container p-4" >

                <div class="card col-sm-3 ms-4 me-5 carte" onclick="getLivraison()">
                    <div class="card-title">
                        <div >
                            Livraisons
                            <img class="float-end pe-3"  src="{{asset('icons/fast-delivery.png')}}" alt="">
                        </div>
                    </div>
                    <div class="container d-flex">
                        <h4 class="w-25 float-end ps-">{{count($livraisons)}}</h4>
                        <h5 class="float-end w-75 pt-1" style="color: #71d1f5">{{number_format($totalLivraisons ,0,'.',' ').$monaie}}</h5>
                    </div>
                </div>
                <div class="card col-sm-3 ms-4 me-5 carte" onclick="getSurvey()">
                    <div class="card-title">
                        <div >
                            Survey
                            <img class="float-end pe-3"  src="{{asset('icons/shopping-list.png')}}" alt="">

                        </div>
                    </div>
                    <div class="container d-flex">
                        <h4 class="w-25 float-end ps-">{{count($surveys)}}</h4>
                        <h5 class="float-end w-75 pt-1" style="color: #71d1f5">{{number_format($totalSurveys,0,'.',' ').$monaie}}</h5>
                    </div>
                </div>
                <div class="card col-sm-3 ms-4 me-5 carte" onclick="getProspection()">
                    <div class="card-title">
                        <div >
                            Prospection
                            <img class="float-end pe-3"  src="{{asset('icons/searching.png')}}" alt="">

                        </div>
                    </div>
                    <div class="container d-flex">
                        <h4 class="w-25 float-end ps-">{{count($prospections)}}</h4>
                        <h5 class="float-end w-75 pt-1" style="color: #71d1f5">{{number_format($totalProspections,0,'.',' ').$monaie}}</h5>
                    </div>
                </div>
                <div class="card col-sm-3 ms-4 me-5 carte" onclick="getProcedure()">
                    <div class="card-title">
                        <div >
                            Procedures administratives
                        </div>
                    </div>
                    <div class="container d-flex">
                        <h4 class="w-25 float-end ps-">{{count($procedures)}}</h4>
                        <h5 class="float-end w-75 pt-1" style="color: #71d1f5">{{number_format($totalProcedures,0,'.',' ').$monaie}}</h5>
                    </div>
                </div>
                <div class="card col-sm-3 ms-4 me-5 carte" onclick="getIntervention()">
                    <div class="card-title">
                        <div >
                            Interventions
                        </div>
                    </div>
                    <div class="container d-flex">
                        <h4 class="w-25 float-end ps-">{{count($interventions)}}</h4>
                        <h5 class="float-end w-75 pt-1" style="color: #71d1f5">{{number_format($totalInterventions,0,'.',' ').$monaie}}</h5>
                    </div>
                </div>
                <div class="card col-sm-3 ms-4 me-5 carte" onclick="getTotal()">
                    <div class="card-title">
                        <div >
                            Total
                        </div>
                    </div>
                    <div class="container d-flex">
                        <h4 class="w-25 float-end ps-">{{count($transportDuMois)}}</h4>
                        <h5 class="float-end w-75 pt-1" style="color: #71d1f5">{{number_format($total,0,'.',' ').$monaie}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="card mt-3 p-2 table-responsive" id="transportDuMois">
            <h4 class="m-4">Décaissements liés au transport du mois de <u class="text-danger">{{$date}}</u></h4>
            <table class="text-center table table-striped bg-primary-subtle datatable table-hover">
                <thead>
                    <tr >
                        <th>Date</th>
                        <th>N° Piece</th>
                        <th>Motif</th>
                        <th>Description</th>
                        <th>Montant</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transportDuMois as $transport)
                    <tr>
                        <td>{{$transport->created_at->format('d/M/y')}}</td>
                        <td>{{$transport->num_piece}}</td>
                        <td>{{$transport->motif->libelle}}</td>
                        <td>{{$transport->motif->description}}</td>
                        <td>{{number_format($transport->somme,0,'.',' ').$monaie}}</td>
                        <td>
                            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$transport->id}}">Voir</a>
                        </td>
                    </tr>



  <!-- Modal -->
  <div class="modal modal-fullscreen-lg-down" id="exampleModal-{{$transport->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{$transport->num_piece}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row">
            <div class="card m-2" style="width: 14rem;">
                <div class="card-body">
                    <div>
                        <h5 class="card-title">Somme alouée</h5>
                        <p class="card-text ms-3">{{number_format($transport->somme,0,'.',' ').$monaie}}</p>
                    </div>
                </div>
            </div>

            <div class="card m-2" style="width: 14rem;">
                <div class="card-body">
                    <div>
                    <h5 class="card-title">Motifs</h5>
                    <h5>{{$transport->motif->libelle}}</h5>
                    </div>
                </div>

            </div>

            <div class="card m-2" style="width: 29rem;">
                <div class="card-body">
                    <div>
                        <h5 class="card-title">Description</h5>
                        <p class="card-text ms-3">{{$transport->motif->description}}</p>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>


                    @endforeach
                </tbody>
            </table>
        </div>

{{-- survey --}}

    <div class="card mt-3 p-2 table-responsive" id="transportSurvey">
        <div class="card-title">
            <h3>Surveys du mois de {{$date}}</h3>
        </div>
        <table class="text-center table table-striped bg-success-subtle datatable table-hover">
            <thead>
                <tr >
                    <th>Date</th>
                    <th>N° Piece</th>
                    <th>Description</th>
                    <th>Montant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($surveys as $survey)
                <tr>
                    <td>{{$survey->created_at->format('d/M/y')}}</td>
                    <td>{{$survey->num_piece}}</td>
                    <td>{{$survey->motif->description}}</td>
                    <td>{{$survey->somme}}</td>
                    <td>
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSurvey-{{$survey->id}}">Voir</a>
                    </td>
                </tr>



<!-- Modal -->
<div class="modal modal-fullscreen-lg-down" id="modalSurvey-{{$survey->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="modal-title fs-5" id="exampleModalLabel">{{$survey->num_piece}}</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body row">
        <div class="card m-2" style="width: 14rem;">
            <div class="card-body">
                <div>
                    <h5 class="card-title">Somme alouée</h5>
                    <p class="card-text ms-3">{{number_format($survey->somme,0,'.',' ').$monaie}}</p>
                </div>
            </div>
        </div>

        <div class="card m-2" style="width: 14rem;">
            <div class="card-body">
                <div>
                <h5 class="card-title">Motif</h5>
                {{-- @foreach ($survey->motifs as $motif) --}}
                    <h5>{{$survey->motif->libelle}}</h5>
                {{-- @endforeach --}}
                </div>
            </div>

        </div>

        <div class="card m-2" style="width: 29rem;">
            <div class="card-body">
                <div>
                    <h5 class="card-title">Description</h5>
                    <p class="card-text ms-3">{{$survey->motif->description}}</p>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>
</div>
@endforeach
            </tbody>
        </table>
    </div>



{{-- Prospection --}}

<div class="card mt-3 p-2 table-responsive" id="transportProspection">
    <div class="card-title">
        <h3>Prospections du mois de {{$date}}</h3>
    </div>
    <table class="text-center table table-striped bg-warning-subtle datatable table-hover">
        <thead>
            <tr >
                <th>Date</th>
                <th>N° Piece</th>
                <th>Description</th>
                <th>Montant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prospections as $prospection)
            <tr>
                <td>{{$prospection->created_at->format('d/M/y')}}</td>
                <td>{{$prospection->num_piece}}</td>
                <td>{{$prospection->motif->description}}</td>
                <td>{{$prospection->somme}}</td>
                <td>
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalprospection-{{$prospection->id}}">Voir</a>
                </td>
            </tr>



<!-- Modal -->
<div class="modal modal-fullscreen-lg-down" id="modalprospection-{{$prospection->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h1 class="modal-title fs-5" id="exampleModalLabel">{{$prospection->num_piece}}</h1>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body row">
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <div>
                <h5 class="card-title">Somme alouée</h5>
                <p class="card-text ms-3">{{number_format($prospection->somme,0,'.',' ').$monaie}}</p>
            </div>
        </div>
    </div>

    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <div>
            <h5 class="card-title">Motifs</h5>
            <h5>{{$prospection->motif->libelle}}</h5>

            </div>
        </div>

    </div>

    <div class="card m-2" style="width: 29rem;">
        <div class="card-body">
            <div>
                <h5 class="card-title">Description</h5>
                <p class="card-text ms-3">{{$prospection->motif->description}}</p>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
@endforeach
        </tbody>
    </table>
</div>



{{-- intervention --}}

<div class="card mt-3 p-2 table-responsive" id="transportIntervention">
    <div class="card-title">
        <h3>Interventions du mois de {{$date}}</h3>
    </div>
    <table class="text-center table table-striped bg-danger-subtle datatable table-hover">
        <thead>
            <tr >
                <th>Date</th>
                <th>N° Piece</th>
                <th>Description</th>
                <th>Montant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($interventions as $intervention)
            <tr>
                <td>{{$intervention->created_at->format('d/M/y')}}</td>
                <td>{{$intervention->num_piece}}</td>
                <td>{{$intervention->motif->description}}</td>
                <td>{{$intervention->somme}}</td>
                <td>
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalintervention-{{$intervention->id}}">Voir</a>
                </td>
            </tr>



<!-- Modal -->
<div class="modal modal-fullscreen-lg-down" id="modalintervention-{{$intervention->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h1 class="modal-title fs-5" id="exampleModalLabel">{{$intervention->num_piece}}</h1>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body row">
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <div>
                <h5 class="card-title">Somme alouée</h5>
                <p class="card-text ms-3">{{number_format($intervention->somme,0,'.',' ').$monaie}}</p>
            </div>
        </div>
    </div>

    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <div>
            <h5 class="card-title">Motifs</h5>
            <h5>{{$intervention->motif->libelle}}</h5>

            </div>
        </div>

    </div>

    <div class="card m-2" style="width: 29rem;">
        <div class="card-body">
            <div>
                <h5 class="card-title">Description</h5>
                <p class="card-text ms-3">{{$intervention->motif->description}}</p>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
@endforeach
        </tbody>
    </table>
</div>



{{-- livrason --}}

<div class="card mt-3 p-2 table-responsive" id="transportLivraison">
    <div class="card-title">
        <h3>Livraisons du mois de {{$date}}</h3>
    </div>
    <table class="text-center table table-striped bg-dark-subtle datatable table-hover">
        <thead>
            <tr >
                <th>Date</th>
                <th>N° Piece</th>
                <th>Description</th>
                <th>Montant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livraisons as $livraison)
            <tr>
                <td>{{$livraison->created_at->format('d/M/y')}}</td>
                <td>{{$livraison->num_piece}}</td>
                <td>{{$livraison->motif->description}}</td>
                <td>{{$livraison->somme}}</td>
                <td>
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modallivraison-{{$livraison->id}}">Voir</a>
                </td>
            </tr>



<!-- Modal -->
<div class="modal modal-fullscreen-lg-down" id="modallivraison-{{$livraison->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h1 class="modal-title fs-5" id="exampleModalLabel">{{$livraison->num_piece}}</h1>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body row">
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <div>
                <h5 class="card-title">Somme alouée</h5>
                <p class="card-text ms-3">{{number_format($livraison->somme,0,'.',' ').$monaie}}</p>
            </div>
        </div>
    </div>

    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <div>
            <h5 class="card-title">Motifs</h5>
            <h5>{{$livraison->motif->libelle}}</h5>

            </div>
        </div>

    </div>

    <div class="card m-2" style="width: 29rem;">
        <div class="card-body">
            <div>
                <h5 class="card-title">Description</h5>
                <p class="card-text ms-3">{{$livraison->motif->description}}</p>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
@endforeach
        </tbody>
    </table>
</div>



{{-- livrason --}}

<div class="card mt-3 p-2 table-responsive" id="transportProcedure">
    <div class="card-title">
        <h3>Procedures administratives du mois de {{$date}}</h3>
    </div>
    <table class="text-center table table-striped bg-dark-subtle datatable table-hover">
        <thead>
            <tr >
                <th>Date</th>
                <th>N° Piece</th>
                <th>Description</th>
                <th>Montant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($procedures as $procedure)
            <tr>
                <td>{{$procedure->created_at->format('d/M/y')}}</td>
                <td>{{$procedure->num_piece}}</td>
                <td>{{$procedure->motif->description}}</td>
                <td>{{$procedure->somme}}</td>
                <td>
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalprocedure-{{$procedure->id}}">Voir</a>
                </td>
            </tr>



<!-- Modal -->
<div class="modal modal-fullscreen-lg-down" id="modalprocedure-{{$procedure->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h1 class="modal-title fs-5" id="exampleModalLabel">{{$procedure->num_piece}}</h1>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body row">
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <div>
                <h5 class="card-title">Somme alouée</h5>
                <p class="card-text ms-3">{{number_format($procedure->somme,0,'.',' ').$monaie}}</p>
            </div>
        </div>
    </div>

    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <div>
            <h5 class="card-title">Motifs</h5>
            <h5>{{$procedure->motif->libelle}}</h5>

            </div>
        </div>

    </div>

    <div class="card m-2" style="width: 29rem;">
        <div class="card-body">
            <div>
                <h5 class="card-title">Description</h5>
                <p class="card-text ms-3">{{$procedure->motif->description}}</p>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
@endforeach
        </tbody>
    </table>
</div>

</section>





<script>

function getTotal(){
        $('#transportDuMois').show();
        $('#transportSurvey').hide();
        $('#transportLivraison').hide();
        $('#transportProspection').hide();
        $('#transportProcedure').hide();
        $('#transportIntervention').hide();
    }

    function getSurvey(){
        $('#transportDuMois').hide();
        $('#transportSurvey').show();
        $('#transportLivraison').hide();
        $('#transportProspection').hide();
        $('#transportProcedure').hide();
        $('#transportIntervention').hide();
    }

    function getLivraison(){
        $('#transportDuMois').hide();
        $('#transportSurvey').hide();
        $('#transportLivraison').show();
        $('#transportProspection').hide();
        $('#transportProcedure').hide();
        $('#transportIntervention').hide();
    }

    function getProspection(){
        $('#transportDuMois').hide();
        $('#transportSurvey').hide();
        $('#transportLivraison').hide();
        $('#transportProspection').show();
        $('#transportProcedure').hide();
        $('#transportIntervention').hide();
    }

    function getProcedure(){
        $('#transportDuMois').hide();
        $('#transportSurvey').hide();
        $('#transportLivraison').hide();
        $('#transportProspection').hide();
        $('#transportProcedure').show();
        $('#transportIntervention').hide();
    }

    function getIntervention(){
        $('#transportDuMois').hide();
        $('#transportSurvey').hide();
        $('#transportLivraison').hide();
        $('#transportProspection').hide();
        $('#transportProcedure').hide();
        $('#transportIntervention').show();
    }
</script>
@endsection
