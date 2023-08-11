@extends('layouts.appMarchandise')
@section('content')
    <section>
       <div class="row">
        <div class="pagetitle">
            <div class="">
                <h1>{{ucfirst($marchandise->designation)}}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>

            <div class="card float-end col-sm-3 me-5">
                <div class="row p-1">
                    <div class=" col-sm-6">
                        <a class="badge text-bg-warning w-100" type="button" data-bs-toggle="modal" data-bs-target="#addSortie-{{$marchandise->id}}"> Sortie <i class="bi bi-plus-lg"></i></a>
                    </div>
                    <div class=" col-sm-6">
                        <a class="badge text-bg-success w-100" type="button" data-bs-toggle="modal" data-bs-target="#addEntre-{{$marchandise->id}}"> Entrée <i class="bi bi-plus-lg"></i></a>
                    </div>
                </div>
            </div>

            {{-- <a class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> Ajouter <i class="bi bi-plus-lg"></i></a>
            <a class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> Ajouter <i class="bi bi-plus-lg"></i></a> --}}
        </div><!-- End Page Title -->


        <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex">
                                <p class="float-end fs-5">Entrées</p>
                                <img class="ms-3" src="{{asset('icons/ready-stock.png')}}" alt="">
                              </h5>
                          <h6 class="card-subtitle mb-2 text-muted"></h6>
                          {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}

                          <div class="card-text row text-center">
                            <div class="col-sm-12">
                                <p> Total entrées</p>
                                <span class="fs-4">{{$marchandise->stock->entre ?? ''}}</span>
                            </div>
                          </div>
                          <div class="float-end">

                          </div>
                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>

                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex">
                                <p class="float-end fs-4">Sorties</p>
                                <img class="ms-3" src="{{asset('icons/ready-stock.png')}}" alt="">
                              </h5>
                          <h6 class="card-subtitle mb-2 text-muted"></h6>
                          {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                          <div class="card-text row text-center">
                            <div class="col-sm-12">
                                <p> Total sorties</p>
                                <span class="fs-4">{{$marchandise->stock->sorti ?? ''}}</span>
                            </div>
                          </div>
                          <div class="float-end">

                          </div>
                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title d-flex">
                            <p class="float-end fs-4">Stock</p>
                            <img class="ms-3" src="{{asset('icons/ready-stock.png')}}" alt="">
                          </h5>
                          <h6 class="card-subtitle mb-2 text-muted"></h6>
                          {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}


                          <div class="card-text row text-center">
                            <div class="col-sm-4">
                                <p>Stock théorique</p>
                                <span class="fs-4">{{optional($marchandise->stock)->entre - optional($marchandise->stock)->sorti }}</span>
                            </div>
                            <div class="col-sm-4">
                                <p>Stock réel</p>
                                <span class="fs-4">{{$marchandise->stock->stock ?? ''}}</span>
                            </div>
                            <div class="col-sm-4">
                                <p> Valeur du stock réajusté</p>
                                <span class="fs-4">{{optional($marchandise->stock)->stock  * $marchandise->prix_unitaire.' '.$monaie}} </span>
                            </div>
                          </div>
                          <div class="float-end">

                          </div>
                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>
            <div class="table-responsive">
                <div class="col-lg-12">

                    <div class="card">
                      <div class="card-body">

                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="myTabjustified" role="tablist">
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Entrées</button>
                          </li>
                          <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">Sorties</button>
                          </li>
                        </ul>
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
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($marchandise->entres as $entre)
                                        <tr class="text-center">
                                            <td>{{$entre->date_achat->format('d-m-Y')}}</td>
                                            <td>{{$entre->marchandise->reference}}</td>
                                            <td>{{$entre->fournisseur}}</td>
                                            <td>{{$entre->marchandise->designation}}</td>
                                            <td>{{$entre->marchandise->categorie->libelle}}</td>
                                            <td>{{$entre->marchandise->prix_unitaire}} Fcfa</td>
                                            <td>{{$entre->quantite}}</td>
                                            {{-- <td>{{$entre->marchandise->prix_unitaire * $entre->quantite}} Fcfa</td> --}}
                                            <td>{{$entre->motif}}</td>
                                        </tr>
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
                          <div class="tab-pane fade table-responsive" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Date de sortie</th>
                                        <th>Reference</th>
                                        <th>Bénéficiaire</th>
                                        <th>Désignation</th>
                                        <th>Catégorie</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantité</th>
                                        {{-- <th>Valeur du stock</th> --}}
                                        <th>Motif</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($marchandise->sorties as $sortie)
                                        <tr class="text-center">
                                            <td>{{$sortie->date_sortie->format('d-m-Y')}}</td>
                                            <td>{{$sortie->marchandise->reference}}</td>
                                            <td>{{$sortie->beneficiaire}}</td>
                                            <td>{{$sortie->marchandise->designation}}</td>
                                            <td>{{$sortie->marchandise->categorie->libelle}}</td>
                                            <td>{{$sortie->marchandise->prix_unitaire}}</td>
                                            <td>{{$sortie->quantite}}</td>
                                            <td></td>
                                            <td>{{$sortie->motif}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Date de sortie</th>
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








    <div class="modal fade" id="addEntre-{{$marchandise->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
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
                          <option selected value="{{$marchandise->id}}">{{$marchandise->designation}}</option>
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
                        <textarea name="motif" id="motif" cols="30" rows="10" class="form-control" placeholder="" style="height: 200px"></textarea>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-success float-end" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade"  id="addSortie-{{$marchandise->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
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
                        <textarea name="motif" id="motif" cols="30" rows="10" class="form-control" placeholder="" style="height: 200px"></textarea>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-warning float-end" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>


@endsection
