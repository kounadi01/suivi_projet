<table class="display text-sm data-table" id="coordonateur-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $coordonateur)
        <tr>
            <td>{{ $coordonateur->id }}</td>
            <td>{{ $coordonateur->nom }}</td>
            <td>{{ $coordonateur->prenom }}</td>
            <td>{{ $coordonateur->telephone }}</td>
            <td>{{ $coordonateur->email }}</td>
            <td>
                <div class='btn-group' style="text-align: center">
                    <a href="#" data-url="{!! route('coordonateurs.edit', $coordonateur) !!}" id="modifierCoordonateur" class="btn btn-info data-tooltip" data-tooltip="Modifier le coordonateur">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" data-url="{!! route('coordonateurs.delete', $coordonateur->id) !!}" id="supprimerCoordonateur" class="btn btn-danger data-tooltip" data-tooltip="Supprimer le coordonateur">
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
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
