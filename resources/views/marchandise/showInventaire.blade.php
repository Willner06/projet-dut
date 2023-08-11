@extends('layouts.appMarchandise')
@section('content')

    <section>
        <div class="pagetitle">
            <div class="">
                <h1>{{$inventaire->designation}}</h1>
                {{-- <div class="card float-end">
                    <button class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#addmarchandise"><i class="bi bi-plus-lg"> Catégorie </i></button>
                </div> --}}
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Catégories</li>
                    </ol>
                </nav>
            <br>
            </div>

        </div><!-- End Page Title -->
{{-- td>{{$count++}}</td> --}}
                                <td>{{$inventaire->reference}}</td>
                                <td>{{$inventaire->date_entre}}</td>
                                <td>{{$inventaire->designation}}</td>
                                <td>{{$inventaire->categorie}}</td>

                                <td>{{$inventaire->agent_superviseur}}</td>
                                <td>{{$inventaire->agent_2}}</td>
                                <td>{{$inventaire->lieu}}</td>
                                <td>
        <div class="row">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body ">
                            {{-- <img class="float-end m-3" src="{{asset('icons/package.png')}}" alt=""> --}}
                          <h4 class=" fs-3 card-title"></h4>
                          <h6 class="card-subtitle mb-2 text-muted"></h6>

                          <table class="row  border-secondary">
                            <tbody class="fs-5">
                                <tr class=" row">
                                    <th class="col-sm-6">Date inventaire</th>
                                    <td class="  col-sm-6">{{$inventaire->created_at->format("d-M-Y")}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Lieu inentaire</th>
                                    <td class="  col-sm-6">{{$inventaire->lieu}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Réference</th>
                                    <td class="  col-sm-6">{{$inventaire->reference}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Désignation</th>
                                    <td class="  col-sm-6">{{$inventaire->designation}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Catégorie</th>
                                    <td class="  col-sm-6">{{$inventaire->categorie}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Agent superviseur</th>
                                    <td class="  col-sm-6">{{$inventaire->agent_superviseur}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Agent 2</th>
                                    <td class="  col-sm-6">{{$inventaire->agent_2}}</td>
                                </tr>


                            </tbody>
                          </table>

                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            {{-- <img class="float-end m-3" src="{{asset('icons/package.png')}}" alt=""> --}}
                          <h4 class=" fs-3 card-title"></h4>
                          <h6 class="card-subtitle mb-2 text-muted"></h6>
                          <table class="row  border-secondary">
                            <tbody class="fs-5">
                                <td>{{$inventaire->prix_unitaire}}</td>
                                <td>{{$inventaire->quantite_entre}}</td>
                                <td>{{$inventaire->quantite_sorti}}</td>
                                <td>{{$inventaire->quantite_stock}}</td>
                                <td>{{$inventaire->valeur_stock}}</td>
                                <tr class=" row">
                                    <th class="col-sm-6">Prix unitaire</th>
                                    <td class="  col-sm-6">{{$inventaire->prix_unitaire}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Quantité entrée</th>
                                    <td class="  col-sm-6">{{$inventaire->quantite_entre}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Quantiré sortie</th>
                                    <td class="  col-sm-6">{{$inventaire->quantite_sorti}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Stock</th>
                                    <td class="  col-sm-6">{{$inventaire->designation}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Catégorie</th>
                                    <td class="  col-sm-6">{{$inventaire->categorie}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Agent superviseur</th>
                                    <td class="  col-sm-6">{{$inventaire->agent_superviseur}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Agent 2</th>
                                    <td class="  col-sm-6">{{$inventaire->agent_2}}</td>
                                </tr>


                                <tr class=" row">
                                    <th class="col-sm-6">Date intervention</th>
                                    <td class="  col-sm-6">{{$inventaire->created_at->format("d-M-Y")}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Date intervention</th>
                                    <td class="  col-sm-6">{{$inventaire->created_at->format("d-M-Y")}}</td>
                                </tr>
                                <tr class=" row">
                                    <th class="col-sm-6">Date intervention</th>
                                    <td class="  col-sm-6">{{$inventaire->created_at->format("d-M-Y")}}</td>
                                </tr>
                            </tbody>
                          </table>
                        </div>
                    </div><!-- End Card with titles, buttons, and links -->
                </div>
                {{-- @endforeach --}}

            </div>
        </div>




    </section>

@endsection
