@extends('layouts.appMarchandise')
@section('content')
    <section>
       <div class="row">
        <div class="pagetitle">
            <div class="">
                <h1>Sorties</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>

            <div class=" float-end card m-3">
                <div class=" p-2">
                    <div class=" col-sm-6">
                        <a class="badge text-bg-warning btn" type="button" data-bs-toggle="modal" data-bs-target="#addEntre"> Sortie <i class="bi bi-plus-lg"></i></a>
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
                                        <th>Bénéficiaire</th>
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
                                    @foreach ($sorties as $sortie)
                                        <tr class="text-center">
                                            <td>{{Carbon\Carbon::parse($sortie->date_sortie)->format('d-M-Y')}}</td>
                                            <td>{{$sortie->marchandise->reference}}</td>
                                            <td>{{$sortie->beneficiaire}}</td>
                                            <td>{{$sortie->marchandise->designation}}</td>
                                            <td>{{$sortie->marchandise->categorie->libelle}}</td>
                                            <td>{{$sortie->marchandise->prix_unitaire}} Fcfa</td>
                                            <td>{{$sortie->quantite}}</td>
                                            {{-- <td>{{$sortie->marchandise->prix_unitaire * $sortie->quantite}} Fcfa</td> --}}
                                            <td>{{$sortie->motif}}</td>
                                            <td>
                                                <form class="d-inline" action="{{route('marcahndise.sortie.delete',$sortie->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="text-bg-danger badge" onclick="confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reference</th>
                                        <th>Bénéficiaire</th>
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
                          @foreach ($marchandises as $marchandise)
                          <option selected value="{{$marchandise->id}}">{{$marchandise->designation}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                      <label for="beneficiaire" class="form-label">Bénéficiaire</label>
                      <input type="text" class="form-control" id="beneficiaire" name="beneficiaire" required>
                    </div>
                    <div class="col-md-6">
                      <label for="quantite" class="form-label">Quantité</label>
                      <input type="number" class="form-control" id="quantite" name="quantite" min="1" required>
                    </div>
                    <div class="col-md-6">
                        <label for="date_sortie" class="form-label">Date de sortie</label>
                        <input type="date" class="form-control" id="date_sortie" name="date_sortie" required>
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
