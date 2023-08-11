@extends('layouts.app')
@section('content')
<div class="row">
    <div class="pagetitle">
        <div class="">
            <h1>Encaissements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Encaissements</li>
                </ol>
            </nav>
        </div>

    </div><!-- End Page Title -->

    <div class="col-sm-12"><div class="">
        @can('Créer les encaissements')
        <div class="card-body">
            <div class="float-end card" >
              <button class="btn btn-success float-end m-2" data-bs-toggle="modal" data-bs-target="#addencaissement">Ajouter</button>
            </div><br><br><br>
        </div>
        @endcan
           <!-- Recent Sales -->
              {{-- <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div> --}}
              <div class="card">
                <div style="box-shadow: 1px 1px 10px black;" class="table-responsive ">
                    {{-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> --}}

                    <table class="table datatable table-striped" >
                      <thead >
                        <tr >
                            <th class="text-center" scope="col">N° Piece</th>
                            <th class="text-center" scope="col">Date</th>
                            <th class="text-center" scope="col">Caissier</th>
                            <th class="text-center" scope="col">Déposant</th>
                            <th class="text-center" scope="col">Montant</th>
                            <th class="text-center" scope="col">Motif</th>
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($encaissements as $encaissement)
                        <tr class=" text-center">
                            <th class="text-center">{{$encaissement->num_piece}}</th>
                            <td>{{$encaissement->created_at->format('d/m/Y')}}</td>
                            <td>{{$encaissement->user->nom}}</td>
                            <td>{{$encaissement->deposant}}</td>
                            <td>{{number_format($encaissement->somme,0,'.',' ')." ".$monaie}}</td>
                            <td scope="row">{{$encaissement->motif}}</td>
                            <td>
                                @can('Imprimer les encaissements')
                                    <a href="{{route('caisse.encaissement.export',$encaissement->id)}}" target="_blank" class="badge m-3 text-bg-primary">Imprimer</a>
                                @endcan

                                @can('Modifier les encaissements')
                                    @if ($encaissement->etat == "controlle")

                                    @else
                                        <a href="#" class="badge m-3 text-bg-warning" data-bs-toggle="modal" data-bs-target="#updateEncaissement-{{$encaissement->id}}">modofier</a>
                                    @endif
                                 @endcan
                            </td>
                        </tr>




                        <div class="modal fade" id="updateEncaissement-{{$encaissement->id}}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="card">
                                    <div class="modal-header">
                                        <div class="modal-title">
                                            <h5> Encaissement</h5>
                                        </div>
                                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                <div class="modal-body">
                                    <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('caisse.encaissement.update', $encaissement->id)}}">
                                        @csrf
                                        @method('put')
                                        <div>
                                            @foreach ($errors->all() as $message)
                                                <span class="">{{$message}}</span>
                                            @endforeach
                                        </div>
                                        <div class="col-md-12">
                                            <label for="deposant"  class="form-label">Nom du déposant</label>
                                            <input type="text" name="deposant" class="form-control" value="{{$encaissement->deposant}}">

                                        </div>
                                        {{-- <div class="col-md-6 form-floating">
                                            <select class="form-select bg-dark-subtle text-emphasis-dark" name="code" id="code">
                                                <option value=""></option>
                                                <option value="001"> 001</option>
                                                <option value="002">002</option>
                                                <option value="003">003</option>
                                                <option value="004">004</option>
                                            </select>
                                        </div> --}}
                                        <div class="col-md- ">
                                            <label for="somme" class="form-label">Somme</label>
                                            <input type="number" name="somme" class="form-control" value="{{$encaissement->somme}}">

                                        </div>
                                        <div class="col-md-12">

                                          <label for="motif" class="form-label">Motif</label>
                                          <textarea name="motif" id="motif" cols="30" rows="10" class="form-control" placeholder="Motif de l'encaissement" style="height: 200px">{{$encaissement->motif}}</textarea>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-success float-end">Valider</button>
                                          </div>
                                      </form><!-- End No Labels Form -->
                                </div>

                              </div>
                            </div>
                          </div><!-- End Vertically centered Modal-->


                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="addencaissement" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="card">
            <div class="modal-header">
                <div class="modal-title">
                    <h5> Encaissement</h5>

                </div>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('caisse.encaissement.store')}}">
                @csrf
                <div>
                    @foreach ($errors->all() as $message)
                        <span class="">{{$message}}</span>
                    @endforeach
                </div>
                <div class="col-md-12 form-floating">
                  <input type="text" name="deposant" class="form-control" placeholder="Nom du déposant">
                  <label for="deposant"  class="form-label">Nom du déposant</label>
                </div>
                {{-- <div class="col-md-6 form-floating">
                    <select class="form-select bg-dark-subtle text-emphasis-dark" name="code" id="code">
                        <option value=""></option>
                        <option value="001"> 001</option>
                        <option value="002">002</option>
                        <option value="003">003</option>
                        <option value="004">004</option>
                    </select>
                </div> --}}
                <div class="col-md- form-floating">
                  <input type="number" name="somme" class="form-control" id="Conso" placeholder="Montant" oninput="formatInput(this)">
                  <label for="somme" class="form-label">Montant</label>
                </div>
                <div class="col-md-12 form-floating">
                  <textarea name="motif" id="motif" cols="30" rows="10" class="form-control" placeholder="Motif de l'encaissement" style="height: 200px"></textarea>
                  <label for="motif" class="form-label">Motif</label>
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
</div>
</div>

{{-- <script>
    $('#Conso').on('keyup', function (e){
  var v = $(this).val().replace(/\s/g, '').replace(',', '.');
  e.key!=','&&e.key!='.' ? !isNaN(parseFloat(v)) ? $(this).val(parseFloat(v).toLocaleString("fr-FR")): null : null;
})


</script> --}}

@if(Session::has('message'))

<script>
    toastr.success("{!! Session::get('message') !!}");
</script>

@endif

@if(Session::has('cloture'))

<script>
    toastr.error("{!! Session::get('cloture') !!}");
</script>

@endif

@if($errors->all())

<script>
    toastr.error("Une erreur c'est produite");
</script>

@endif
@endsection
