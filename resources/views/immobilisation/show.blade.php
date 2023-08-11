@extends('layouts.appImmo')
@section('content')
    <div>
        <div class="pagetitle">
            <div class="">
                <h1>{{$categorie->libelle}}</h1>
                <div class="card float-end">
                    <button class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle-{{$categorie->id}}"> <i class="bi bi-plus-lg"></i> Materiel </button>
                </div>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('materiel.categorie.index')}}">Matériels ammortissables</a></li>
                        <li class="breadcrumb-item active">{{$categorie->libelle}}</li>
                    </ol>
                </nav>
            <br><br>
            </div>

        </div><!-- End Page Title -->

        <div class="row">

                <div class="table-responsive card">
                    <table class="datatable">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center">Code d'inventaire</th>
                                <th class="text-center">Désignation</th>
                                {{-- <th>Type d'immobilisation</th> --}}
                                <th class="text-center">Date d'acquisition</th>
                                <th class="text-center">Coût d'acquisition</th>
                                <th class="text-center">Affectation</th>
                                <th class="text-center">Etat</th>
                                <th class="text-center">Durée d'amortissement <br> (en année)</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categorie->materiels as $materiel)
                            @php
                                $color='';
                            @endphp
                            @if ($materiel->statut == 'mise_au_rebut')
                                @php
                                    $color='bg-danger-subtle'
                                @endphp
                            @endif

                            @if ($materiel->statut == 'cede')
                                @php
                                    $color='bg-success-subtle'
                                @endphp
                            @endif
                                <tr class="text-center {{ $color }}">
                                    <td>{{$materiel->code_inventaire}}</td>
                                    <td>{{$materiel->designation}}</td>
                                    {{-- <td>{{$materiel->categorie->libelle}}</td> --}}
                                    <td>{{ Carbon\Carbon::parse($materiel->date_acquisition)->format('d-m-Y')  }}</td>
                                    <td>{{ number_format($materiel->cout_acquisitionTtc,0,'.',' ').$monaie}}</td>
                                    <td>{{$materiel->affectation}}</td>
                                    <td>{{$materiel->etat}}</td>
                                    <td>{{$materiel->duree_ammortissement}}</td>
                                    <td class="">
                                        <a href="{{route('materiel.show', $materiel->id)}}" class=" text-bg-warning badge">Voir</a>

                                        <form class="d-inline" action="{{route('materiel.delete',$materiel->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            @if ($materiel->statut=='actif')
                                                <button type="submit" class="card-link text-bg-danger badge" onclick=" return confirm('Êtes vous sûr de vouloir supprimer?')">supprimer </button>
                                            @else
                                            @can('supprimer/modifier les immobilisations au rebut')
                                            <button type="submit" class="card-link text-bg-danger badge" onclick=" return confirm('Êtes vous sûr de vouloir supprimer?')">supprimer </button>
                                            @endcan
                                            @endif

                                        </form>

                                        <a href="" class="   text-bg-success badge" data-bs-toggle="modal" data-bs-target="#qrcode-{{$materiel->id}}">Télécharger le qrcode</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="qrcode-{{$materiel->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content text-center">
                                        <div class="modal-title">
                                            <h3 class="m-3">{{$materiel->designation." / ".$materiel->affectation}}</h3>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{asset("$materiel->qr_code")}}" alt="">
                                        </div>
                                        <a class="btn btn-primary" href="{{asset("$materiel->qr_code")}} " download="{{$materiel->designation.'-'.$materiel->affectation}}">Télécharger</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
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



    <div class="modal modal-lg fade" id="exampleModalToggle-{{$categorie->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-title">
                <h3 class="m-3">Ajout d'un matériel</h3>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate method="post" action="{{route('materiel.store')}}">
                    @csrf
                    <div class="col-md-6">
                        <label for="categorie" class="form-label">Catégorie (Type immobilisation)</label>
                        <select class="form-select" id="categorie" name="categorie_id" required>
                          <option selected value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="code_inventaire" class="form-label">Code inventaire</label>
                        <input type="text" class="form-control" id="code_inventaire" name="code_inventaire" required>
                    </div>
                    {{-- <div class="col-md-4">
                        <label for="type_immobilisation" class="form-label">Type immobilisation</label>
                        <input type="text" class="form-control" id="type_immobilisation" name="type_immobilisation" required>
                      </div> --}}
                    <div class="col-md-6">
                      <label for="designation" class="form-label">Désignation</label>
                      <input type="text" class="form-control" id="designation" name="designation" required>
                    </div>

                    <div class="col-md-6">
                        <label for="date_acquisition" class="form-label">Date d'achat ou mise en service</label>
                        <input type="date" class="form-control" id="date_acquisition" name="date_acquisition" required>
                    </div>
                    <div class="col-md-3">
                        <label for="prix_achat" class="form-label">Prix d'achat</label>
                        <input type="number" class="form-control" id="prix_achat" name="prix_achat" oninput="prix_acquisition()" required min="0">
                    </div>
                    <div class="col-md-3">
                        <label for="autres_frais" class="form-label">Autres frais</label>
                        <input type="number" class="form-control" id="autres_frais" name="autres_frais" oninput="prix_acquisition()" required min="0">
                    </div>
                    <div class="col-md-3">
                        <label for="tva" class="form-label">TVA déduite</label>
                        <input type="number" class="form-control" id="tva" oninput="prix_acquisition()" name="tva" required min="0">
                    </div>
                    <div class="col-md-3">
                        <label for="cout_acquisitionTtc" class="form-label">Coût d'acquisition TTC</label>
                        <input type="number" class="form-control" id="cout_acquisitionTtc" name="cout_acquisitionTtc" readonly required min="0">
                    </div>
                    <div class="col-md-4">
                        <label for="affectation" class="form-label">Affectation</label>
                        <input type="text" class="form-control" id="affectation" name="affectation" required>
                    </div>
                    <div class="col-md-4">
                        <label for="etat" class="form-label">Etat</label>
                        <input type="text" class="form-control" id="etat" name="etat" required>
                    </div>
                    <div class="col-md-4">
                        <label for="fournisseur" class="form-label">Fournisseur</label>
                        <input type="text" class="form-control" id="fournisseur" name="fournisseur" required>
                    </div>


                    <div class="col-md-12">
                        <label for="base_ammortisable" class="form-label">Base ammortissable</label>
                        <input type="number" class="form-control" id="base_ammortisable" name="base_ammortisable" readonly required>
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="mode_ammortissement" class="form-label">Mode d'ammortissement</label>
                        <input type="text" class="form-control" id="mode_ammortissement" name="mode_ammortissement" required>
                    </div> --}}
                    <div class="col-md-6">
                        <label for="mode_ammortissement" class="form-label">Mode d'ammortissement</label>
                        <select class="form-select" id="mode_ammortissement" name="mode_ammortissement" required>
                          {{-- @foreach ($categories as $categorie) --}}
                          <option selected value="L">L</option>
                          {{-- @endforeach --}}
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="duree_ammortissement" class="form-label">Durée d'ammortissement</label>
                        <input type="number" class="form-control" id="duree_ammortissement" name="duree_ammortissement" required>
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


        <script>
            function prix_acquisition(){
                prix_achat=$('#prix_achat').val()*1;
                autres_frais=$('#autres_frais').val()*1;
                tva=$('#tva').val()*1;

                cout_acquisition= (prix_achat+autres_frais-tva);
                $('#cout_acquisitionTtc').val(cout_acquisition);
                $('#base_ammortisable').val(cout_acquisition);

            }
        </script>
@endsection
