@extends('layouts.appMarchandise')
@section('content')

    <section>
        <div class="pagetitle">
            <h1>Inventaire</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item active">Inventaire</li>
              </ol>
            </nav>
          </div><!-- End Page Title -->

        <div class="row">
            <div class="card">
                @can('Faire l\'inventaire des marchandises')
                <div class="">
                    <button class="badge text-bg-success float-end m-3" type="button" data-bs-toggle="modal" data-bs-target="#addmarchandise"> Inventaire <i class="bi bi-plus-lg"></i></button>
                </div>
                @endcan
                <div class="table-responsive ">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Reference</th>
                                <th>Date d'inventaire</th>
                                <th>Désignation</th>
                                <th>Catégorie</th>
                                <th>Prix unitaire</th>
                                <th>Quantité entrée</th>
                                <th>Qantité sortie</th>
                                <th>Stock théorique</th>
                                <th>Stock réel</th>
                                <th>Ecart de quantité</th>
                                <th>Valeur du stock réel</th>
                                <th>Agent superviseur</th>
                                <th>Agent 2</th>
                                <th>lieu de l'inventaire</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($inventaires as $inventaire)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$inventaire->reference}}</td>
                                <td>{{$inventaire->created_at->format("d-m-Y")}}</td>
                                <td>{{$inventaire->designation}}</td>
                                <td>{{$inventaire->categorie}}</td>
                                <td>{{$inventaire->prix_unitaire}}</td>
                                <td>{{$inventaire->quantite_entre}}</td>
                                <td>{{$inventaire->quantite_sorti}}</td>
                                <td>{{$inventaire->quantite_entre - $inventaire->quantite_sorti}}</td>
                                <td>{{$inventaire->quantite_stock}}</td>
                                <td>{{($inventaire->quantite_entre - $inventaire->quantite_sorti)-$inventaire->quantite_stock}}</td>
                                <td>{{$inventaire->prix_unitaire*$inventaire->quantite_stock}}</td>
                                <td class="">{{$inventaire->agent_superviseur}}</td>
                                <td>{{$inventaire->agent_2}}</td>
                                <td>{{$inventaire->lieu}}</td>
                                <td class="row">
                                    <button data-bs-toggle="modal" data-bs-target="#commantaireInventaire-{{$inventaire->id}}"  class=" text-bg-success badge d-inline mb-3">Voir commentaire</button>
                                    @can('Faire l\'inventaire des marchandises')
                                    <button data-bs-toggle="modal" data-bs-target="#updateInventaire-{{$inventaire->id}}"  class=" text-bg-warning badge">Modifier</button>
                                    @endcan
                                </td>
                            </tr>

                            {{-- update inventaire --}}

                            <div class="modal fade" id="updateInventaire-{{$inventaire->id}}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="card">
                                        <div class="modal-header" style="background-color: #fff3cd">
                                            <div class="modal-title">
                                                <h5> Inventaire</h5>

                                            </div>
                                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <div class="modal-body">
                                        <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('marchandise.inventaire.update', $inventaire->id)}}">
                                            @method('put')
                                            @csrf
                                            <div>
                                                <ul>
                                                    @foreach ($errors->all() as $message)
                                                        <li class="">{{$message}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="categorie" class="form-label">Produit</label>
                                                <select class="form-select" id="categorie" name="marchandise_id" required>
                                                    {{-- <option value="{{$inventaire->designation }}">{{$inventaire->designation}}</option> --}}
                                                  @foreach ($marchandises as $marchandise)
                                                  <option value="{{$marchandise->id}}">{{$marchandise->designation}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="lieu" class="form-label">Lieu d'inventaire</label>
                                                <select class="form-select" id="lieu" name="lieu" required>
                                                    <option selected value="{{$inventaire->lieu}}" >{{$inventaire->lieu}}</option>
                                                    <option value="JOBS Libreville">JOBS Libreville</option>
                                                    <option value="JOBS Moanda">JOBS Moanda</option>
                                                  </select>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="quantite_stock" class="form-label">Qauntite en stock</label>
                                                <input type="number" name="quantite_stock" class="form-control" placeholder="Quantite en stock" min="0" value="{{$inventaire->quantite_stock}}" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="agent_superviseur" class="form-label">Agent superviseur</label>
                                                <input type="text" name="agent_superviseur" class="form-control"  value="{{$inventaire->agent_superviseur}}" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="agent_2" class="form-label">Agent 2</label>
                                                <input type="text" name="agent_2" class="form-control" value="{{$inventaire->agent_2}}" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="motif" class="form-label">Commentaire</label>
                                                <textarea name="commentaire" id="commentaire" cols="30" rows="5" class="form-control" placeholder="Commentaire..." style="height: ">{{$inventaire->commentaire  }}</textarea>
                                            </div>

                                            <div class="m-2">
                                                <button type="submit" class="btn btn-warning float-end">Modifier</button>
                                              </div>
                                          </form><!-- End No Labels Form -->
                                    </div>

                                  </div>
                                </div>
                              </div><!-- End Vertically centered Modal-->

                            </div>



                            <div class="modal fade" id="commantaireInventaire-{{$inventaire->id}}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="card">
                                        <div class="modal-header">
                                            <div class="modal-title">
                                                <h5> {{$inventaire->designation}}</h5>
                                                <h5> {{$inventaire->created_at->format("d-m-Y")}}</h5>
                                            </div>
                                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea class="form-control" disabled  name="" id="" cols="30" rows="10" value="">{{$inventaire->commentaire}}</textarea>

                                        </div>
                                    </div>

                                  </div>
                                </div>
                              </div><!-- End Vertically centered Modal-->

                            </div>



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



        <div class="modal fade" id="addmarchandise" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="card">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5> Inventaire</h5>

                        </div>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('marchandise.inventaire.store')}}">
                        @csrf
                        <div>
                            @foreach ($errors->all() as $message)
                                <span class="">{{$message}}</span>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <label for="categorie" class="form-label">Produit</label>
                            <select class="form-select" id="categorie" name="marchandise_id" required>
                                <option selected disabled enable>---choisir le produit---</option>
                              @foreach ($marchandises as $marchandise)
                              <option value="{{$marchandise->id}}">{{$marchandise->designation}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="lieu" class="form-label">Lieu d'inventaire</label>
                            <select class="form-select" id="lieu" name="lieu" required>
                                <option selected disabled>---choisir le lieu---</option>
                                <option value="JOBS Libreville">JOBS Libreville</option>
                                <option value="JOBS Moanda">JOBS Moanda</option>
                              </select>
                        </div>
                        <div class="col-md-12">
                            <label for="quantite_stock" class="form-label">Qauntite en stock</label>
                            <input type="number" name="quantite_stock" class="form-control" placeholder="Quantite en stock" min="0" required>
                        </div>
                        <div class="col-md-12">
                            <label for="agent_superviseur" class="form-label">Agent superviseur</label>
                            <input type="text" name="agent_superviseur" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="agent_2" class="form-label">Agent 2</label>
                            <input type="text" name="agent_2" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="motif" class="form-label">Commentaire</label>
                            <textarea name="commentaire" id="commentaire" cols="30" rows="5" class="form-control" placeholder="Commentaire..." style="height: " required></textarea>
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

@endsection
