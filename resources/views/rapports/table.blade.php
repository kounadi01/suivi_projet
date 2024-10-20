

<table class="display text-sm data-table" id="rapports-table" style="border: 2px solid black;">
    <thead style="font-size: 18px;text-align: center">
        <tr>
            <td style="border: 1px solid black" colspan=2 rowspan=2 style="width: 70%"><strong>Programme budgétaire</strong></td>
            <td colspan=3 style="border: 1px solid black"><strong>Prévisions</strong></td>
            <td colspan=3 style="border: 1px solid black"><strong>Réalisations</strong></td>
        </tr>
        <tr>
            <td style="border: 1px solid black"><strong>H</strong></td>
            <td style="border: 1px solid black"><strong>F</strong></td>
            <td style="border: 1px solid black"><strong>Total</strong></td>
            <td style="border: 1px solid black"><strong>H</strong></td>
            <td style="border: 1px solid black"><strong>F</strong></td>
            <td style="border: 1px solid black"><strong>Total</strong></td>
        </tr>
        <tr style="display: none">
            <td>cellule4</td>
            <td>cellul5</td>
            <td>cellule6</td>
            <td>cellule6</td>
            <td>cellule4</td>
            <td>cellul5</td>
            <td>cellule6</td>
            <td>cellule6</td>
        </tr>
    </thead>
    <tbody >
    @foreach($data as $inc=>$programme)
        <tr style="font-size: 14px">
            <td colspan=8 style="background-color: gainsboro;text-align: center"><strong>{{$programme->titre}}</strong></td>
            {{--<td style="text-align: center"></td>--}}
            {{--<td style="text-align: center"></td>--}}
            {{--<td style="text-align: center"></td>--}}
            {{--<td style="text-align: center"></td>--}}
            {{--<td style="text-align: center"></td>--}}
            {{--<td style="text-align: center"></td>--}}
        </tr>
        @foreach(\App\Models\SousIndicateur::listeIndicateurs($programme->id) as $indicateur)
            <tr style="font-size: 14px">
                <td colspan=2>{{$indicateur->lib_ind }}</td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center;"></td>
            </tr>
            @foreach(\App\Models\SousIndicateur::listeSousIndicateurs($indicateur->id) as $sousIndicateur)
                <tr style="font-size: 14px">
                    <td style=""  colspan=2><li>{{$sousIndicateur->lib_sous_ind }}</li></td>
                    @if($sousIndicateur->agrege == true)
                        <td style="text-align: center">NA</td>
                        <td style="text-align: center">NA</td>
                    @else
                        <td style="text-align: center">{{\App\Models\SousIndicateur::nbrPrevisionH($sousIndicateur->id,date('Y'))}}</td>
                        <td style="text-align: center">{{\App\Models\SousIndicateur::nbrPrevisionF($sousIndicateur->id,date('Y'))}}</td>
                    @endif
                    <td style="text-align: center">{{\App\Models\SousIndicateur::nbrPrevisionTotal($sousIndicateur->id,date('Y'))}}</td>
                    @if($sousIndicateur->agrege == true)
                        <td style="text-align: center">NA</td>
                        <td style="text-align: center">NA</td>
                    @else
                        <td style="text-align: center">{{\App\Models\SousIndicateur::nbrRealisationH($sousIndicateur->id,date('Y'))}}</td>
                        <td style="text-align: center">{{\App\Models\SousIndicateur::nbrPrevisionF($sousIndicateur->id,date('Y'))}}</td>
                    @endif
                    <td style="text-align: center">{{\App\Models\SousIndicateur::nbrRealisationTotal($sousIndicateur->id,date('Y'))}}</td>
                </tr>
            @endforeach
        @endforeach

    @endforeach
    </tbody>
    <tfoot style="font-size: 18px;text-align: center">
    <tr>
        <td style="border: 1px solid black" colspan=2 rowspan=2 style="width: 70%"><strong>Programme budgétaire</strong></td>
        <td style="border: 1px solid black" colspan=3><strong>Prévisions</strong></td>
        <td style="border: 1px solid black" colspan=3><strong>Réalisations</strong></td>
    </tr>
    <tr>
        <td style="border: 1px solid black"><strong>H</strong></td>
        <td style="border: 1px solid black"><strong>F</strong></td>
        <td style="border: 1px solid black"><strong>Total</strong></td>
        <td style="border: 1px solid black"><strong>H</strong></td>
        <td style="border: 1px solid black"><strong>F</strong></td>
        <td style="border: 1px solid black"><strong>Total</strong></td>
    </tr>
    <tr style="display: none">
        <td>cellule4</td>
        <td>cellul5</td>
        <td>cellule6</td>
        <td>cellule6</td>
        <td>cellule4</td>
        <td>cellul5</td>
        <td>cellule6</td>
        <td>cellule6</td>
    </tr>
    </tfoot>
</table>





