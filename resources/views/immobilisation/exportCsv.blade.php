@php

header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=Materiel_amortissable.xls");
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>

        /* table{
            margin: 15px;
        } */

        table thead tr {
            border: 1px solid black;
            font-size: 25px;
        }
        table tbody tr {
            border: 1px solid black;
        }
        .cout{
            float: right;
        }
        .categorie{
            background-color: rgb(21, 88, 233);
            color: #fff;
            text-align: center;
            font-size: 20px;
        }
        .materiel{
            background-color: rgb(207, 200, 200);
        }
        .tr-cout{
            background-color: #eef3dc
        }
        .cout-total{

        }

        .thead tr{
            background-color:rgb(240, 240, 50);
        }
    </style>
</head>
<body>
    @php
    $credit=0;
    $debit=0;
    $solde=0
@endphp

<div>
    <div class="cout-total">
        @php
        $cout_total=0;
        foreach ($categories as $categorie) {
            $cout=0;
            foreach ($categorie->materiels->where('statut','!=','mise_au_rebut') as $mat) {
                $cout=$cout+$mat->cout_acquisitionTtc;
            }
            $cout_total=$cout_total+$cout;
        }

        $total_mat=0;
            foreach ($categories as $categorie){
                $total_mat=$total_mat+count($categorie->materiels->where('statut','!=','mise_au_rebut'));
            }
        @endphp
        <br>
        <h4>
            <h3>Coût total : {{ number_format($cout_total,0,'.',' ')." ".$monaie }}</h3>
            <h3>Matériel total : {{ number_format($total_mat,0,'.',' ') }}</h3>
        </h4>
    </div>
    <div class="table-responsive card"  style="width: 100%">
        <table class="table datatable datatable-table">
            <thead class="thead">
                <tr>
                    <td>N°</td>
                    <td>Désignation</td>
                    <td>Coût d'acquisition TTC</td>
                    <td>Affectation</td>
                    <td>Etat</td>
                    <td>Date d'acquisition</td>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($categories as $categorie)
                @php
                    $id=1;
                @endphp
                    <tr class="categorie">
                        <td colspan="6">
                           {{ $categorie->libelle}}
                        </td>
                        {{-- <td class="">
                            {{ $categorie->materiels->count()}}
                         </td> --}}

                    </tr>
                    @php
                    $cout=0;
                @endphp
                    @foreach ($categorie->materiels->where('statut','!=','mise_au_rebut') as $materiel)

                    <tr class="materiel">
                        <td>{{ $id++ }}</td>
                        <td>{{ $materiel->designation }}</td>
                        <td>{{ number_format($materiel->cout_acquisitionTtc,0,'.',' ')." ".$monaie}}</td>
                        <td>{{ $materiel->affectation }}</td>
                        <td>{{ $materiel->etat }}</td>
                        <td>{{  Carbon\Carbon::parse($materiel->date_acquisition)->format('d-m-Y') }}</td>
                    </tr>

                    @php

                        // foreach ($categorie->materiels as $mat) {
                            $cout=$cout+$materiel->cout_acquisitionTtc;
                        // }
                        // $cout_total=$cout_total+$cout;
                    @endphp

                    @endforeach
                    <tr class="tr-cout">
                        <td>Coût total {{ $categorie->libelle }}</td>
                        <td colspan="2" ><span class="cout">{{number_format($cout,0,'.',' ')." ".$monaie}}</span></td>
                        {{-- <tr><br></tr> --}}
                    </tr>
                    <tr><td colspan="6"></td></tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>



</body>
</html>

