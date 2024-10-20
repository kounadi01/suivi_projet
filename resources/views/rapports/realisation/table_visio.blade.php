<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>
<table class="display text-sm data-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Produits</th>
            <th>Prévision totale</th>
            <th>Réalisation totale</th>
            <th>Réalisation locale</th>
            <th>Quota fixé(%)</th>
            <th>Quota réalisé(%)</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($options as $index=>$produit)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{ $produit->libelle }}</td>
            <td style=" text-align: center">
                {{ number_format($produit->prevision_total, 0, ',', ' ') }}
            </td>
            <td style="text-align: center">
                {{ number_format($produit->realisation_total, 0, ',', ' ') }}
            </td>
            <td style="text-align: center">
                {{ number_format($produit->realisation_local, 0, ',', ' ') }}
            </td>
            <td style="text-align:center">
                {{ number_format($produit->taux, 0, ',', ' ') }}
            </td>
            <td style="text-align:center">
            @if ($produit->realisation_total > 0)
                {{ number_format(($produit->realisation_local/$produit->realisation_total)*100, 0, ',', ' ') }}
            @else
                0
            @endif
            </td>
        </tr>
        @endforeach

    </tbody>
</table>