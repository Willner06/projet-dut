@extends('layouts.appMarchandise')
@section('content')
    <section>
       <div class="row">
        <div class="pagetitle">
            <div class="">
                <h1>Entrées</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>

            <div class="card float-end m-3">
                <div class=" p-2">
                    <div class=" col-sm-6">
                        <a class="badge text-bg-success btn" type="button" data-bs-toggle="modal" data-bs-target="#addEntre"> Entrée <i class="bi bi-plus-lg"></i></a>
                    </div>
                </div>
            </div>
        </div><!-- End Page Title -->


        <div class="row">
            <div class="table-responsive">
                <div class="col-lg-12">

                    <div class="card">
                      <div class="card-body">


                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                          <div class="tab-pane fade show active table-responsive" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                            <table class="datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Date</th>
                                        <th>Reference</th>
                                        <th>Fournisseur</th>
                                        <th>Désignation</th>
                                        <th>Catégorie</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantité</th>
                                        {{-- <th>Valeur du stock</th> --}}
                                        <th>Motif</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($entres as $entre)
                                        <tr class="text-center">
                                            <td>{{Carbon\Carbon::parse($entre->date_sortie)->format('d-M-Y')}}</td>
                                            <td>{{$entre->marchandise->reference}}</td>
                                            <td>{{$entre->fournisseur}}</td>
                                            <td>{{$entre->marchandise->designation}}</td>
                                            <td>{{$entre->marchandise->categorie->libelle}}</td>
                                            <td>{{$entre->marchandise->prix_unitaire}} Fcfa</td>
                                            <td>{{$entre->quantite}}</td>
                                            {{-- <td>{{$entre->marchandise->prix_unitaire * $entre->quantite}} Fcfa</td> --}}
                                            <td>{{$entre->motif}}</td>
                                            <td>
                                                {{-- <a href="#" class=" text-bg-warning badge btn" data-bs-toggle="modal" data-bs-target="#updateEntre-{{$entre->id}}">Modifier</a> --}}
                                                <form class="d-inline" action="{{route('marcahndise.entre.delete',$entre->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="text-bg-danger badge" onclick="confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</button>
                                                </form>
                                                {{-- <a href="{{route('marcahndise.entre.delete',$entre->id)}}" class="card-link text-bg-danger badge" onclick="confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</a> --}}
                                            </td>
                                        </tr>




      {{-- ipdate entre modal --}}


      <div class="modal fade" id="updateEntre-{{$entre->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate method="post" action="{{route('marchandise.entree.update', $entre->id)}}">
                    @csrf
                    @method('put')
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
                          @foreach ($marchandises as $marchandise)
                          <option selected value="{{$marchandise->id}}">{{$marchandise->designation}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                      <label for="fournisseur" class="form-label">Fournisseur</label>
                      <input type="text" class="form-control" id="fournisseur" name="fournisseur" required>
                    </div>
                    <div class="col-md-6">
                      <label for="quantite" class="form-label">Quantité</label>
                      <input type="number" class="form-control" id="quantite" name="quantite" required>
                    </div>
                    <div class="col-md-6">
                        <label for="date_achat" class="form-label">date d'achat</label>
                        <input type="date" class="form-control" id="date_achat" name="date_achat" required>
                    </div>
                    <div class="col-md-12">
                        <label for="motif" class="form-label">Motif</label>
                        <textarea name="motif" id="motif" cols="30" rows="10" class="form-control" placeholder="Motif de l'encaissement" style="height: 200px"></textarea>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-success float-end" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>



                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reference</th>
                                        <th>Fournisseur</th>
                                        <th>Désignation</th>
                                        <th>Catégorie</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantité</th>
                                        {{-- <th>Valeur du stock</th> --}}
                                        <th>Motif</th>
                                    </tr>
                                </tfoot>
                            </table>
                          </div>

                        </div><!-- End Default Tabs -->

                      </div>
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
                <form class="row g-3 needs-validation" novalidate method="post" action="{{route('marchandise.entree.store')}}">
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
                          @foreach ($marchandises as $marchandise)
                          <option selected value="{{$marchandise->id}}">{{$marchandise->designation}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                      <label for="fournisseur" class="form-label">Fournisseur</label>
                      <input type="text" class="form-control" id="fournisseur" name="fournisseur" required>
                    </div>
                    <div class="col-md-6">
                      <label for="quantite" class="form-label">Quantité</label>
                      <input type="number" class="form-control" id="quantite" name="quantite" min="1" required>
                    </div>
                    <div class="col-md-6">
                        <label for="date_achat" class="form-label">date d'achat</label>
                        <input type="date" class="form-control" id="date_achat" name="date_achat" required>
                    </div>
                    <div class="col-md-12">
                        <label for="motif" class="form-label">Motif</label>
                        <textarea name="motif" id="motif" cols="30" rows="10" class="form-control" placeholder="Motif de l'encaissement" style="height: 200px"></textarea>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-success float-end" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>






@endsection
