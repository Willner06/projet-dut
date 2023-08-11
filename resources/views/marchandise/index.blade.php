@extends('layouts.appMarchandise')
@section('content')
    <div>
        <div class="pagetitle">
            <div class="">
                <h1>Marchandises</h1>
                <div class="card float-end">
                    <button class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> <i class="bi bi-plus-lg"></i> Produit </button>
                </div>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Produits</li>
                    </ol>
                </nav>
            <br><br>
            </div>

        </div><!-- End Page Title -->

        <div class="row">
            {{-- @foreach ($marchandises as $marchandise)
                <div class="col-sm-3">
                    <div class="card rounded-4">
                        <div class="card-body">
                          <h5 class="card-title">{{$marchandise->designation}}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">{{$marchandise->entres->count()}}</h6>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                          <div class="float-end">
                            <a href="#" class="card-link text-bg-danger badge">Supprimer</a>
                            <a href="{{route('marchandise.show', $marchandise->id)}}" class=" text-bg-warning badge">Voir</a>
                          </div>
                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>
                @endforeach --}}
            <div class="table-responsive card">
                <table class="datatable">
                    <thead>
                        <tr class="text-center">
                            <th>Reference</th>
                            <th>Désignation</th>
                            <th>Catégorie</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Lieu</th>
                            <th>Valeur du stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($marchandises as $marchandise)
                            <tr class="text-center">
                                <td>{{$marchandise->reference}}</td>
                                <td>{{$marchandise->designation}}</td>
                                <td>{{$marchandise->categorie->libelle}}</td>
                                <td>{{$marchandise->prix_unitaire}} Fcfa</td>
                                <td>{{optional($marchandise->stock)->stock*1}}</td>
                                <td>{{$marchandise->lieu}}</td>
                                <td>{{$marchandise->prix_unitaire * optional($marchandise->stock)->stock}} Fcfa</td>
                                <td>
                                    <a href="{{route('marchandise.show', $marchandise->id)}}" class=" text-bg-warning badge">Voir</a>
                                    {{-- <a href="{{route('marchandise.delete',$marchandise->id)}}" class="card-link text-bg-danger badge" onclick="confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</a> --}}

                                    <form class="d-inline" action="{{route('marchandise.delete',$marchandise->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-bg-danger badge" onclick=" return confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</button>
                                    </form>
                                </td>
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
                            <th>Valeur du stock</th>
                            <th>Motif</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



    <div class="modal fade " id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate method="post" action="{{route('marchandise.store')}}">
                    @csrf
                    <div>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li class="text-danger" class="">{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <label for="categorie" class="form-label">Catégorie</label>
                        <select class="form-select" id="categorie" name="categorie_id" required>
                          @foreach ($categories as $categorie)
                          <option selected value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="lieu" class="form-label">Lieu</label>
                        <select class="form-select" id="lieu" name="lieu" required>
                            <option selected disabled>---choisir le lieu---</option>
                            <option value="JOBS Libreville">JOBS Libreville</option>
                            <option value="JOBS Moanda">JOBS Moanda</option>
                          </select>
                    </div>
                    <div class="col-md-12">
                      <label for="reference" class="form-label">Reference</label>
                      <input type="text" class="form-control" id="reference" name="reference" required>
                    </div>

                    <div class="col-md-12">
                      <label for="designation" class="form-label">Désignation</label>
                      <input type="text" class="form-control" id="designation" name="designation" required>
                    </div>
                    <div class="col-md-12">
                        <label for="prix_unitaire" class="form-label">Prix unitaire</label>
                        <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" required>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-success float-end" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">






        @if(Session::has('message'))

        <script>
            toastr.success("{!! Session::get('message') !!}");
        </script>

        @endif

        @if($errors->all())

        <script>
            toastr.error("Une erreur c'est produite");

            $(window).on('load', function() {
                $('#exampleModalToggle').modal('show');
            });
        </script>

        @endif

@endsection
