@extends('layouts.admin')
@section('content')

<div>
    <div class="pagetitle">
        <div class="">
            <h1>Employés</h1>
            <div class="card float-end">
                <button class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> <i class="bi bi-plus-lg"></i> Employés </button>
            </div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Liste des employés</li>
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
                        <th>N°</th>
                        <th>Nom(s)</th>
                        <th>Prénom(s)</th>
                        <th>Fonction</th>
                        <th>E-mail</th>
                        <th>Action</th>
                        {{-- <th>Mail</th>
                        <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employes as $employe)
                    <tr>
                        <td>{{$id++}}</td>
                        <td>{{$employe->nom}}</td>
                        <td>{{$employe->prenom}}</td>
                        <td>{{$employe->fonction}}</td>
                        <td>{{$employe->email}}</td>
                        <td>
                            {{-- <a href="{{route('employes.show', $employe->id)}}" class=" text-bg-warning badge">Voir</a> --}}

                            <form class="d-inline" action="{{route('employes.destroy',$employe->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-bg-danger badge" onclick="return confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</button>
                            </form>

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
                <form class="row g-3 needs-validation" novalidate action="{{route('employes.store')}}" method="POST">
                    @csrf
                    <div>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li class="text-danger" class="">{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                      <div class="col-12">
                        <label for="nom" class="form-label">Nom(s)</label>
                        <input type="text" name="nom" class="form-control" id="nom" required>
                        {{-- <div class="invalid-feedback">Please, enter your name!</div> --}}
                      </div>

                      <div class="col-12">
                        <label for="prenom" class="form-label">Prénom(s)</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" required>
                        {{-- <div class="invalid-feedback">Please, enter your name!</div> --}}
                      </div>

                      <div class="col-12">
                        <label for="fonction" class="form-label">Fonction</label>
                        <input type="text" name="fonction" class="form-control" id="fonction" required>
                        {{-- <div class="invalid-feedback">Please, enter your name!</div> --}}
                      </div>

                      <div class="col-12">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" name="email" class="form-control" id="email" required>
                        {{-- <div class="invalid-feedback">Please, enter your name!</div> --}}
                      </div>

                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Ajouter un employé</button>
                      </div>
                    </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">

</div>



@if(Session::has('message'))

<script>
    toastr.success("{!! Session::get('message') !!}");
</script>

@endif


@if($errors->all())

<script>
    toastr.error("Une erreur c'est produite");
</script>

@endif
@endsection
