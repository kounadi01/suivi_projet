<form action="{{route('listeProduits.store',['ae'=>$ae,'ty'=>$type])}}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" style="width: 100%">
    {!! csrf_field() !!}

    <table class="display text-sm data-table" id="employer-table">
        <thead>
            <tr>
                <th>N°</th>
                <th>Produits</th>
                <th>Exploration</th>
                <th>Développement/Construction</th>
                <th>Exploitation/Production</th>
                <th>Réhabilitation/Fermeture</th>
                <!-- @foreach ($phases as $phase)
                <th>{{$phase->libelle}}</th>
                @endforeach -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produits as $index => $produit)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{ $produit->libelle }}</td>
                <td style="text-align: center">
                    <input type="number" name="exploration[{{$produit->id}}]" value="{{\App\Models\ListeProduit::getPourcentage($ae, $produit->id, "exploration")}}">
                </td>
                <td style="text-align: center">
                    <input type="number" name="developpement[{{$produit->id}}]" value="{{\App\Models\ListeProduit::getPourcentage($ae, $produit->id, "developpement")}}">
                </td>
                <td style="text-align: center">
                    <input type="number" name="exploitation[{{$produit->id}}]" value="{{\App\Models\ListeProduit::getPourcentage($ae, $produit->id, "exploitation")}}">
                </td>
                <td style="text-align: center">
                    <input type="number" name="rehabilitation[{{$produit->id}}]" value="{{\App\Models\ListeProduit::getPourcentage($ae, $produit->id, "rehabilitation")}}">
                </td>

                <!-- @foreach ($phases as $phase)
                <td style="text-align: center">
                    <input type="number" name="{{ $phase->id }}[{{ $produit->id }}]" value="">
                </td>
                @endforeach -->

                <td>
                    <a href="#" data-url="{!! route('listeProduits.delete', $produit->id) !!}" id="supprimerList" class="btn btn-info data-tooltip" data-tooltip="Supprimer le produit">
                        <i class="fas fa-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th>N°</th>
                <th>Produits</th>
                <th>Exploration</th>
                <th>Développement/Construction</th>
                <th>Exploitation/Production</th>
                <th>Réhabilitation/Fermeture</th>
                <!-- @foreach ($phases as $phase)
                <th>{{$phase->libelle}}</th>
                @endforeach -->
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    <div class="form-group" style="width: 100%;background-color:
                                                    black;display: inline-block;text-align: center">
        <button type="submit" class="btn btn-success" style="width: 100%;font-size: 20px">
            <i class="fa fa-check"></i> Valider
        </button>
    </div>
</form>