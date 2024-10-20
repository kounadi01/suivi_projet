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

<table id="tableEditable" class="display text-sm data-table">
    <thead>
        <tr>
            <th>N°</th>
            <th hidden>Prevision_id</th>
            <th>Produits</th>
            <th>Prévision</th>
            <th>Montant total</th>
            <th>Montant local</th>
            <th>Fournisseur</th>
            <th>Fichier</th>
            <!-- <th>Action</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach ($options as $index=>$produit)
        <tr>
            <td>{{$index+1}}</td>
            <td hidden>
                <input type="number" name="prevision_id[{{$produit->id}}]" value="{{ $produit->prevision_id }}">
            </td>
            <td>{{ $produit->libelle }}</td>
            <td style=" text-align: center">
                {{ number_format($produit->montant_total, 0, ',', ' ') }}
            </td>
            <td style="text-align: center">
                <input type="number" name="montant_total[{{$produit->id}}]" value="{{\App\Models\PlanRealisation::getMontant($produit->prevision_id, "montant_total")}}">
            </td>
            <td style="text-align: center">
                <input type="number" name="montant_local[{{$produit->id}}]" value="{{\App\Models\PlanRealisation::getMontant($produit->prevision_id, "montant_local")}}">
            </td>
            <td style="text-align: center">
                <select name="fournisseur[{{$produit->id}}][]" class="select2" multiple="multiple" data-placeholder="Selectionner fournisseur">
                    @foreach($fournisseurs as $option)
                    <option value=" {{$option->sigle}}" @if (in_array($option->sigle, explode(';', \App\Models\PlanRealisation::getMontant($produit->prevision_id, "fournisseurs")))) echo selected @endif
                        >
                        {{ $option->nom }}
                    </option>
                    @endforeach
                </select>
                <!-- <input type="file" name="fichier[{{$produit->id}}]" value="{{\App\Models\ListeProduit::getPourcentage(0, 0, "exploitation")}}"> -->
            </td>
            <td style="text-align: center">
                <input type="file" name="fichier[{{$produit->id}}]">
                @if(\App\Models\PlanRealisation::getMontant($produit->prevision_id, "fichier") != "")
                <a href="{{asset('uploads/fichier')}}/{{\App\Models\PlanRealisation::getMontant($produit->prevision_id, "fichier")}}" target="_blank" class="btn btn-success btn-circle m-1"><i class="fa fa-file"></i></a>
                @endif
            </td>
            <!-- <td>
                <button class="btn btn-danger" onclick="supprimerLigne(this)">Supprimer</button>
            </td> -->
        </tr>
        @endforeach

    </tbody>
</table>


<!-- <button class="btn btn-primary" onclick="getOption('null');">Ajouter une ligne</button> -->

<button class="btn btn-success" id="bouton">Sauvegarder les données</button>