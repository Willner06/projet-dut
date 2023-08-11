@extends('layouts.admin')


@section('content')
{{-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div> --}}


<div class="">
    <h1>{{ $role->name }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Rôles</a></li>
            <li class="breadcrumb-item active">{{ $role->name }}</li>
        </ol>
    </nav>
</div>

{{--

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif --}}


<section>
    <div class="mt-5">
        <div class=" card p-5">
            <form action="{{ route('roles.update',  $role->id) }}" method="post">
                @csrf
                @method('put')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong class="form-label">Nom:</strong>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $role->name }}">
                        {{-- {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!} --}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <br>
                    <div class="form-group">
                        <strong>Permissions:</strong>
                        <br/>
                        <div class=" row">
                            @foreach($permissions as $permission)
                           <div class=" col-sm-4">
                                    {{-- {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }} --}}
                                {{-- {{ $value->name }} --}}
                                <div class="d-inline ">
                                    @if ( in_array($permission->id, $rolePermissions) )
                                        <input class="form-check-inline" type="checkbox" id="permission-{{ $permission->id }}" name="permission[]" value="{{ $permission->name }}" checked>
                                        <label class="form-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    @else
                                        <input class="form-check-inline" type="checkbox" name="permission[]" id="permission-{{ $permission->id }}" value="{{ $permission->name }}">
                                        <label class="form-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    @endif
                                </div>
                           </div>
                        <br/>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                    <button type="submit" class="btn btn-warning">Modifier</button>
                </div>
            </div>
            </form>
        </div>

        <div class="card">
            <table class="datatable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Fonction</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($role->users as $user)
                    <tr>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->fonction }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection
