<table class="display text-sm data-table" id="produits-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Type</th>
            <th>Libellé</th>
            <th>Arreté</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $produit)
        <tr>
            <td>{{ $produit->id }}</td>
            <td>{{ $produit->type }}</td>
            <td>{{ $produit->libelle }}</td>
            <td style="text-align: center;">
                <input type="checkbox" value="1" @if ($produit->decret) checked @endif >
            </td>
            <td>
                <div class='btn-group' style="text-align: center">
                    <!-- <a href="#" data-url="{!! route('produits.show',$produit->id) !!}" id="detailDep" class="btn btn-info data-tooltip" data-tooltip="Détails du département">
                        <i class="fas fa-eye"></i>
                    </a> -->
                    <a href="#" data-url="{!! route('produits.edit',$produit) !!}" id="modifierProd" class="btn btn-info data-tooltip" data-tooltip="Modifier le produit">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="#" data-url="{!! route('produits.delete', $produit->id) !!}" id="supprimerProd" class="btn btn-info data-tooltip" data-tooltip="Supprimer le produit">
                        <i class="fas fa-trash"></i> Supprimer
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>N°</th>
            <th>Type</th>
            <th>Libellé</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>