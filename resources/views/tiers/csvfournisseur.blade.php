@php

header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=$tier->nom  .xls");
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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


                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>



</body>
</html>

