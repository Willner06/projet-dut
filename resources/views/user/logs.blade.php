@extends('layouts.admin')
@section('content')

<div>
    <div class="pagetitle">
        <div class="">
            <h1>Histotique des Connexions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                    <li class="breadcrumb-item active">Historique des Connections</li>
                </ol>
            </nav>
        <br><br>
        </div>

    </div><!-- End Page Title -->



    <div class="card">
        <div class="card-body">
          {{-- <h5 class="card-title">Bordered Tabs Justified</h5> --}}

          <!-- Bordered Tabs Justified -->
          <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Tout</button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Connections</button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Déconnection</button>
            </li>
          </ul>
          <div class="tab-content pt-2" id="borderedTabJustifiedContent">
            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive card">
                    <table class="datatable">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Utilisateur</th>
                                <th>Connection/Déconnection</th>
                                {{-- <th>Action</th> --}}
                                {{-- <th>Mail</th>
                                <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                            <tr>
                                <td>{{$id++}}</td>
                                <td>{{$log->date->format('d-m-Y')}}</td>
                                <td>{{$log->heure->format('H:i:s')}}</td>
                                <td>{{$log->user->nom." ".$log->user->prenom }}</td>
                                @if ($log->login == true)
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
            </div>
            <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive card">
                    <table class="datatable">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Utilisateur</th>
                                <th>Connection/Déconnection</th>
                                {{-- <th>Action</th> --}}
                                {{-- <th>Mail</th>
                                <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logins as $login)
                            <tr>
                                <td>{{$id++}}</td>
                                <td>{{$login->date->format('d-m-Y')}}</td>
                                <td>{{$login->heure->format('H:i:s')}}</td>
                                <td>{{$login->user->nom." ".$login->user->prenom }}</td>
                                @if ($login->login == true)
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
            </div>
            <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="table-responsive card">
                    <table class="datatable">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Utilisateur</th>
                                <th>Connection/Déconnection</th>
                                {{-- <th>Action</th> --}}
                                {{-- <th>Mail</th>
                                <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logouts as $logout)
                            <tr>
                                <td>{{$id++}}</td>
                                <td>{{$logout->date->format('d-m-Y')}}</td>
                                <td>{{$logout->heure->format('H:i:s')}}</td>
                                <td>{{$logout->user->nom." ".$logout->user->prenom }}</td>
                                @if ($logout->login == true)
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
            </div>
          </div><!-- End Bordered Tabs Justified -->

        </div>
      </div>




    <div class="row">

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
