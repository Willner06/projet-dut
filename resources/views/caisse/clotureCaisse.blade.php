@extends('layouts.app')
@section('content')
<div class="">
    <h1>Clôture de caisse</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Clôture de caisse</li>
        </ol>
    </nav>
</div>

</div><!-- End Page Title -->
    <section>
        <div class="float-end  w-25">
            <div class="search-bar header">
                <form class="search-form d-flex align-items-center" method="POST" action="{{route('cloture.search')}}">
                    @csrf
                  <input type="month" name="query" placeholder="Search" title="Entrez le mois recherché" required>
                  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End Search Bar -->

            </div><br>
        <div class="card mt-5">
            <div>
                {{-- <h5 class="float-end m-3">
                    <div class="search-bar header">
                        <form class="search-form d-flex align-items-center" method="POST" action="{{route('cloture.search')}}">
                            @csrf
                          <input type="month" name="query" placeholder="Search" title="Entrez le mois recherché" required>
                          <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                      </div><!-- End Search Bar -->
                </h5> --}}
              <h5 class="card-title m-2">Fiche de clôture de caisse</h5>
            </div>
            <div class="table-responsive m-3">
                <table class="table  text-center datatable">
                    <thead>
                        <tr class="text-center text-white" style="background-color: #254b7d">
                            {{-- <th>Date</th> --}}
                            <th>Agent caisse</th>
                            <th>Contrôleur</th>
                            <th>Date de contrôle</th>
                            <th>Solde théorique</th>
                            <th>Solde réel</th>
                            <th>Ecart</th>
                            <th>Commentaire</th>
                            @can('Contrôler la cloture de la caisse')
                                <th>Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clotures as $cloture)
                            <tr class="text-center">
                            {{-- <td>{{$cloture->created_at->format("d-m-Y H:i")}}</td> --}}
                            <td>{{$cloture->agent_caisse}}</td>
                            <td>{{$cloture->controlleur}}</td>
                            <td>{{$cloture->updated_at->format("d-m-Y H:i")}}</td>

                            @php
                                if ($cloture->solde_theorique == null) {
                                    $soldeTheorique=$cloture->compte->solde ?? '';
                                }else {
                                    $soldeTheorique=$cloture->solde_theorique ?? '';
                                }
                            @endphp

                                <td>{{ number_format($soldeTheorique,0,'.',' ').$monaie}}</td>


                            <td>{{number_format($cloture->solde_reel,0,'.',' ').$monaie}}</td>

                            @if (($cloture->solde_reel-$soldeTheorique)>0)
                                <td class="text-warning bg-success-subtle">{{ number_format($cloture->solde_reel-$soldeTheorique,0,'.',' ').$monaie }}</td>
                            @endif
                            @if (($cloture->solde_reel-$soldeTheorique)==0)
                                <td class="text-success bg-success-subtle">{{ number_format($cloture->solde_reel-$soldeTheorique,0,'.',' ').$monaie }}</td>
                            @endif
                            @if (($cloture->solde_reel-$soldeTheorique)<0)
                                <td class="text-danger bg-success-subtle">{{ number_format($cloture->solde_reel-$soldeTheorique,0,'.',' ').$monaie }}</td>
                            @endif
                            <td>{{$cloture->commentaire}}</td>
                            <td>
                                @can('Contrôler la cloture de la caisse')
                                    @if ($cloture->status==false)

                                        {{-- @if ($cloture->agent_caisse != (Auth::user()->nom)) --}}
                                            <a href="#" class="badge bg-success" data-bs-toggle="modal" data-bs-target="#control-{{$cloture->id}}">Contrôller</a>
                                        {{-- @endif --}}

                                        {{-- @else
                                        <a href="#" class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#control-{{$cloture->id}}">Modifier</a> --}}
                                    @endif
                                @endcan
                            </td>
                        </tr>




                    <div class="modal fade" id="control-{{$cloture->id}}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="card">
                                <div class="modal-header">
                                    <div class="modal-title">
                                        <h5>Contrôle</h5>
                                    </div>
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <div class="modal-body">
                                <form class="row g-3 p-" method="POST" action="{{route('cloture.controle',$cloture->id)}}">
                                    @method('PUT')
                                    @csrf
                                    <div>
                                        @foreach ($errors->all() as $message)
                                            <span class="">{{$message}}</span>
                                        @endforeach
                                    </div>
                                    <div class="col-md-12 mt-4 mb-4">
                                        <label for="solde_reel" class="form-label">Solde Réel</label>
                                        <input type="number" name="solde_reel" class="form-control" value="{{$cloture->solde_reel}}">
                                    </div>

                                    <div class="col-md-12 mb-4">

                                        <label for="commetaire" class="form-label">Commentaire</label>
                                        <textarea name="commentaire" id="commetaire" cols="30" rows="10" class="form-control" value="{{$cloture->commentaire}}" style="height: 200px">{{$cloture->commentaire}}</textarea>
                                    </div>

                                    <div class="col-md-12 mt-4 mb-4 d-none">
                                        <input type="number" name="solde_theorique" class="form-control" value="{{ $cloture->compte->solde }}">
                                    </div>


                                    <div class="">
                                        <button type="submit" class="btn btn-success float-end">Valider</button>
                                    </div>
                                </form><!-- End No Labels Form -->
                            </div>

                        </div>
                        </div>
                    </div><!-- End Vertically centered Modal-->

                        @endforeach

                    </tbody>
                    <tr class="text-center ">
                        <td class="bg-primary text-white" colspan="3">
                            ARRETE DE LA CAISSE AU {{date("t-m-Y", strtotime(date("d-M-Y")))}}
                        </td>
                            <td class="bg-primary text-white">{{number_format(intval($soldeTheorique ?? ''),0,'.',' ') .$monaie }}</td>
                            <td class="bg-primary text-white">{{ number_format(intval($cloture->solde_reel ?? ''),0,'.',' ').$monaie ?? ''}}</td>
                            <td class="bg-success-subtle">{{number_format((intval($cloture->solde_reel ?? '')-intval($soldeTheorique ?? '')),0,'.',' ').$monaie ?? ''}}</td>

                    </tr>

                    <tfoot>

                    </tfoot>
                {{-- </table>
                <table class="table">
                    <th>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </th>
                    <tbody>
                        <tr class="text-center ">
                            <td class="bg-primary text-white" colspan="4">
                                ARRETER DE LA CAISSE AU {{date("t-m-Y", strtotime(date("d-M-Y")))}}
                            </td>
                            <td class="bg-primary text-white">{{$cloture->compte->solde}}</td>
                            <td class="bg-primary text-white">{{$monaie}}</td>
                            <td class="bg-success-subtle">{{$monaie}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table> --}}
            </div>
        </div>
    </section>




</div>
@endsection
