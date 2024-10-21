<table class="display text-sm data-table" id="fournisseurs-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Dénomination</th>
            <th>sigle</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Responsable</th>
            <th>Inscrite le</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $fournisseur)
        <tr>
            <td>{{ $fournisseur->id }}</td>
            <td>{{ $fournisseur->nom }}</td>
            <td>{{ $fournisseur->sigle }}</td>
            <td>{{ $fournisseur->tel}}</td>
            <td>{{ $fournisseur->email}}</td>
            <td>{{ $fournisseur->responsable}}</td>
            <td>{{ $fournisseur->created_at}}</td>
            <td>
                <div class='btn-group' style="text-align: center">
                    <!-- <a href="#" data-url="{!! route('fournisseurs.show',$fournisseur->id) !!}" id="detailDep" class="btn btn-info data-tooltip" data-tooltip="Détails du département">
                        <i class="fas fa-eye"></i>
                    </a> -->
                    <a href="#" data-url="{!! route('fournisseurs.edit',$fournisseur) !!}" id="modifierFrs" class="btn btn-info data-tooltip" data-tooltip="Modifier le fournisseur">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="#" data-url="{!! route('fournisseurs.delete', $fournisseur->id) !!}" id="supprimerFrs" class="btn btn-info data-tooltip" data-tooltip="Supprimer le fournisseur">
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
            <th>Dénomination</th>
            <th>sigle</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Responsable</th>
            <th>Inscrit le</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>