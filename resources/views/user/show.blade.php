@extends('layouts.admin')
@section('content')

<section class="section profile">
    <div class="row">

        <div class="pagetitle">
            <div class="">
                <h1>{{ $user->nom." ".$user->prenom }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Utilisateurs</a></li>
                        <li class="breadcrumb-item active">{{ $user->nom." ".$user->prenom }}</li>
                    </ol>
                </nav>
            </div>

        </div><!-- End Page Title -->

      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ asset('img-jb-gestion/profile-picture.svg') }}" alt="Profile" class="rounded-circle">
            <h2 class="text-center">{{ $user->nom." ".$user->prenom }}</h2>
            <h3>{{ $user->getRoleNames()->first(); }}</h3>
            {{-- <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div> --}}
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Aperçu</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editer le Profil</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Historique de connexion</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Modifier le mot de passe</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">


                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Nom(s):</div>
                  <div class="col-lg-9 col-md-8">{{ $user->nom }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Prénom(s):</div>
                  <div class="col-lg-9 col-md-8">{{ $user->prenom }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Fonction:</div>
                  <div class="col-lg-9 col-md-8">{{ $user->fonction }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Role:</div>
                  <div class="col-lg-9 col-md-8">{{ $user->getRoleNames()->first() }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">E-mail</div>
                  <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Permission</div>
                    <div class="col-lg-9 col-md-8">
                        @foreach ($user->getPermissionsViaRoles() as $permission)
                            <p class="d-inline" style="color: #2c384e">{{ $permission->name.',' }}</p>
                        @endforeach
                    </div>
                  </div>

                {{-- <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                </div> --}}

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{ route('user.update', $user->id) }}" method="post">
                    @csrf
                    @method('put')
                  <div class="row mb-3">
                    <label for="nom" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="nom" type="text" class="form-control" id="nom" value="{{ $user->nom }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="prenom" class="col-md-4 col-lg-3 col-form-label">Prénom</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="prenom" type="text" class="form-control" id="prenom" value="{{ $user->prenom }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fonction" class="col-md-4 col-lg-3 col-form-label">Fonction</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fonction" type="text" class="form-control" id="fonction" value="{{ $user->fonction }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">E-mail</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="email" value="{{ $user->email }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="categorie" class="col-md-4 col-lg-3 col-form-label">Role</label>
                    <div class="col-md-8 col-lg-9">
                        <select class="form-control" id="categorie" name="roles[]" required>
                            @foreach ($roles as $role)
                                @if ($role->name == ($user->roles->first()->name ?? ''))
                                    <option value="{{$role->name}}" selected >{{$role->name}}</option>
                                @else
                                    <option value="{{$role->name}}" >{{$role->name}}</option>
                                @endif
                            @endforeach


                            {{-- @foreach ($user->roles as $role)
                            <option  value="{{$role->name}}" selected>{{$role->name}}</option>
                            @endforeach

                            @foreach ($roles as $role)
                            <option  value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                  </div>



                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">

                <!-- Settings Form -->
                <table class="datatable">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Connection/Déconnection</th>
                            {{-- <th>Action</th> --}}
                            {{-- <th>Mail</th>
                            <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id=1;
                        @endphp
                        @foreach ($logs as $login)
                        <tr>
                            <td>{{$id++}}</td>
                            <td>{{$login->date->format('d-m-Y')}}</td>
                            <td>{{$login->heure->format('H:i:s')}}</td>
                            @if ($login->login == 1)
                            <td class=" text-success">Connection</td>
                            @else
                            <td class="text-danger">Déconnection</td>
                            @endif

                            {{-- <td>
                                <a href="{{route('user.show', $user->id)}}" class=" text-bg-warning badge">Voir</a>
                                @if ($user->email != Auth::user()->email)
                                <form class="d-inline" action="{{route('user.destroy',$user->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-bg-danger badge" onclick="return confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</button>
                                </form>
                                @endif
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>

                        </tr>
                    </tfoot>
                </table>

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="{{ route('user.resetPassword',$user->id) }}" method="post">
                    @csrf
                    @method('put')

                  <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password_confirm" class="col-md-4 col-lg-3 col-form-label">Confirmer le mot de passe</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password_confirm" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>


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
