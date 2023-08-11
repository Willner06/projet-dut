@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <div class="">
        <h1>Carburant</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Frais de Carburant</li>
            </ol>
        </nav>
    </div>

</div><!-- End Page Title -->

<div>
    <h5 class=" float-end " style="width:350px">
        <div class="search-bar header pt-3 pe-2">
            <form class="search-form d-flex align-items-center" method="POST" action="{{route('caisse.decaissement.searchCarburant')}}">
                @csrf
              <input type="month" name="query" placeholder="Search" title="Entrez le mois recherché" required>
              <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
          </div><!-- End Search Bar -->
    </h5>
  {{-- <h5 class="card-title m-2">Frais de autre</h5> --}}
</div> <br>
<br>
<br>

<div class="card">


@if (Route::is('caisse.decaissement.carburant'))
<section>

    <div class="">


<div class="">
    <div class="">
      <h5 class="card-title">Frais de carburant {{date("M Y")}}</h5>


            <div class="table-responsive">
                <table class="table datatable table-bordered">
                    <thead class="text-center">
                        <tr class="text-white text-center" style="background-color: #254b7d">
                            <th>Dates</th>
                            <th>Montants</th>
                            <th>Dénomination</th>
                            <th>Règlement</th>
                            <th>Mois</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carburants as $carburant)
                        <tr class="text-center">
                            <td>{{$carburant->created_at->format('d/M/y')}}</td>
                            <td class="text-">{{number_format($carburant->somme,0,'.',' ').$monaie}}</td>
                                <td>{{$carburant->motif->reglement->denomination}}</td>
                            @if ($carburant->motif->reglement->reglement == "1")
                                <td><img src="{{asset('icons/yes.png')}}" alt=""></td>
                            @else
                                <td><img src="{{asset('icons/no.png')}}" alt=""></td>
                            @endif
                            <td>{{date("M Y")}}</td>
                            <td>
                                @if ($carburant->motif->reglement->denomination == null)
                                <a href="" class="badge text-bg-warning" data-bs-toggle="modal" data-bs-target="#control-{{$carburant->motif->id}}">
                                    Régler
                                </a>
                                @else

                                @endif
                            </td>
                        </tr>
                        <div class="modal fade" id="control-{{$carburant->motif->id}}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="card">
                                    <div class="modal-header">
                                        <div class="modal-title">
                                            <h5> Règlement -{{$carburant->motif->id}}</h5>

                                        </div>
                                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                <div class="modal-body">
                                    <form class="row g-3 p-" method="POST" action="{{route('caisse.reglement.store')}}">
                                        @csrf
                                        <div>
                                            @foreach ($errors->all() as $message)
                                                <span class="">{{$message}}</span>
                                            @endforeach
                                        </div>
                                        <div class="col-md-12 form-floating mt-4">
                                          <input type="text" name="denomination" class="form-control" placeholder="Dénomination" required>
                                          <label for="denomination"  class="form-label">Dénomination</label>
                                        </div>
                                        {{-- <div class="col-md-12 form-check form-switch form-control mt-4">
                                            <label for="" class="for-label ">Règlement :</label><br>
                                            <label class="switch" style="margin-left: 30%" >
                                                <input type="checkbox" name="reglement">
                                                <span class="slider"></span>
                                              </label>

                                        </div> --}}

                                        <div class="">
                                            <button type="submit" class="btn btn-success float-end" name="validation" value="{{$carburant->motif->reglement->id}}">Valider</button>
                                          </div>
                                      </form><!-- End No Labels Form -->
                                </div>

                              </div>
                            </div>
                          </div><!-- End Vertically centered Modal-->

                        </div>
                        @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                <table class="table w-50">
                    <tbody>
                        <tr class="bg-primary text-white ">
                            <td class="text-end">Total</td>
                            <td class="text-center">{{number_format($totalMoisEnCour,0,'.',' ').$monaie}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>

</section>


@else


<section>
    <div class="card">
        <div>
          <h5 class="card-title ">Frais de carburant {{$mois." ".$annee}}</h5>
        </div>

        <div class="card table-responsive">
            <table class="table datatable table-bordered">
                <thead class="text-center">
                    <tr class="text-white text-center" style="background-color: #254b7d">
                        <th>Dates</th>
                        <th>Montants</th>
                        <th>Dénomination</th>
                        <th>Règlement</th>
                        <th>Mois</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carburants as $carburant)
                    <tr class="text-center">
                        <td>{{$carburant->created_at->format('d/M/y')}}</td>
                        <td class="text-">{{number_format($carburant->somme,0,'.',' ').$monaie}}</td>
                            <td>{{$carburant->motif->reglement->denomination}}</td>
                        @if ($carburant->motif->reglement->reglement == "1")
                            <td><img src="{{asset('icons/yes.png')}}" alt=""></td>
                        @else
                            <td><img src="{{asset('icons/no.png')}}" alt=""></td>
                        @endif
                        <td>{{date("M Y")}}</td>
                        <td>
                            @if ($carburant->motif->reglement->denomination == null)
                            <a href="" class="badge text-bg-warning" data-bs-toggle="modal" data-bs-target="#control-{{$carburant->motif->id}}">
                                Régler
                            </a>
                            @else
                           a
                            @endif
                        </td>
                    </tr>
                    <div class="modal fade" id="control-{{$carburant->motif->id}}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="card">
                                <div class="modal-header">
                                    <div class="modal-title">
                                        <h5> Règlement -{{$carburant->motif->id}}</h5>

                                    </div>
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <div class="modal-body">
                                <form class="row g-3 p-" method="POST" action="{{route('caisse.reglement.store')}}">
                                    @csrf
                                    <div>
                                        @foreach ($errors->all() as $message)
                                            <span class="">{{$message}}</span>
                                        @endforeach
                                    </div>
                                    <div class="col-md-12 form-floating mt-4">
                                      <input type="text" name="denomination" class="form-control" placeholder="Dénomination" required>
                                      <label for="denomination"  class="form-label">Dénomination</label>
                                    </div>
                                    {{-- <div class="col-md-12 form-check form-switch form-control mt-4">
                                        <label for="" class="for-label ">Règlement :</label><br>
                                        <label class="switch" style="margin-left: 30%" >
                                            <input type="checkbox" name="reglement">
                                            <span class="slider"></span>
                                          </label>

                                    </div> --}}

                                    <div class="">
                                        <button type="submit" class="btn btn-success float-end" name="validation" value="{{$carburant->motif->reglement->id}}">Valider</button>
                                      </div>
                                  </form><!-- End No Labels Form -->
                            </div>

                          </div>
                        </div>
                      </div><!-- End Vertically centered Modal-->

                    </div>
                    @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>
            <table class="table w-50 ">
                <tbody>
                    <tr class="bg-primary text-white ">
                        <td class="text-end">Total</td>
                        <td class="text-center">{{number_format($totalMoisEnCour,0,'.',' ').$monaie}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@endif



</div>



    <style>
        .switch {
 position: relative;
 display: inline-block;
 width: 120px;
 height: 34px;
}

.switch input {
 display: none;
}

.slider {
 position: absolute;
 cursor: pointer;
 top: 0;
 left: 0;
 right: 0;
 bottom: 0;
 background-color: #3C3C3C;
 -webkit-transition: .4s;
 transition: .4s;
 border-radius: 34px;
}

.slider:before {
 position: absolute;
 content: "";
 height: 26px;
 width: 26px;
 left: 4px;
 bottom: 4px;
 background-color: white;
 -webkit-transition: .4s;
 transition: .4s;
 border-radius: 50%;
}

input:checked + .slider {
 background-color: #0E6EB8;
}

input:focus + .slider {
 box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
 -webkit-transform: translateX(26px);
 -ms-transform: translateX(26px);
 transform: translateX(85px);
}

/*------ ADDED CSS ---------*/
.slider:after {
 content: 'Pas effectué';
 color: white;
 display: block;
 position: absolute;
 transform: translate(-50%,-50%);
 top: 50%;
 left: 50%;
 font-size: 10px;
 font-family: Verdana, sans-serif;
}

input:checked + .slider:after {
 content: 'Effectué';
}

/*--------- END --------*/
    </style>
@endsection
