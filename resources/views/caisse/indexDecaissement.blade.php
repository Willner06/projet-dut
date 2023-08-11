@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <div class="">
        <h1>Décaissements</h1>
        <nav>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
                <li class="breadcrumb-item active">Décaissements</li>
            </ol>
        </nav>
    </div>

</div><!-- End Page Title -->
<div class="row">

    <div class="col-sm-12"><div class="">
        @can('Créer les décaissements')
        <div class="card-body">

            <div class="float-end card" >
              <button class="btn btn-success float-end m-2" data-bs-toggle="modal" data-bs-target="#adddecaissement">Ajouter</button>
            </div><br><br><br>
        </div>
        @endcan

          <!-- Table with stripped rows -->
          <div class="card">
            <div style="box-shadow: 1px 1px 10px black;" class="table-responsive">
                <table class="table table-striped datatable text-center" >
                    <thead>
                      <tr>
                        <th class="text-center" scope="col">N° pièce</th>
                        <th class="text-center" scope="col">Caissier</th>
                        <th class="text-center" scope="col">Date</th>
                        <th class="text-center" scope="col">Demandeur(s)</th>
                        <th class="text-center" scope="col">Autorisé par</th>
                        <th class="text-center" scope="col">Montant</th>
                        <th class="text-center" scope="col">Motif</th>
                        <th class="text-center" scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($decaissements as $decaissement)
                        <tr>
                            <th>{{$decaissement->num_piece}}</th>
                            <td>{{$decaissement->user->nom}}</td>
                            <td>{{$decaissement->created_at->format('d/m/Y')}}</td>
                            <td>
                                @foreach ($decaissement->employes as $employe)
                                {{$employe->nom.' '.$employe->prenom.';' ?? ''}}
                                @endforeach
                            </td>
                            <td>{{$decaissement->autorisePar}}</td>
                            <td>{{number_format($decaissement->somme,0,'.',' ')." ".$monaie}}</td>
                            <td>
                            {{$decaissement->motif->libelle}}
                            </td>
                            <td>
                                @can('Imprimer les encaissements')
                                    <a href="{{route('caisse.decaissement.export',$decaissement->id)}}" target="_blank" class="badge m-3 text-bg-primary">Imprimer</a>
                                @endcan

                                @can('Modifier les décaissements')
                                    @if ($decaissement->etat == "controlle")

                                    @else
                                        <a href="#" class="badge m-3 text-bg-warning" data-bs-toggle="modal" data-bs-target="#updateDecaissement-{{$decaissement->id}}">Modifier</a>
                                    @endif
                                @endcan

                            </td>


                            <div class="modal fade" id="updateDecaissement-{{$decaissement->id}}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="card">
                                        <div class="modal-header">
                                            <div class="modal-title">
                                                <h5>Modification du décaissement</h5>

                                            </div>
                                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('caisse.decaissement.update', $decaissement->id)}}">
                                            @csrf
                                            @method('put')
                                            <div>
                                                @foreach ($errors->all() as $message)
                                                    <span class="">{{$message}}</span>
                                                @endforeach
                                            </div>
                                            <div class="col-md-12">
                                              <label for="employe_id" id="demandeur"  class="form-label">Nom du demandeur</label>
                                                <select class="form-select" multiple="multiple " id="employe_id" name="employe_id[]" required>

                                                    {{-- @foreach ($employers->unique('nom', 'prenom') as $employer)

                                                    @foreach ($decaissement->employes as $demandeur)

                                                        @if ($demandeur->nom == $employer->nom )
                                                        <option  value="{{$employer->id}}" selected>{{ $employer->nom ?? ''}}</option>

                                                        @else
                                                            <option  value="{{$employer->id}}" >{{ $employer->nom." ".$employer->prenom}}</option>
                                                        @endif


                                                    @endforeach


                                                    @endforeach --}}

                                                    @foreach ($employers->unique('nom', 'prenom') as $employer)

                                                            <option  value="{{$employer->id}}" >{{ $employer->nom." ".$employer->prenom}}</option>


                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                              <label for="code" class="form-label">Code</label>
                                              <input type="number" id="code" name="code" class="form-control" required value="{{ $decaissement->code }}">
                                            </div>
                                            <div class="col-md-12">
                                              <label for="somme" class="form-label">Montant</label>
                                              <input type="number" id="somme" name="somme" class="form-control" value="{{ $decaissement->somme }}" required>

                                            </div>
                                            {{-- <div class="col-md-12">
                                              <label for="autorise_par"  class="form-label">Autorisé par</label>
                                              <input type="text" id="autorise_par" name="autorise_par" class="form-control" value="{{ $decaissement->autorisePar }}"  required>
                                            </div> --}}
                                            <div class="col-md-12" >

                                                <label class="form-label" for="">Motif(s)</label>
                                                <div class="form-control p-3"  style="overflow: auto; height:130px">
                                                    @if ($decaissement->motif->libelle == "prospection")
                                                        <input type="radio" name="motif" class="form-check-input " id="1" value="prospection" checked>
                                                        <label for="1" class="form-label">Prospection</label><br>
                                                    @else
                                                        <input type="radio" name="motif" class="form-check-input " id="1" value="prospection">
                                                        <label for="1" class="form-label">Prospection</label><br>
                                                    @endif

                                                    @if ($decaissement->motif->libelle == "survey")
                                                        <input type="radio" name="motif" class="form-check-input" value="survey" id="2" checked>
                                                        <label for="2" class="form-label">Survey</label><br>
                                                    @else
                                                        <input type="radio" name="motif" class="form-check-input" value="survey" id="2">
                                                        <label for="2" class="form-label">Survey</label><br>
                                                    @endif

                                                    @if ($decaissement->motif->libelle == "procedure administrative")
                                                        <input type="radio" name="motif" class="form-check-input" value="procedure administrative" id="4" checked>
                                                        <label for="4" class="form-label">Procedure administrative</label><br>
                                                    @else
                                                        <input type="radio" name="motif" class="form-check-input" value="procedure administrative" id="4">
                                                        <label for="4" class="form-label">Procedure administrative</label><br>
                                                    @endif

                                                    @if ($decaissement->motif->libelle == "intervention")
                                                        <input type="radio" name="motif" class="form-check-input" value="intervention" id="3" checked>
                                                        <label for="3" class="form-label">Intervention</label><br>
                                                    @else
                                                        <input type="radio" name="motif" class="form-check-input" value="intervention" id="3">
                                                        <label for="3" class="form-label">Intervention</label><br>
                                                    @endif

                                                    @if ($decaissement->motif->libelle == "livraison sur vente")
                                                        <input type="radio" name="motif" class="form-check-input" value="livraison sur vente" id="5" checked>
                                                        <label for="5" class="form-label">Livraison sur vente</label><br>
                                                    @else
                                                        <input type="radio" name="motif" class="form-check-input" value="livraison sur vente" id="5">
                                                        <label for="5" class="form-label">Livraison sur vente</label><br>
                                                    @endif

                                                    @if ($decaissement->motif->libelle == "carburant")
                                                        <input type="radio" name="motif" class="form-check-input" value="carburant" id="6" checked>
                                                        <label for="6" class="form-label">Carburant</label><br>
                                                    @else
                                                        <input type="radio" name="motif" class="form-check-input" value="carburant" id="6">
                                                        <label for="6" class="form-label">Carburant</label><br>
                                                    @endif

                                                    @if ($decaissement->motif->libelle == "communication")
                                                        <input type="radio" name="motif" class="form-check-input" value="communication" id="7" checked>
                                                        <label for="7" class="form-label">Communication</label><br>
                                                    @else
                                                        <input type="radio" name="motif" class="form-check-input" value="communication" id="7">
                                                        <label for="7" class="form-label">Communication</label><br>
                                                    @endif

                                                    @if ($decaissement->motif->libelle == "autre")
                                                        <input type="radio" name="motif" class="form-check-input" value="autre" id="autre">
                                                        <label for="autre" class="form-label">autre</label>
                                                    @else
                                                        <input type="radio" name="motif" class="form-check-input" value="autre" id="autre">
                                                        <label for="autre" class="form-label">autre</label>
                                                    @endif





                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                              <label for="description" class="form-label">Décrire en quelques ligne le motif</label>
                                                <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="height: 200px" required> {{ $decaissement->motif->description }}</textarea>
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

                          </tr>

                        @endforeach

                    </tbody>
                  </table>
              </div>
          </div>
          <!-- End Table with stripped rows -->
        </div>
      </div>
    </div>


<div class="modal fade" id="adddecaissement" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="card">
            <div class="modal-header">
                <div class="modal-title">
                    <h5> Décaissement</h5>

                </div>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('caisse.decaissement.store')}}">
                @csrf
                <div>
                    @foreach ($errors->all() as $message)
                        <span class="">{{$message}}</span>
                    @endforeach
                </div>
                <div class="col-md-12">
                    <label for="employe_id"  class="form-label">Nom du demandeur</label>
                    <select class="form-select" id="employe_id" name="employe_id[]" multiple="multiple" tabindex="1" required>
                        @foreach ($employers as $employer)
                        <option  value="{{$employer->id}}" >{{$employer->nom." ".$employer->prenom}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                  <label for="code" class="form-label">Code</label>
                  <input type="number" id="code" name="code" class="form-control" placeholder="code" required>
                    {{-- <select class="form-select" id="code" name="code" id="code">
                        <option value="" disabled>----Choisir le code----</option>
                        <option value="001"> 001</option>
                        <option value="002">002</option>
                        <option value="003">003</option>
                        <option value="004">004</option>
                    </select> --}}
                </div>
                <div class="col-md-12">
                  <label for="somme" class="form-label">Montant</label>
                  <input type="number" id="somme" name="somme" class="form-control" placeholder="Montant" required>

                </div>
                {{-- <div class="col-md-12">
                  <label for="autorise_par"  class="form-label">Autorisé par</label>
                  <input type="text" id="autorise_par" name="autorise_par" class="form-control"  required>
                </div> --}}
                <div class="col-md-12" >

                    <label class="form-label" for="">Motif(s)</label>
                    <div class="form-control p-3"  style="overflow: auto; height:130px">
                        <input type="radio" name="motif" class="form-check-input " id="Prospection" value="prospection">
                        <label for="Prospection" class="form-label">Prospection</label><br>
                        <input type="radio" name="motif" class="form-check-input" value="survey" id="survey">
                        <label for="survey" class="form-label">Survey</label><br>
                        <input type="radio" name="motif" class="form-check-input" value="intervention" id="intervention">
                        <label for="intervention" class="form-label">Intervention</label><br>
                        <input type="radio" name="motif" class="form-check-input" value="procedure administrative" id="administrative">
                        <label for="administrative" class="form-label">Procedure administrative</label><br>
                        <input type="radio" name="motif" class="form-check-input" value="livraison sur vente" id="livraison">
                        <label for="livraison" class="form-label">Livraison sur vente</label><br>
                        <input type="radio" name="motif" class="form-check-input" value="carburant" id="carburant">
                        <label for="carburant" class="form-label">Carburant</label><br>
                        <input type="radio" name="motif" class="form-check-input" value="communication" id="communication">
                        <label for="communication" class="form-label">Communication</label><br>
                        <input type="radio" name="motif" class="form-check-input" value="autre" id="autres">
                        <label for="autres" class="form-label">autre</label>
                    </div>

                </div>
                <div class="col-md-12">
                  <label for="description" class="form-label">Décrire en quelques ligne le motif</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="height: 200px" required></textarea>
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

{{-- <script>

    var separator = " ";
    $('#somme').on('keyup', function (e){
        var v = $(this).val().replace(/\s/g, '').replace(',', '.');
        e.key!=','&&e.key!='.' ? !isNaN(parseFloat(v)) ? $(this).val(parseFloat(v).toLocaleString("fr-FR")): null : null;
    })

</script> --}}
@endif
@endsection
