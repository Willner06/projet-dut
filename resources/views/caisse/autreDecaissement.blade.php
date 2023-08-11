@extends('layouts.app')
@section('content')

@if (Route::is('caisse.decaissement.autre'))

<section>
    <div class="pagetitle">
        <div class="">
            <h1>Autre Décaissements</h1>
            <nav>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
                    <li class="breadcrumb-item active">Autres décaissements</li>
                </ol>
            </nav>
        </div>

    </div><!-- End Page Title -->
    <div>
        <h5 class=" float-end " style="width:350px">
            <div class="search-bar header pt-3 pe-2">
                <form class="search-form d-flex align-items-center" method="POST" action="{{route('caisse.decaissement.searchautre')}}">
                    @csrf
                  <input type="month" name="query" placeholder="Search" title="Entrez le mois recherché" required>
                  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End Search Bar -->
        </h5>
      {{-- <h5 class="card-title m-2">Frais de autre</h5> --}}
    </div> <br>
    <br>
    <br>
    <div class=" card ">
        <div class="table-responsive">
            <table class="table datatable">
                <thead >
                    <tr class=" bg-success-subtle text-center m-3" >
                        <th colspan="4" class="text-center">Frais autre décaissement <span class="text-primary text-danger">{{date("M Y")}}</span></th>
                    </tr>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>N° Pièce</th>
                        <th>Motif</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($autres as $autre)
                    <tr class="text-">
                        <td>{{$autre->created_at->format('d/M/y')}}</td>
                        <td>{{$autre->num_piece}}</td>
                        <td>{{$autre->motif->description}}</td>
                        <td>{{number_format($autre->somme,0,'.',' ').$monaie}}</td>
                    </tr>
                    @endforeach


                </tbody>
                <tfoot>

                </tfoot>
            </table>
            <table class="table w-100">
                <tbody>
                    <tr  class="text-center">
                        <td class=" bg-primary text-white" colspan="3">
                            Total frais de autre mois antérieur {{date("F Y", strtotime('-1 month'))}}
                        </td>
                        <td>
                            {{number_format($totalMoisAnterieur,0,'.',' '.'').$monaie}}
                        </td>
                        <th>
                            Variation
                        </th>
                    </tr>
                    <tr class="bg-primary text-center">
                        <td colspan="3" class=" text-white" >
                            Total frais de autre {{date("M Y")}}
                        </td>
                        <td class=" text-white">
                            {{number_format($totalMoisEnCour,0,'.',' '.'').$monaie}}
                        </td>
                        <td class=" text-white">
                            {{number_format($difference,0,'.',' ').''.$monaie}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@else

<section>
    <div class="pagetitle">
        <div class="">
            <h1>Autres décaissements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Autres décaissements</li>
                </ol>
            </nav>
        </div>

    </div><!-- End Page Title -->

    <div>
        <h5 class=" float-end " style="width:350px">
            <div class="search-bar header pt-3 pe-2">
                <form class="search-form d-flex align-items-center" method="POST" action="{{route('caisse.decaissement.searchautre')}}">
                    @csrf
                  <input type="month" name="query" placeholder="Search" title="Entrez le mois recherché" required>
                  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End Search Bar -->
        </h5>
      {{-- <h5 class="card-title m-2">Frais de autre</h5> --}}
    </div> <br>
    <br>
    <br>

    <div class=" card m-3">


        <div class="table-responsive">
            <table class="table datatable">
                <thead >
                    <tr class=" bg-success-subtle text-center m-3" >
                        <th colspan="4" class="text-center">Frais autre décaissement <span class="text-primary text-danger">{{date("M Y")}}</span></th>
                    </tr>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>N° Pièce</th>
                        <th>Motif</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($autres as $autre)
                    <tr class="text-">
                        <td>{{$autre->created_at->format('d/M/y')}}</td>
                        <td>{{$autre->num_piece}}</td>
                        <td>{{$autre->motif->description}}</td>
                        <td>{{number_format($autre->somme,0,'.',' ').$monaie}}</td>
                    </tr>
                    @endforeach


                </tbody>
                <tfoot>

                </tfoot>
            </table>
            <table class="table w-100">
                <tbody>

                    <tr class="bg-primary text-center">
                        <td colspan="3" class=" text-white" >
                            Total frais de autre {{date("M Y")}}
                        </td>
                        <td class="text- text-white">
                            {{number_format($totalMoisEnCour,0,'.',' '.'').$monaie}}
                        </td>

                    </tr>
            </table>
        </div>
    </div>
</section>

@endif



@endsection
