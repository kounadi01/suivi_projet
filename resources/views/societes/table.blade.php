<table class="display text-sm data-table" id="societes-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Dénomination</th>
            <th>Type</th>
            <th>Siège</th>
            <th>Adresse</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($societes as $index => $societe)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $societe->libelle }}</td>
            <td>{{ $societe->type }}</td>
            <td>{{ $societe->siege }}</td>
            <td>{{ $societe->adresse }}</td>
            <td>
                <div class='btn-group'>
                    <a href="{{ route('societes.edit', $societe->id) }}" class="btn btn-info data-tooltip" data-tooltip="Modifier la société">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" data-url="{!! route('societes.delete', $societe->id) !!}" id="supprimerSoc" class="btn btn-danger data-tooltip" data-tooltip="Supprimer la société">
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
            <th>Dénomination</th>
            <th>Type</th>
            <th>Siège</th>
            <th>Adresse</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
