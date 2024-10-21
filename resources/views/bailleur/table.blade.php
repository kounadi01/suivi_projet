<table class="display text-sm data-table" id="bailleur-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Sigle</th>
            <th>Téléphone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $bailleur)
        <tr>
            <td>{{ $bailleur->id }}</td>
            <td>{{ $bailleur->nom }}</td>
            <td>{{ $bailleur->sigle }}</td>
            <td>{{ $bailleur->telephone }}</td>
            <td>
                <div class='btn-group' style="text-align: center">
                    <a href="#" data-url="{!! route('bailleurs.edit', $bailleur) !!}" id="modifierBailleur" class="btn btn-info data-tooltip" data-tooltip="Modifier le bailleur">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" data-url="{!! route('bailleurs.delete', $bailleur->id) !!}" id="supprimerBailleur" class="btn btn-danger data-tooltip" data-tooltip="Supprimer le bailleur">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Sigle</th>
            <th>Téléphone</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
