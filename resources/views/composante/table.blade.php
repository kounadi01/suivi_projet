<table class="display text-sm data-table" id="composante-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Libellé</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $composante)
        <tr>
            <td>{{ $composante->id }}</td>
            <td>{{ $composante->libelle }}</td>
            <td>{{ $composante->description }}</td>
            <td>
                <div class='btn-group' style="text-align: center">
                    {{-- <a href="#" data-url="{!! route('composantes.show',$phase->id) !!}" id="detailDep" class="btn btn-info data-tooltip" data-tooltip="Détails du département">
                        <i class="fas fa-eye"></i>
                    </a> --}}
                    <a href="#" data-url="{!! route('composantes.edit',$composante) !!}" id="modifierComposante" class="btn btn-info data-tooltip" data-tooltip="Modifier la composante">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" data-url="{!! route('composantes.delete', $composante->id) !!}" id="supprimerComposante" class="btn btn-info data-tooltip" data-tooltip="Supprimer la composante">
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
            <th>Libellé</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>