@extends('layouts.appTiers')
@section('content')

<div>
    <div class="pagetitle">
        <div class="">
            <h1>Clients</h1>
            @can('Créer un tiers')
            <div class="card float-end">
                <button class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> <i class="bi bi-plus-lg"></i> Client </button>
            </div>
            @endcan
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                    <li class="breadcrumb-item active">Clients</li>
                </ol>
            </nav>
        <br><br>
        </div>

    </div><!-- End Page Title -->

    <div class="row">
        <div class="table-responsive card">
            <table class="datatable">
                <thead>
                    <tr>
                        <th>Numéro de compte</th>
                        <th>Nom(s)</th>
                        <th>Prénom(s)</th>
                        <th>Nif</th>
                        <th>Localisation</th>
                        <th>Téléphone</th>
                        <th>Mail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tiers as $tier)
                    <tr>
                        <td>{{$tier->numero}}</td>
                        <td>{{$tier->nom}}</td>
                        <td>{{$tier->prenom}}</td>
                        <td>{{$tier->nif}}</td>
                        <td>{{$tier->localisation}}</td>
                        <td>{{$tier->telephone}}</td>
                        <td>{{$tier->mail}}</td>
                        <td>
                            <a href="{{route('tier.show', $tier->id)}}" class=" text-bg-warning badge">Voir</a>
                            @can('Supprimer un tiers')
                            <form class="d-inline" action="{{route('tier.delete',$tier->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-bg-danger badge" onclick="return confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
                <form class="row g-3" novalidate method="post" action="{{route('tiers.store')}}">
                    @csrf
                    <div>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li class="">{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="col-md-12">
                      <label for="prenom" class="form-label">Prénom</label>
                      <input type="text" class="form-control" id="prenom" name="prenom" >
                    </div>
                    <div class="col-md-6">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone">
                    </div>
                    <div class="col-md-6">
                        <label for="mail" class="form-label">Mail</label>
                        <input type="email" class="form-control" id="mail" name="mail" >
                    </div>
                    <div class="col-md-12">
                      <label for="nif" class="form-label">Nif</label>
                      <input type="text" class="form-control" id="nif" name="nif" >
                    </div>
                    <div class="col-md-12">
                        <label for="localisation" class="form-label">Localisation</label>
                        <input type="text" class="form-control" id="localisation" name="localisation" required>
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
                      <button class="btn btn-success float-end" name="button" value="client" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">

</div>

@endsection
