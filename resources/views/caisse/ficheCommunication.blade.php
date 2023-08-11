@extends('layouts.app')
@section('content')

@if (Route::is('caisse.decaissement.communication'))

<section>
    <div class="pagetitle">
        <div class="">
            <h1>Communication</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Frais de Communication</li>
                </ol>
            </nav>
        </div>

    </div><!-- End Page Title -->
    <div>
        <h5 class=" float-end " style="width:350px">
            <div class="search-bar header pe-2 pt-2">
                <form class="search-form d-flex align-items-center" method="POST" action="{{route('caisse.decaissement.searchCommunication')}}">
                    @csrf
                  <input type="month" name="query" placeholder="Search" title="Entrez le mois recherché" required>
                  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End Search Bar -->
        </h5>
      {{-- <h5 class="card-title m-2">Frais de Communication</h5> --}}
    </div><br>
    <br>
    <br>
    <div class=" card ">

        <div class="table-responsive">
            <table class="table datatable">
                <thead >
                    <tr class="text-center m-3 text-white" style="background-color: #254b7d;">
                        <th colspan="4" class="text-center">Frais de communication <span class="text-primary text-danger">{{date("M Y")}}</span></th>
                    </tr>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>N° Pièce</th>
                        <th>Motif</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($communications as $communication)
                    <tr class="text-">
                        <td>{{$communication->created_at->format('d/M/y')}}</td>
                        <td>{{$communication->num_piece}}</td>
                        <td>{{$communication->motif->description}}</td>
                        <td>{{number_format($communication->somme,0,'.',' ').$monaie}}</td>
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
                            Total frais de communication mois antérieur {{date("F Y", strtotime('-1 month'))}}
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
                            Total frais de communication {{date("M Y")}}
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
            <h1>Communication</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Frais de Communication</li>
                </ol>
            </nav>
        </div>

    </div><!-- End Page Title -->
    <div>
        <h5 class=" float-end " style="width:350px">
            <div class="search-bar header pe-2 pt-2">
                <form class="search-form d-flex align-items-center" method="POST" action="{{route('caisse.decaissement.searchCommunication')}}">
                    @csrf
                  <input type="month" name="query" placeholder="Search" title="Entrez le mois recherché" max="{{date("Y-m")}}" required>
                  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End Search Bar -->
        </h5>
    </div><br>
    <br>
    <br>
    <div class=" card m-3">



        <div class="table-responsive">
            <table class="table datatable">
                <thead >
                    <tr class="text-center m-3 text-white" style="background-color: #254b7d;">
                        <th colspan="4" class="text-center">Frais de communication <span class="text-primary text-danger">{{date("M Y", $date)}}</span></th>
                    </tr>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>N° Pièce</th>
                        <th>Motif</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($communications as $communication)
                    <tr class="text-">
                        <td>{{$communication->created_at->format('d/M/y')}}</td>
                        <td>{{$communication->num_piece}}</td>
                        <td>{{$communication->motif->description}}</td>
                        <td>{{number_format($communication->somme,0,'.',' ').$monaie}}</td>
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
                            Total frais de communication {{date("M Y")}}
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
