<table class="display text-sm data-table" id="phases-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Libellé</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $phase)
        <tr>
            <td>{{ $phase->id }}</td>
            <td>{{ $phase->libelle }}</td>
            <td>
                <div class='btn-group' style="text-align: center">
                    <a href="#" data-url="{!! route('phases.show',$phase->id) !!}" id="detailDep" class="btn btn-info data-tooltip" data-tooltip="Détails du département">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" data-url="{!! route('phases.edit',$phase) !!}" id="modifierDep" class="btn btn-info data-tooltip" data-tooltip="Modifier la nature">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" data-url="{!! route('phases.delete', $phase->id) !!}" id="supprimerDep" class="btn btn-info data-tooltip" data-tooltip="Supprimer la nature">
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
            <th>Action</th>
        </tr>
    </tfoot>
</table>