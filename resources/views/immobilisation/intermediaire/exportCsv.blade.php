@php

header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=Materiel_non_amortissable.xls");
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
        // $cout_total=0;
        // foreach ($categories as $categorie) {
        //     $cout=0;
        //     foreach ($categorie->materiels as $mat) {
        //         $cout=$cout+$mat->cout_acquisitionTtc;
        //     }
        //     $cout_total=$cout_total+$cout;
        // }

    $nombres=0;
     foreach ($intermediaires as $intermediaire){
        foreach ($intermediaire->entres as $entre) {
            $nombres=$nombres+$entre->quantite;
        }
     }
        @endphp
        <br>
        <h4>
            <h3>Coût total : {{ number_format($cout_total,0,'.',' ')." ".$monaie }}</h3>
            <h3>Matériel total : {{ number_format($nombres,0,'.',' ') }}</h3>
        </h4>
    </div>
    <div class="table-responsive bg-body-secondary">
        <table class="table datatable">
            <thead class="thead">
                <tr>
                    <th>Type de matériel</th>
                    <th class="text-center">Quantité</th></th>
                    <th>Coût total</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $nombre=0;
                @endphp
                @foreach ($intermediaires as $intermediaire)

                    @php

                    $nombre=0;

                        foreach ($intermediaire->entres as $entre) {
                            $nombre=$nombre+$entre->quantite;
                        }


                        // foreach ($intermediaires as $intermediaire) {
                            $cout_par_entre=0;
                            $cout_par_type=0;
                            foreach ($intermediaire->entres as $entre) {
                                 $cout_par_entre= $entre->cout_achat*$entre->quantite;
                                 $cout_par_type=$cout_par_type + $cout_par_entre;
                        // }
    // echo $cout_par_type=$cout_par_type + $cout_par_entre; echo '</br>';
}
                    @endphp

                <tr>
                    {{-- <td>{{$id++}}</td> --}}
                    <td>{{$intermediaire->designation}}</td>
                    <td class="text-center">{{$nombre}}</td>
                    <td>{{ number_format($cout_par_type ,0,'.',' ').$monaie }}</td>

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



</body>
</html>

