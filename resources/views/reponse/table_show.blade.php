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
            <th hidden>Id</th>
            <th>Produits</th>
            <th>Taux min. (%)</th>
            <th>Montant total</th>
            <th>Montant local</th>
            <!-- <th>Total</th> -->
            <!-- <th>Action</th> -->
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="4" style="text-align:center;font-style: italic;
            font-weight: bold;background-color: #6c757d;font-size: 20px;color:white">Les des produits dans l'arrèté</td>
        </tr>
        @foreach ($options as $produit)
        <tr>
            <td hidden>{{$produit->id}}</td>
            <td>{{$produit->libelle}}</td>
            <td>{{\App\Models\ListeProduit::getPourcentage($ae, $produit->produit_id, $phase)}}</td>
            <td>{{number_format(\App\Models\Reponse::getReponse($produit->produit_id, $reponse_id, 'montant_total'), 0, ',', ' ')}}</td>
            <td>{{number_format(\App\Models\Reponse::getReponse($produit->produit_id, $reponse_id, 'montant_local'), 0, ',', ' ')}}</td>
            <!-- <td contenteditable="true"></td> -->
            <!-- <td>
                <button class="btn btn-danger" onclick="supprimerLigne(this)">Supprimer</button>
            </td> -->
        </tr>
        @endforeach

        <tr>
            <td colspan="4" style="text-align:center;font-style: italic;
            font-weight: bold;background-color: #6c757d;font-size: 20px;color:white">Les autres produits</td>
        </tr>
        @foreach ($autresProduits as $produit)
        <tr>
            <td hidden>{{$produit->id}}</td>
            <td>{{$produit->libelle}}</td>
            <td>0</td>
            <td>{{number_format(\App\Models\Reponse::getAutreReponse($produit->id, $reponse_id, 'montant_total'), 0, ',', ' ')}}</td>
            <td>0</td>

        </tr>
        @endforeach
    </tbody>
</table>