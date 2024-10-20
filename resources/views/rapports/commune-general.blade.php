<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        table,td{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

    @foreach($data as $commune)
        <div style="text-align: center;text-decoration: underline">
            <strong>
                Commune de : {{$commune->nom_commune}} en {{$annee}}
            </strong>

        </div>
        <br>
        <table class="" id="rapports-table" style="width: 100%" >
            <thead style="font-size: 18px;text-align: center">
            <tr>
                <td style="width: 70%" colspan=2 rowspan=2 ><strong>Programme budgétaire</strong></td>
                <td colspan=3 ><strong>Prévisions</strong></td>
                <td colspan=3 ><strong>Réalisations</strong></td>
            </tr>
            <tr>
                <td ><strong>H</strong></td>
                <td ><strong>F</strong></td>
                <td ><strong>Total</strong></td>
                <td ><strong>H</strong></td>
                <td ><strong>F</strong></td>
                <td ><strong>Total</strong></td>
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
            @foreach(\App\Models\Programme::programmeAnnee($commune->id) as $inc=>$programme)
                <tr>
                    <td colspan=8 style="background-color: gainsboro;text-align: center"><strong>{{$programme->titre}}</strong></td>

                </tr>

                @foreach(\App\Models\SousIndicateur::listeCommuneIndicateur($programme->id,$commune->id,$annee) as $indicateur)
                    <tr style="font-size: 14px">
                        <td colspan=2>{{$indicateur->lib_ind }}</td>
                        <td style="text-align: center"></td>
                        <td style="text-align: center"></td>
                        <td style="text-align: center;"></td>
                        <td style="text-align: center"></td>
                        <td style="text-align: center"></td>
                        <td style="text-align: center;"></td>
                    </tr>

                    @foreach(\App\Models\SousIndicateur::listeCommuneSousIndicateur($indicateur->id,$commune->id,$annee) as $sosuIndicateur)
                        <tr >
                            <td colspan=2 style="padding-left: 5%"><li>{{$sosuIndicateur->lib_sous_ind }}</li></td>
                            @if($sosuIndicateur->agrege == true)
                                <td style="text-align: center">NA</td>
                                <td style="text-align: center">NA</td>
                            @else
                                <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrPrevisionHC($sosuIndicateur->id,$commune->id,$annee)}}</td>
                                <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrPrevisionFC($sosuIndicateur->id,$commune->id,$annee)}}</td>
                            @endif
                            <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrPrevisionTotalC($sosuIndicateur->id,$commune->id,$annee)}}</td>
                            @if($sosuIndicateur->agrege == true)
                                <td style="text-align: center">NA</td>
                                <td style="text-align: center">NA</td>
                            @else
                                <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrRealisationHC($sosuIndicateur->id,$commune->id,$annee)}}</td>
                                <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrRealisationFC($sosuIndicateur->id,$commune->id,$annee)}}</td>
                            @endif
                            <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrRealisationTotalC($sosuIndicateur->id,$commune->id,$annee)}}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
            </tbody>
            <tfoot style="font-size: 18px;text-align: center">
            <tr>
                <td colspan=2 rowspan=2 style="width: 70%"><strong>Programme budgétaire</strong></td>
                <td colspan=3><strong>Prévisions</strong></td>
                <td colspan=3><strong>Réalisations</strong></td>
            </tr>
            <tr>
                <td><strong>H</strong></td>
                <td><strong>F</strong></td>
                <td><strong>Total</strong></td>
                <td><strong>H</strong></td>
                <td><strong>F</strong></td>
                <td><strong>Total</strong></td>
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
        <br>
        <br>

    @endforeach

</body>
</html>
