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
            <h1>Inventaire de caisse</h1>
            <nav>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
                    <li class="breadcrumb-item active">Iventaire de caisse</li>
                </ol>
            </nav>
        </div>

        </div><!-- End Page Title -->
        <div class="mt-5">
            <div class="card table-responsive ">
                {{-- <div class="text-end p-4">
                    <a href="" class="badge text-bg-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter</a>
                </div> --}}
                <table class="table text-center datatable">
                    <thead class="text-white " style="background-color: #254b7d" >
                        <tr >
                            <th class="text-center">Date</th>
                            <th class="text-center">Heure</th>
                            <th class="text-center">Somme inventaire</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($inventaires as $inventaire)
                        <tr class="text-center">
                            <td>{{$inventaire->created_at->format("d-m-Y")}}</td>
                            <td>{{$inventaire->created_at->format("H:i")}}</td>
                            <td>{{$inventaire->soldeInventaire." ".$monaie}}</td>
                        </tr>
                        {{-- <form action="{{route('caisse.suivi.store')}}" method="post">
                            @csrf
                            <tr>
                                <td><input name="date" class="form-control form_input" type="text" value="{{$decaissement->created_at->format("d-m-Y")}}" readonly></td>
                                <td><input name="num_piece" class="form-control form_input" type="text" value="{{$decaissement->num_piece}}" readonly></td>
                                <td><input name="code" class="form-control form_input" type="text" value="{{$decaissement->code}}" readonly></td>
                                <td>
                                    <textarea class="form-control form_input" name="libelle" id="" cols="30" rows="1" value="{{$decaissement->motif->libelle}}" readonly>{{$decaissement->motif->libelle}}</textarea>
                                </td>
                                <td><input name="montant" class="form-control form_input" type="text" value="{{$decaissement->somme}}" readonly></td>

                                <td>
                                    <button type="submit" class="badge text-bg-warning" onclick="confirm('êtes-vous sûr?')">Valider</button>
                                </td>

                            </tr>
                        </form> --}}
                        @endforeach


                </table>


            </div>
            @can("Faire l'inventaire de la caisse")

            <div class="card mt-2 w-50 ">
                <table class="m-1 table " >
                    <thead>
                        <tr class="bg-danger text-white">
                            <th>BILLET/PIECE</th>
                            <th>NOMBRE</th>
                            <th>TOTAL</th>
                        </tr>

                    </thead>
                    <form action="{{route('caisse.billet.store')}}" method="post">
                        @csrf
                        <tbody>
                            <tr>
                                <th colspan="3" class="bg-secondary text-white">BILLETS</th>
                            </tr>
                            <tr>
                                <td>10 000</td>
                                <td><input id="b_10000" name="b_10000" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cb_10000" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>5 000</td>
                                <td><input id="b_5000" name="b_5000" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cb_5000" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>2 000</td>
                                <td><input id="b_2000" name="b_2000" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cb_2000" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>1 000</td>
                                <td><input id="b_1000" name="b_1000" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cb_1000" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>500</td>
                                <td><input id="b_500" name="b_500" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cb_500" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>


                            <tr>
                                <th colspan="3" class="bg-secondary text-white">PIECES</th>
                            </tr>


                            <tr>
                                <td>500</td>
                                <td><input id="p_500" name="p_500" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cp_500" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>100</td>
                                <td><input id="p_100" name="p_100" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cp_100" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>50</td>
                                <td><input id="p_50" name="p_50" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cp_50" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>25</td>
                                <td><input id="p_25" name="p_25" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cp_25" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td><input id="p_10" name="p_10" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cp_10" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><input id="p_5" name="p_5" class="w-100 form-control" type="number" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cp_5" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><input id="p_1" name="p_1" class="w-100 form-control" type="number" min="0" style="border:" oninput="calculer()"></td>
                                <td class="text-end d-flex">
                                    <input id="cp_1" class="form-control form_input" type="text" value="" readonly> {{$monaie}}
                                </td>
                            </tr>
                            <tr>
                                {{-- <td colspan="3">
                                    <button type="button" class="badge text-bg-secondary" onclick="calculer()">Calculer</button>
                                </td> --}}

                            </tr>
                        </tbody>

                    {{-- <tfoot> --}}
                        <tr class="bg-danger text-white ">
                            <th colspan="2">SOLDE INVENTAIRE</th>
                            <th class="text-end d-flex">
                                <input id="soldeinventaire"  name="soldeInventaire" class="bg-danger text-white form-control form_input" type="text" value="" readonly> {{$monaie}}
                            </th>
                        </tr>
                    {{-- </tfoot> --}}
                    <div  class="float-end">
                        <td colspan="3">
                            <button type="submit" class="badge text-bg-warning">Valider</button>
                        </td>
                    </div>
                </form>
                </table>
            </div>

            @endcan
        </div>



        <!-- Modal -->
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
