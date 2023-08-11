@extends('layouts.admin')
@section('content')

<div>
    <div class="pagetitle">
        <div class="">
            <h1>Liste des rôles</h1>
            <div class="card float-end">
                <button class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"> <i class="bi bi-plus-lg"></i> Rôles </button>
            </div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Rôles</li>
                </ol>
            </nav>
        <br><br>
        </div>

    </div><!-- End Page Title -->

    <div class="row">
        <div class="table-responsive card">
            <table class="datatable text-center ">
                <thead>
                    <tr>
                        <th class="text-center">N°</th>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Action</th>
                        {{-- <th>Mail</th>
                        <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$id++}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            {{-- <a href="{{route('roles.show', $role->id)}}" class=" text-bg-success badge">Voir</a> --}}
                            <a href="{{route('roles.edit', $role->id)}}"class="text-bg-success badge">Afficher</a>
                            {{-- @if ($role->email != Auth::role()->email) --}}
                            <form class="d-inline" action="{{route('roles.destroy',$role->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-bg-danger badge" onclick="return confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</button>
                            </form>
                            {{-- @endif --}}
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

    <div class="modal modal-lg fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate action="{{route('roles.store')}}" method="POST">
                    @csrf
                    <div>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li class="text-danger" class="">{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                      <div class="col-12">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                        {{-- <div class="invalid-feedback">Please, enter your name!</div> --}}
                      </div>
                      <div class="col-12">
                        <label for="categorie" class="form-label">Permissions:</label><br>
                        {{-- <select class="form-select" id="categorie" name="permission_id" required> --}}
                            <div class="row">

                                    @foreach ($permissions as $permission)
                                    <div class="col-sm-6">
                                        <div class="d-inline">
                                            <input class="form-checkbox-inline" name="permission_id[]" id="permission_id-{{ $permission->id }}" type="checkbox" value="{{$permission->id}} "{{$permission->name}} > <label for="permission_id-{{ $permission->id }}">{{$permission->name}}</label>
                                        </div>
                                    </div>
                                    @endforeach
                            </div>
                        {{-- </select> --}}
                        </div>



                      <div class="col-sm-12 text-center">
                        <button class="btn btn-success col-3 mt-3" type="submit">Enregistrer</button>
                      </div>
                    </form>
            </div>
          </div>
        </div>
      </div>

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
