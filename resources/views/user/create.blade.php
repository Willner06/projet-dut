@extends('layouts.admin')
@section('content')

<div>
    <div class="pagetitle">
        <div class="">
            <h1>Liste des utilisateurs</h1>
            <div class="card float-end">
                <button class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> <i class="bi bi-plus-lg"></i> Utilisateur </button>
            </div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Utilisateurs</li>
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
                        <th>Email</th>
                        <th>Fonction</th>
                        <th>Action</th>
                        {{-- <th>Mail</th>
                        <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$id++}}</td>
                        <td>{{$user->nom}}</td>
                        <td>{{$user->prenom}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->fonction}}</td>
                        <td>
                            <a href="{{route('user.show', $user->id)}}" class=" text-bg-warning badge">Voir</a>
                            @if ($user->email != Auth::user()->email)
                            <form class="d-inline" action="{{route('user.destroy',$user->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-bg-danger badge" onclick="return confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</button>
                            </form>
                            @endif
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
                <form class="row g-3 needs-validation" novalidate action="{{route('user.store')}}" method="POST">
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                        {{-- <div class="invalid-feedback">Please enter a valid Email adddress!</div> --}}
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        {{-- <div class="invalid-feedback">Please enter your password!</div> --}}
                      </div>

                      <div class="col-12">
                        <label for="yourPassword_confirm" class="form-label">Confirmation mot de passe</label>
                        <input type="password" name="password_confirm" class="form-control" id="yourPassword_confirm" required>
                        {{-- <div class="invalid-feedback">Please enter your password!</div> --}}
                      </div>

                      <div class="col-12">
                        <label for="categorie" class="form-label">Role</label>
                        <select class="form-select" id="categorie" name="roles[]" multiple required>
                            @foreach ($roles as $role)
                            <option  value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Ajouter un utilisateur</button>
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
