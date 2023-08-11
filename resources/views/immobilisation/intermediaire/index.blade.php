@extends('layouts.appImmo')
@section('content')
<section class="section dashboard">
<div class="row">
        <div class="pagetitle">
            <div class="">
                <h1>Matériels non amortissables</h1>

                <div class="card float-end m-3">
                    <div class="p-2">
                        <div class=" col-sm-6 d-inline">
                            <a class="badge text-bg-success btn" href="{{ route('materiel.export.intermediaire') }}"> Exporter <i class="bi bi-file-earmark-spreadsheet"></i></a>
                            <a class="badge text-bg-warning btn" type="button" data-bs-toggle="modal" data-bs-target="#addMateriel"> Catégorie <i class="bi bi-plus-lg"></i></a>
                        </div>
                    </div>
                </div>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                        <li class="breadcrumb-item active">Matériels non amortissables</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

@php
    $nombres=0;
     foreach ($intermediaires as $intermediaire){
        foreach ($intermediaire->entres as $entre) {
            $nombres=$nombres+$entre->quantite;
        }
     }
@endphp
    <div class="container">
        <div class="row ">

            <div class="col-sm-4">
                <div class="card info-card sales-card">
                    <div class="card-body ">
                        <h5 class="card-title f-2">VALEUR <!-- <span>| Today</span> --></h5>

                        <div class="d-flex align-items-center ms-5">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency text-success">{{ $monaie }}</i>
                          </div>
                          <div class="ps-3">
                            <h6>{{ number_format($cout_total ,0,'.',' ') }}</h6>
                            {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                          </div>
                        </div>
                      </div>
                </div><!-- End Card with titles, buttons, and links -->
            </div>

            <div class="col-sm-4">
                <div class="card info-card sales-card">
                    <div class="card-body ">
                        <h5 class="card-title f-2">CATEGORIE <!-- <span>| Today</span> --></h5>

                        <div class="d-flex align-items-center ms-5">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency text-success"><i class="bi bi-boxes"></i></i>
                          </div>
                          <div class="ps-3">
                            <h6>{{ number_format($intermediaires->count() ,0,'.',' ') }}</h6>
                            {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                          </div>
                        </div>
                    </div>
                </div><!-- End Card with titles, buttons, and links -->
            </div>

            <div class="col-sm-4">
                <div class="card info-card sales-card">
                    <div class="card-body ">
                        <h5 class="card-title f-2">MATERIEL <!-- <span>| Today</span> --></h5>

                        <div class="d-flex align-items-center ms-5">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency text-success"><i class="bi bi-laptop"></i></i>
                          </div>
                          <div class="ps-3">
                            <h6>{{ number_format($nombres ,0,'.',' ') }}</h6>
                            {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                          </div>
                        </div>
                    </div>
                </div><!-- End Card with titles, buttons, and links -->
            </div>





            {{-- @foreach ($intermediaires as $intermediaire)
            <div class="col-sm-3">
                <div class="card bg-body-secondary">
                    <div class="card-body">
                        <img class="float-end m-3" src="{{asset('icons/package.png')}}" alt="">
                      <h4 class=" fs-3 card-title">{{$intermediaire->designation}}</h4>
                      <h6 class="card-subtitle mb-2 text-muted"></h6>
                      <h3 class="text-center">

                        {{$categorie->materiels->count() }} <br> type de marchandise
                      </h3>

                      <div class="float-end">
                        <form class="d-inline" action="{{route('materiel.intermediaire.delete',$intermediaire->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="card-link text-bg-danger badge" onclick=" return confirm('Êtes vous sûr de vouloir supprimer?')">supprimer </button>
                        </form>
                        <a href="{{route('materiel.intermediaire.show',$intermediaire->id)}}" class=" text-bg-warning badge">Voir</a>
                      </div>
                    </div>
                </div><!-- End Card with titles, buttons, and links -->
            </div>
            @endforeach --}}
            <div class="table-responsive bg-body-secondary">
                <table class="table datatable">
                    <thead>
                        <th>N°</th>
                        <th>Catégorie</th>
                        <th class="text-center">Quantité</th>
                        <th>Coût total</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @php
                            $nombre=0;
                        @endphp
                        @foreach ($intermediaires as $intermediaire)

                            @php

                            $nombre=0;

                                foreach ($intermediaire->entres as $entre) {
                                    $nombre=$nombre+$entre->quantite;
                                }


                                // foreach ($intermediaires as $intermediaire) {
                                    $cout_par_entre=0;
                                    $cout_par_type=0;
                                    foreach ($intermediaire->entres as $entre) {
                                         $cout_par_entre= $entre->cout_achat*$entre->quantite;
                                         $cout_par_type=$cout_par_type + $cout_par_entre;
                                // }
            // echo $cout_par_type=$cout_par_type + $cout_par_entre; echo '</br>';
        }
                            @endphp

                        <tr>
                            <td>{{$id++}}</td>
                            <td>{{$intermediaire->designation}}</td>
                            <td class="text-center">{{$nombre}}</td>
                            <td>{{ number_format($cout_par_type ,0,'.',' ').$monaie }}</td>
                            <td>

                                <a href="{{route('materiel.intermediaire.show',$intermediaire->id)}}" class=" text-bg-warning badge">Afficher</a>
                                <form class="d-inline" action="{{route('materiel.intermediaire.delete',$intermediaire->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="card-link text-bg-danger badge" onclick=" return confirm('Êtes vous sûr de vouloir supprimer?')">supprimer </button>
                                </form>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>

                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

</div>
</section>


<div class="modal fade" id="addMateriel" tabindex="-1">
<div class="modal-dialog modal-dialog">
  <div class="modal-content">
    <div class="card">
        <div class="modal-header">
            <div class="modal-title">
                <h5> Matériel</h5>

            </div>
            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    <div class="modal-body">
        <form class="row g-3 p-" method="POST" action="{{route('materiel.intermediaire.store')}}">
            @csrf
            <div>
                @foreach ($errors->all() as $message)
                    <span class="">{{$message}}</span>
                @endforeach
            </div>
            <div class="col-md-12 form-floating">
              <input type="text" class="form-control" name="designation" placeholder="designation">
              <label for="designation"  class="form-label">Désignation</label>
            </div>

            <div class="">
                <button type="submit" class="btn btn-success float-end">Valider</button>
            </div>
          </form><!-- End No Labels Form -->
    </div>

  </div>
</div>
</div><!-- End Vertically centered Modal-->




</div>


@if(Session::has('message'))

<script>
    toastr.success("{!! Session::get('message') !!}");
</script>

@endif

@if($errors->all())

<script>
    toastr.error("Une erreur c'est produite");
</script>

@endif
@endsection
