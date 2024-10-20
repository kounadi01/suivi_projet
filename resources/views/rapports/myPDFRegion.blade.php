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

<div style="text-align: center;text-decoration: underline">
    <strong>
        Région de : {{$data->nom_region}} en {{$annee}}
    </strong>

</div>
<br>
<table class="" id="rapports-table" style="width: 100%" >
    <thead style="font-size: 18px;text-align: center">
    <tr>
        <td style="width: 70%" colspan=2 rowspan=2 style=""><strong>Programme budgétaire</strong></td>
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
    @foreach(\App\Models\Programme::programmeAnneeRegion($data->id) as $inc=>$programme)
        <tr>
            <td colspan=8 style="background-color: gainsboro;text-align: center"><strong>{{$programme->titre}}</strong></td>

        </tr>

        @foreach(\App\Models\SousIndicateur::listeRegionIndicateurs($programme->id,$data->id,$annee) as $indicateur)

            <tr >
                <td colspan=2>{{$indicateur->lib_ind }}</td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center;"></td>
            </tr>

            @foreach(\App\Models\SousIndicateur::listeRegionSousIndicateur($indicateur->id,$data->id,$annee) as $sousIndicateur)
                <tr >
                    <td  colspan=2 style="padding-left: 5%"><li>{{$sousIndicateur->lib_sous_ind }}</li></td>
                    @if($sousIndicateur->agrege == true)
                        <td style="text-align: center">NA</td>
                        <td style="text-align: center">NA</td>
                    @else
                        <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrPrevisionHR($sousIndicateur->id,$data->id,$annee)}}</td>
                        <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrPrevisionFR($sousIndicateur->id,$data->id,$annee)}}</td>
                    @endif
                    <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrPrevisionTotalR($sousIndicateur->id,$data->id,$annee)}}</td>
                    @if($sousIndicateur->agrege == true)
                        <td style="text-align: center">NA</td>
                        <td style="text-align: center">NA</td>
                    @else
                        <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrRealisationHR($sousIndicateur->id,$data->id,$annee)}}</td>
                        <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrRealisationFR($sousIndicateur->id,$data->id,$annee)}}</td>
                    @endif
                    <td style="text-align: center;">{{\App\Models\SousIndicateur::nbrRealisationTotalR($sousIndicateur->id,$data->id,$annee)}}</td>
                </tr>
            @endforeach
         @endforeach
    @endforeach
    </tbody>
    <tfoot style="font-size: 18px;text-align: center">
    <tr>
        <td style="border: 1px solid black;width: 70%" colspan=2 rowspan=2 ><strong>Programme budgétaire</strong></td>
        <td  colspan=3><strong>Prévisions</strong></td>
        <td  colspan=3><strong>Réalisations</strong></td>
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

</body>
</html>
