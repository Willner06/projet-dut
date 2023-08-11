@extends('layouts.appMarchandise')
@section('content')

    <section>
        <div class="pagetitle">
            <div class="">
                <h1>Catégories</h1>
                <div class="card float-end">
                    <button class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#addmarchandise"><i class="bi bi-plus-lg"> Catégorie </i></button>
                </div>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Catégories</li>
                    </ol>
                </nav>
            <br><br>
            </div>

        </div><!-- End Page Title -->

        <div class="card">
            <div class="row">
                {{-- @foreach ($categories as $categorie)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <img class="float-end m-3" src="{{asset('icons/package.png')}}" alt="">
                          <h4 class=" fs-3 card-title">{{$categorie->libelle}}</h4>
                          <h6 class="card-subtitle mb-2 text-muted"></h6>
                          <h3 class="text-center">

                            {{$categorie->marchandises->count()}} <br> type de produit
                          </h3>

                          <div class="float-end">
                            <a href="#" class="card-link text-bg-danger badge">Supprimer</a>
                            <a href="{{route('marchandise.categorie.show', $categorie->id)}}" class=" text-bg-warning badge">Voir</a>
                          </div>
                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>
                @endforeach --}}
                @php
                    $id=1;
                @endphp
                <div class="table-responsive ">
                    <table class="table datatable text-center">
                        <thead class="text-center">
                            <tr >
                                <th class="text-center">#</th>
                                <th class="text-center">Libelle</th>
                                <th class="text-center">Action</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @foreach ($categories as $categorie)
                            <tr>
                                <td>{{$id++}}</td>
                                <td>{{$categorie->libelle}}</td>
                                <td>
                                    <a href="{{route('marchandise.categorie.show', $categorie->id)}}" class=" text-bg-warning badge">Afficher</a>
                                    <form class="d-inline" action="{{route('marchandise.categorie.delete',$categorie->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class=" text-bg-danger badge" onclick=" return confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
{{--
                        <tfoot>
                            <tr>

                            </tr>
                        </tfoot> --}}
                    </table>

                </div>
            </div>
        </div>



        <div class="modal fade" id="addmarchandise" tabindex="-1">
            <div class="modal-dialog modal-dialog">
              <div class="modal-content">
                <div class="card">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5> Catégorie</h5>

                        </div>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('marchandise.categorie.store')}}">
                        @csrf
                        <div>
                            @foreach ($errors->all() as $message)
                                <span class="">{{$message}}</span>
                            @endforeach
                        </div>
                        <div class="col-md-12 form-floating">
                          <input type="text" class="form-control" name="libelle" required>
                          <label for="libelle"  class="form-label">Libelle</label>
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
    @if(Session::has('message'))

    <script>
        toastr.success("{!! Session::get('message') !!}");
    </script>

    @endif

    @if($errors->all())

    <script>
        toastr.error("Une erreur c'est produite");

        $(window).on('load', function() {
            $('#addmarchandise').modal('show');
        });
    </script>

    @endif

@endsection
