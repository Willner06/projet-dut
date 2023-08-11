@extends('layouts.app')
@section('content')
<style>
    .form_input{
        border: none;
        text-align: center;
    }
</style>
    <section>
        <div class="">
            <h1>Suivi de caisse</h1>
            <nav>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
                    <li class="breadcrumb-item active">Suivi de caisse journalier</li>
                </ol>
            </nav>
        </div>

        </div><!-- End Page Title -->
        <div class="mt-5">
            <div class="card table-responsive p-3">
                {{-- <div class="text-end p-4">
                    <a href="" class="badge text-bg-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter</a>
                </div> --}}
                <table class="table text-center">
                    <thead class="text-white" style="background-color: #254b7d">
                        <tr>
                            <th>DATE</th>
                            <th>N° PIECE</th>
                            <th>CODE</th>
                            <th>LIBELLE</th>
                            <th>MONTANT</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalDecaissement=0;
                            $totalEncaissement=0
                        @endphp
                        @foreach ($decaissements as $decaissement)
                        @php
                            $totalDecaissement=$totalDecaissement+$decaissement->somme
                        @endphp

                        <tr>
                            <td>{{$decaissement->created_at->format("d-m-Y")}}</td>
                            <td>{{$decaissement->num_piece}}</td>
                            <td>{{$decaissement->code}}</td>
                            <td>{{$decaissement->motif->libelle}}</td>
                            <td>{{$decaissement->somme.$monaie}}</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @endforeach

                        @foreach ($encaissements as $encaissement)

                        <tr>
                            <td>{{$encaissement->created_at->format("d-m-Y")}}</td>
                            <td>{{$encaissement->num_piece}}</td>
                            <td>{{$encaissement->code}}</td>
                            <td>{{$encaissement->motif}}</td>
                            <td>{{$encaissement->somme.$monaie}}</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @endforeach
                        <tr>
                            <th colspan="4" class="text-danger ps-5">SOLDE THEORIQUE</th>
                            <th class="text-canter text-danger">{{$soldeTehorique." ".$monaie}}</th>
                        </tr>
                        <tr class="bg-danger">

                        </tr>
                        <tr>
                            <th colspan="4" class="text-center ">SOLDE REEL</th>
                            <th class="text-end">{{$solde_reel.$monaie}}</th>
                        </tr>

                        <tr>
                            <td colspan="4" class="text-center ">ECART CAISSE THEORIQUE ET COMPTAGE</td>
                            <th class="text-end">{{$solde_reel - $soldeTehorique." ".$monaie}}</th>
                        </tr>
                    </tbody>
                    <tfoot>

                    </tfoot>

                </table>


            </div>

        </div>



        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Suivi du jour</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="{{route('caisse.suivi.store')}}" method="post">
            <div class="modal-body row g-3">

                    @csrf
                    <div>
                        @foreach ($errors->all() as $message)
                            <span class="">{{$message}}</span>
                        @endforeach
                    </div>
                    <div class="col-md-12 form-floating">
                      <input type="text" name="num_piece" class="form-control" placeholder="N° Piece">
                      <label for="num_piece"  class="form-label">N° Piece</label>
                    </div>
                    <div class="col-md-12 form-floating">
                      <input type="text" name="code" class="form-control" placeholder="Code">
                      <label for="code" class="form-label">Code</label>
                    </div>
                    <div class="col-md-12 form-floating">
                        <input type="text" name="libelle" class="form-control" placeholder="libelle">
                        <label for="libelle" class="form-label">Libelle</label>
                    </div>
                    <div class="col-md-12 form-floating">
                        <input type="number" name="montant" class="form-control" placeholder="Montant">
                        <label for="montant" class="form-label">Montant</label>
                      </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success float-end">Valider</button>
            </div>
        </form><!-- End No Labels Form -->
            </div>
        </div>
        </div>
    </section>


<script>

    function calculer(){
        b_10000= $('#b_10000').val()*10000;
        b_5000= $('#b_5000').val()*5000;
        b_2000= $('#b_2000').val()*2000;
        b_1000= $('#b_1000').val()*1000;
        b_500= $('#b_500').val()*500;

        $('#cb_10000').val(b_10000);
        $('#cb_5000').val(b_5000);
        $('#cb_2000').val(b_2000);
        $('#cb_1000').val(b_1000);
        $('#cb_500').val(b_500);


        p_500= $('#p_500').val()*500;
        p_100= $('#p_100').val()*100;
        p_50= $('#p_50').val()*50;
        p_25= $('#p_25').val()*25;
        p_10= $('#p_10').val()*10;
        p_5= $('#p_5').val()*5;
        p_1= $('#p_1').val()*1;

        $('#cp_500').val(p_500);
        $('#cp_100').val(p_100);
        $('#cp_50').val(p_50);
        $('#cp_25').val(p_25);
        $('#cp_10').val(p_10);
        $('#cp_5').val(p_5);
        $('#cp_1').val(p_1);

        soldeInvebtaire=b_10000+b_5000+b_2000+b_1000+b_500+p_500+p_100+p_50+p_25+p_10+p_5+p_1;

        $('#soldeinventaire').val(soldeInvebtaire)

        console.log(b10000);
    }


</script>

</div>
@endsection
