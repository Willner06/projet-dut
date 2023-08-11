@extends('layouts.appTiers')
@section('content')

<div>
    <div class="pagetitle">
        <div class="">
            <h1>{{$tier->numero}}</h1>
            @can("Faire une opération sur un tiers")
            <div class="card float-end d-inline">
                <button class="badge text-bg-success m-3" type="button" data-bs-toggle="modal" data-bs-target="#debits"> <i class="bi bi-plus-lg"></i> Débit </button>
                <button class="badge text-bg-warning m-3 " type="button" data-bs-toggle="modal" data-bs-target="#credits"> <i class="bi bi-plus-lg"></i> Crédit </button>
                {{-- <a class="badge text-bg-warning m-3" href="{{route('tiers.founisseur.csv', $tier->id)}}">Exporter csv</a> --}}
            </div>
            @endcan
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="{{route('tiers.indexFournisseur')}}">Fournisseurs</a></li>
                    <li class="breadcrumb-item active">{{$tier->nom." ".$tier->prenom}}</li>
                </ol>
            </nav>
        <br><br>
        </div>

    </div><!-- End Page Title -->

    @php
        $credit=0;
        $debit=0;
        $solde=0
    @endphp

    <div class="row">
        <div class="table-responsive card">
            <table class=" datatable datatable-table">
                <thead class="bg-success-subtle">
                    <tr>
                        <th>Pointage</th>
                        <th>Code journal</th>
                        <th>Date</th>
                        <th>N° Piece</th>
                        <th>Libellé écriture</th>
                        <th>Date échéance</th>
                        <th>Débit</th>
                        <th>Crédit</th>
                        <th>Solde</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tier->suivitiers as $suivi)
                    @php
                        $credit=$credit+$suivi->credit;
                        $debit=$debit+$suivi->debit;
                        $solde=$solde+$suivi->debit-$suivi->credit;
                    @endphp
                    <tr>
                        <td>{{$suivi->pointage}}</td>
                        <td>{{$suivi->code_journal}}</td>
                        <td>{{date('d/m/Y', strtotime($suivi->date))}}</td>
                        <td>{{$suivi->numero_piece}}</td>
                        <td>{{$suivi->libelle}}</td>
                        <td>{{date('d/m/Y', strtotime($suivi->date_echeance))}}</td>

            {{--     Attention ici le debit correspond au credit et vise versa --}}


                        @if ($suivi->credit== null)
                            <td></td>
                        @else
                        <td>{{number_format($suivi->credit,0,'.','.').$monaie}}</td>
                        @endif

                        @if ($suivi->debit== null)
                            <td></td>
                        @else
                            <td>{{number_format($suivi->debit,0,'.','.').$monaie}}</td>
                        @endif

                        <td>{{number_format(($solde),0,'.','.').$monaie}}</td>

                        <td>{{$suivi->statut}}</td>
                        <td>
                            @can('Modifier une opération sur un tier')
                                @if ($suivi->debit == null)
                                    <button class="d-inline badge text-bg-warning" type="button" data-bs-toggle="modal" data-bs-target="#debit-{{$suivi->id}}"> Modifier </button>
                                @endif

                                @if ($suivi->credit == null)
                                    <button class="d-inline badge text-bg-warning " type="button" data-bs-toggle="modal" data-bs-target="#credit-{{$suivi->id}}"> Modifier </button>
                                @endif
                            @endcan

                            @can('Supprimer une opération sur un tier')
                                <form class="d-inline" action="{{route('tiers.suivi.delete',$suivi->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-bg-danger badge" onclick="return confirm('Êtes vous sûr de vouloir supprimer?')">Supprimer</button>
                                </form>
                            @endcan


                        </td>
                    </tr>




                    <div class=" modal fade modal-lg" id="debit-{{$suivi->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header bg-success-subtle">
                                <h1 class="modal-title fs-5 " id="exampleModalToggleLabel">{{$suivi->code_journal}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                            <div class=" row modal-body">
                                <form class="g-3 needs-validation" novalidate method="post" action="{{route('tiers.suivi.update', $suivi->id)}}">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <ul>
                                            @foreach ($errors->all() as $message)
                                                <li class="">{{$message}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="numero_piece" class="form-label">Numéro piece</label>
                                        <input type="text" class="form-control" id="numero_piece" name="numero_piece" value="{{$suivi->numero_piece}}" required>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="code_journal" class="form-label">Code journal</label>
                                      <input type="text" class="form-control" id="code_journal" name="code_journal" value="{{$suivi->code_journal}}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="libelle" class="form-label">Libelle écriture</label>
                                        <input type="text" class="form-control" id="libelle" name="libelle" value="{{$suivi->libelle}}" required>
                                      </div>

                                    <div class="col-md-6">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" value="{{$suivi->date}}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="pointage" class="form-label">Pointage</label>
                                        <input type="text" class="form-control" id="pointage" name="pointage" value="{{$suivi->pointage}}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="credit" class="form-label">Somme</label>
                                        <input type="number" class="form-control" id="credit" value="{{$suivi->credit}}" name="credit" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="statut" class="form-label">Statut</label>
                                        <input type="text" class="form-control" id="statut" name="statut" value="{{$suivi->statut}}" >
                                    </div>

                                    <div class="col-12">
                                      <button class="btn btn-success float-end" name="tier_id" value="{{$tier->id}}" type="submit">Valider</button>
                                    </div>
                                  </form>


                            </div>
                          </div>
                        </div>
                      </div>



                    <div class="modal fade modal-lg" id="credit-{{$suivi->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header bg-warning-subtle">
                                <h1 class="modal-title fs-5 " id="exampleModalToggleLabel">{{$suivi->code_journal}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class=" row modal-body">

                                    <form class="row g-3 needs-validation" novalidate action="{{route('tiers.suivi.update',  $suivi->id)}}" method="post">
                                        @method('put')
                                    @csrf
                                    <div>
                                        <ul>
                                            @foreach ($errors->all() as $message)
                                                <li class="">{{$message}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pointage" class="form-label">Pointage</label>
                                        <input type="text" class="form-control" id="pointage" name="pointage" value="{{$suivi->pointage}}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="numero_piece" class="form-label">Numéro piece</label>
                                        <input type="text" class="form-control" id="numero_piece" name="numero_piece" value="{{$suivi->numero_piece}}" required>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="code_journal" class="form-label">Code journal</label>
                                      <input type="text" class="form-control" id="code_journal" name="code_journal" value="{{$suivi->code_journal}}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="libelle" class="form-label">Libelle écriture</label>
                                        <input type="text" class="form-control" id="libelle" name="libelle" value="{{$suivi->libelle}}" required>
                                      </div>


                                    <div class="col-md-6">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                        value="{{$suivi->date}}" required>
                                    </div>


                                    <div class="col-md-6">
                                        <label for="date_echeance" class="form-label">Date écheance</label>
                                        <input type="date" class="form-control" id="date_echeance" name="date_echeance" value="{{$suivi->date_echeance}}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="debit" class="form-label">Coût</label>
                                        <input type="number" min="1" class="form-control" id="debit" name="debit" value="{{$suivi->debit}}" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="statut" class="form-label">Statut</label>
                                        <input type="text" class="form-control" id="statut" name="statut" value="{{$suivi->statut}}" >
                                    </div>

                                    <div>
                                        <button class="btn btn-success float-end" name="tier_id" value="{{$tier->id}}"  type="submit">Valider</button>
                                    </div>
                                    </form>
                            </div>
                          </div>
                        </div>




                    @endforeach

                </tbody>
                <tfoot>

                </tfoot>
            </table>
            <table class="table">

                <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th colspan="5" class="text-end">{{number_format(($credit ),0,'.','.')." ".$monaie}}</th>
                            <th>{{number_format(($debit ),0,'.','.')." ".$monaie}}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th colspan="5" class="text-end">Reste à payer</th>
                            @if ($solde>0)
                                <th class="text-center text-danger bg-danger-subtle">{{number_format(( $credit-$debit)* -1,0,'.','.')." ".$monaie}}</th>
                            @endif
                            @if ($solde==0)
                                <th class="text-center text-success bg-success-subtle">{{number_format(($credit-$debit )* -1,0,'.','.')." ".$monaie}}</th>
                            @endif
                            @if ($solde<0)
                                <th  class="text-center text-warning bg-warning-subtle">{{number_format(($credit-$debit )* -1,0,'.','.')." ".$monaie}}</th>
                            @endif
                            <th></th>
                            <th></th>

                        </tr>

                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th colspan="5" class="text-end">Taux de recouvrement</th>

                            @if ($debit!=0)
                            <th class="text-center bg-primary-subtle">{{number_format((($credit/$debit)*100),2)}}%</th>
                            @endif
                            <th></th>
                            <th></th>
                        </tr>

                </tfoot>
            </table>
        </div>
    </div>


    <div class="modal fade modal-lg" id="debits" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-success-subtle">
                <h1 class="modal-title fs-5 " id="exampleModalToggleLabel">Débit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate method="post" action="{{route('tiers.suivi.store')}}">
                    @csrf
                    <div>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li class="">{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <label for="numero_piece" class="form-label">Numéro piece</label>
                        {{-- <select name="numero_piece" id="numero_piece" required class="form-select">
                            @foreach ($encaissements as $encaissement)
                                <option value="{{$encaissement->id}}">{{$encaissement->num_piece." ".$encaissement->deposant}}</option>
                            @endforeach
                        </select> --}}
                        <input type="text" class="form-control" id="numero_piece" name="numero_piece" required>

                    </div>
                    <div class="col-md-6">
                      <label for="code_journal" class="form-label">Code journal</label>
                      <input type="text" class="form-control" id="code_journal" name="code_journal" required>
                    </div>
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="col-md-12">
                      <label for="libelle" class="form-label">Désignation</label>
                      <input type="text" class="form-control" id="libelle" name="libelle" required>
                    </div>

                    <div class="col-md-6">
                        <label for="pointage" class="form-label">Pointage</label>
                        <input type="text" class="form-control" id="pointage" name="pointage" required>
                    </div>
                    <div class="col-md-6">
                        <label for="credit" class="form-label">Somme</label>
                        <input type="number" class="form-control" id="credit" name="credit" required>
                    </div>
                    <div class="col-md-12">
                        <label for="statut" class="form-label">Statut</label>
                        <input type="text" class="form-control" id="statut" name="statut" required>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-success float-end" name="tier_id" value="{{$tier->id}}" type="submit">Valider</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>



    <div class="modal fade modal-lg" id="credits" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning-subtle">
                <h1 class="modal-title fs-5 " id="exampleModalToggleLabel">Crédit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate method="post" action="{{route('tiers.suivi.store')}}">
                    @csrf
                    <div>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li class="">{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <label for="numero_piece" class="form-label">Numéro piece</label>
                        <input type="text" class="form-control" id="numero_piece" name="numero_piece" required>
                    </div>

                    <div class="col-md-6">
                        <label for="pointage" class="form-label">Pointage</label>
                        <input type="text" class="form-control" id="pointage" name="pointage" required>
                    </div>
                    <div class="col-md-6">
                      <label for="code_journal" class="form-label">Code journal</label>
                      <input type="text" class="form-control" id="code_journal" name="code_journal" required>
                    </div>
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="col-md-6">
                      <label for="libelle" class="form-label">Désignation</label>
                      <input type="text" class="form-control" id="libelle" name="libelle" required>
                    </div>
                    <div class="col-md-6">
                        <label for="date_echeance" class="form-label">Date écheance</label>
                        <input type="date" class="form-control" id="date_echeance" name="date_echeance" required>
                    </div>
                    <div class="col-md-6">
                        <label for="debit" class="form-label">Coût</label>
                        <input type="number" min="1" class="form-control" id="debit" name="debit" required>
                    </div>

                    <div class="col-md-12">
                        <label for="statut" class="form-label">Statut</label>
                        <input type="text" class="form-control" id="statut" name="statut" required>
                    </div>


                    <div class="col-12">
                      <button class="btn btn-success float-end" name="tier_id" value="{{$tier->id}}" type="submit">Valider</button>
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

@if(Session::has('success'))

<script>
    toastr.error("{!! Session::get('success') !!}");
</script>

@endif

@endsection
