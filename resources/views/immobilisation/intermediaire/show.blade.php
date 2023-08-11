@extends('layouts.appImmo')
@section('content')
    <section>
       <div class="row">
        <div class="pagetitle">
            <div class="">
                <h1>{{ucfirst($intermediaire->designation)}}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{route('materiel.intermediaire.index')}}">Matériels non amortissables </a></li>
                        <li class="breadcrumb-item active">{{ucfirst($intermediaire->designation)}}</li>
                    </ol>
                </nav>
            </div>

            <div class="card float-end me-5">
                <div class="row p-1">
                    {{-- <div class=" col-sm-6">
                        <a class="badge text-bg-warning w-100" type="button" data-bs-toggle="modal" data-bs-target="#addSortie-{{$intermediaire->id}}"> Sortie <i class="bi bi-plus-lg"></i></a>
                    </div> --}}
                    <div class="">
                        <a class="badge text-bg-success w-100" type="button" data-bs-toggle="modal" data-bs-target="#addEntre">  <i class="bi bi-plus-lg"> Ajouter</i></a>
                    </div>
                </div>
            </div>
        </div><!-- End Page Title -->


        <div class="row">

            <div class="table-responsive">
                <div class="col-lg-12">

                    <div class="card">
                      <div class="card-body bg-body-secondary">

                        <!-- Default Tabs -->
                        {{-- <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="myTabjustified" role="tablist">
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Entrées</button>
                          </li>
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">Sorties</button>
                          </li>
                        </ul> --}}
                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                          <div class="tab-pane fade show active table-responsive" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                            <table class="datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Date d'achat</th>
                                        {{-- <th>Désignation</th> --}}
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th>Coût total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($intermediaire->entres as $entre)
                                        <tr class="">
                                            <td> {{ Carbon\Carbon::parse($entre->date_achat)->format('d-m-Y') }}</td>
                                            {{-- <td>{{$entre->designation}}</td> --}}
                                            <td>{{$entre->quantite}}</td>
                                            <td>{{number_format($entre->cout_achat ,0,'.',' ').$monaie}}</td>
                                            <td>{{number_format($entre->quantite * $entre->cout_achat ,0,'.',' ').$monaie}}</td>
                                            <td class="d-inline">
                                                <div class="d-inline">
                                                    <a class="badge text-bg-warning " type="button" data-bs-toggle="modal" data-bs-target="#updateEntre-{{$entre->id}}"> Modifier</i></a>

                                                <form class="d-inline" action="{{route('materiel.entre.delete',$entre->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="card-link text-bg-danger badge" onclick=" return confirm('Êtes vous sûr de vouloir supprimer?')">supprimer </button>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="updateEntre-{{$entre->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                <div class="modal-body">
                                                    <form class="row g-3" method="post" action="{{route('materiel.entre.update', $entre->id)}}">
                                                        @method('put')
                                                        @csrf
                                                        <div>
                                                            <ul>
                                                                @foreach ($errors->all() as $message)
                                                                    <li class="">{{$message}}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        {{-- <div class="col-md-12">
                                                            <label for="designation" class="form-label">Désignation</label>
                                                            <input type="text" class="form-control" id="designation" name="designation" required>
                                                        </div> --}}
                                                        <div class="col-md-12">
                                                          <label for="quantite" class="form-label">Quantité</label>
                                                          <input type="number" class="form-control" id="quantite" name="quantite" value="{{$entre->quantite}}" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="cout_achat" class="form-label">Coût d'achat</label>
                                                            <input type="number" class="form-control" id="cout_achat" name="cout_achat" value="{{$entre->cout_achat}}" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="date_achat" class="form-label">Date achat</label>
                                                            <input type="date" class="form-control" id="date_achat" name="date_achat" value="{{$entre->date_achat}}" required>
                                                        </div>


                                                        {{-- <div class="col-md-12">
                                                            <label for="localisation" class="form-label">Prix unitaire</label>
                                                            <input type="text" class="form-control" id="localisation" name="localisation" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="localisation" class="form-label">Prix unitaire</label>
                                                            <input type="text" class="form-control" id="localisation" name="localisation" required>
                                                        </div> --}}
                                                        <div class="col-12">
                                                          <button name="materiel_id" value="{{$intermediaire->id}}" class="btn btn-success float-end" type="submit">Valider</button>
                                                        </div>
                                                      </form>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    @endforeach
                                </tbody>


                            </table>
                          </div>

                  </div>

            </div>
        </div>
       </div>
    </section>








    <div class="modal fade" id="addEntre" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
                <form class="row g-3" method="post" action="{{route('materiel.entre.store')}}">
                    @csrf
                    <div>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li class="">{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- <div class="col-md-12">
                        <label for="designation" class="form-label">Désignation</label>
                        <input type="text" class="form-control" id="designation" name="designation" required>
                    </div> --}}
                    <div class="col-md-12">
                      <label for="quantite" class="form-label">Quantité</label>
                      <input type="number" class="form-control" id="quantite" name="quantite" required>
                    </div>
                    <div class="col-md-12">
                        <label for="cout_achat" class="form-label">Coût d'achat</label>
                        <input type="number" class="form-control" id="cout_achat" name="cout_achat" required>
                    </div>
                    <div class="col-md-12">
                        <label for="date_achat" class="form-label">Date achat</label>
                        <input type="date" class="form-control" id="date_achat" name="date_achat" required>
                    </div>


                    {{-- <div class="col-md-12">
                        <label for="localisation" class="form-label">Prix unitaire</label>
                        <input type="text" class="form-control" id="localisation" name="localisation" required>
                    </div>
                    <div class="col-md-12">
                        <label for="localisation" class="form-label">Prix unitaire</label>
                        <input type="text" class="form-control" id="localisation" name="localisation" required>
                    </div> --}}
                    <div class="col-12">
                      <button name="materiel_id" value="{{$intermediaire->id}}" class="btn btn-success float-end" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>


      {{-- <div class="modal fade"  id="addSortie-{{$marchandise->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" >
          <div class="modal-content">
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate method="post" action="{{route('marchandise.sortie.store')}}">
                    @csrf

                    <div>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li class="">{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <label for="marchandise_id" class="form-label">Produit</label>
                        <select class="form-select" id="marchandise_id" name="marchandise_id" required>
                          <option selected value="{{$marchandise->id}}">{{$marchandise->designation}}</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                      <label for="beneficiaire" class="form-label">Bénéficiaure</label>
                      <input type="text" class="form-control" id="beneficiaire" name="beneficiaire" required>
                    </div>
                    <div class="col-md-6">
                      <label for="quantite" class="form-label">Quantité</label>
                      <input type="number" class="form-control" id="quantite" name="quantite" min="1" max="{{optional($marchandise->stock)->stock  * 1}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="date_sortie" class="form-label">date de Sortie</label>
                        <input type="date" class="form-control" id="date_sortie" name="date_sortie" required>
                    </div>
                    <div class="col-md-12">
                        <label for="motif" class="form-label">Motif</label>
                        <textarea name="motif" id="motif" cols="30" rows="10" class="form-control" placeholder="Motif de l'encaissement" style="height: 200px"></textarea>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-warning float-end" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div> --}}


@endsection
