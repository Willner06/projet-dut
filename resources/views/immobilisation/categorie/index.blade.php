@extends('layouts.appImmo')
@section('content')

<section class="section dashboard">
    <div class="row">
        <div class="pagetitle">
            <div class="">
                <h1>Matériels amortissables</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                        <li class="breadcrumb-item active">Matériels amortissables</li>
                    </ol>
                </nav>
            </div>

            <div class="card float-end m-3">
                <div class="p-2">
                    <div class=" col-sm-6 d-inline">
                        <a class="badge text-bg-success btn" href="{{ route('materiel.export.csv') }}"> Exporter <i class="bi bi-file-earmark-spreadsheet"></i> </a>
                        <a class="badge text-bg-warning btn" type="button" data-bs-toggle="modal" data-bs-target="#addCategorie"> Catégorie <i class="bi bi-plus-lg"></i></a>
                    </div>
                </div>
            </div>
        </div><!-- End Page Title -->

        @php
        $total_mat=0;
            foreach ($categories as $categorie){
                $total_mat=$total_mat+count($categorie->materiels->where('statut','!=','mise_au_rebut'));
            }
        @endphp


        <div class="container">
            <div class="row">


                <div class="col-sm-4">
                    <div class="card info-card sales-card">
                        <div class="card-body ">
                            <h5 class="card-title f-2">VALEUR <!-- <span>| Today</span> --></h5>

                            <div class="d-flex align-items-center ms-5">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-fca text-success">{{ $monaie }}</i>
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
                                <i class="bi bi-currency text-success"><i class="bi bi-laptop"></i></i>
                              </div>
                              <div class="ps-3">
                                <h6>{{ number_format($categories->count() ,0,'.',' ') }}</h6>
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
                                <h6>{{ number_format($total_mat ,0,'.',' ') }}</h6>
                                {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                              </div>
                            </div>
                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>





                {{-- <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                      <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                          <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                          </li>

                          <li><a class="dropdown-item" href="#">Today</a></li>
                          <li><a class="dropdown-item" href="#">This Month</a></li>
                          <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                      </div>

                      <div class="card-body ">
                        <h5 class="card-title f-2">Valeur totale du matériel <!-- <span>| Today</span> --></h5>

                        <div class="d-flex align-items-center ms-5">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-fca text-success">{{ $monaie }}</i>
                          </div>
                          <div class="ps-3">
                            <h6>{{ number_format($cout_total ,0,'.',' ') }}</h6>
                            {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                          </div>
                        </div>
                      </div>




                    </div>
                  </div><!-- End Sales Card --> --}}

                {{-- @foreach ($categories as $categorie)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <img class="float-end m-3" src="{{asset('icons/package.png')}}" alt="">
                          <h4 class=" fs-3 card-title">{{$categorie->libelle}}</h4>
                          <h6 class="card-subtitle mb-2 text-muted"></h6>
                          <h3 class="text-center">

                            {{$categorie->materiels->count() }} <br> type de marchandise
                          </h3>

                          <div class="float-end">
                            <form class="d-inline" action="{{route('materiel.categorie.delete',$categorie->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="card-link text-bg-danger badge" onclick=" return confirm('Êtes vous sûr de vouloir supprimer?')">supprimer </button>
                            </form>
                            <a href="{{route('materiel.categorie.show', $categorie->id)}}" class=" text-bg-warning badge">Voir</a>
                          </div>
                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>
                @endforeach --}}
                <div class="table-responsive bg-white">
                    <table class="table datatable ">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Catégorie</th>
                                <th>Quantité</th>
                                <th>Coût total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
@php
    $id=1
@endphp
                        <tbody>
                            @foreach ($categories as $categorie)
                            <tr>
                                <td>{{$id++}}</td>
                                <td>{{$categorie->libelle}}</td>
                                <td>{{count($categorie->materiels)}}</td>
                                <td>
                                    @php
                                        $cout=0;
                                        foreach ($categorie->materiels as $mat) {
                                            $cout=$cout+$mat->cout_acquisitionTtc;
                                        }
                                    @endphp
                                    {{number_format($cout,0,'.',' ').$monaie}}
                                </td>
                                <td>
                                    <a href="{{route('materiel.categorie.show', $categorie->id)}}" class=" text-bg-warning badge">Afficher</a>
                                    <form class="d-inline" action="{{route('materiel.categorie.delete',$categorie->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class=" text-bg-danger badge" onclick=" return confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer </button>
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


<div class="modal fade" id="addCategorie" tabindex="-1">
    <div class="modal-dialog modal-dialog">
      <div class="modal-content">
        <div class="card">
            <div class="modal-header">
                <div class="modal-title">
                    <h5> Catégorie</h5>

                </div>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form class="row g-3 p-" method="POST" action="{{route('materiel.categorie.store')}}">
                @csrf
                <div>
                    @foreach ($errors->all() as $message)
                        <span class="">{{$message}}</span>
                    @endforeach
                </div>
                <div class="col-md-12 form-floating">
                  <input type="text" class="form-control" name="libelle" placeholder="libelle">
                  <label for="libelle"  class="form-label">Libelle</label>
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
</section>
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
