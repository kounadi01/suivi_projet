<table class="display text-sm data-table" id="structures-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Dénomination</th>
            <th>sigle</th>
            <th>Type</th>
            <th>Phase</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Responsable</th>
            <th>Inscrit le</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($structures as $index => $structure)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $structure->nom_struct }}</td>
            <td>{{ $structure->sigle_struct }}</td>
            <td>{{ $structure->type_struct}}</td>
            <td>{{ $structure->phase_struct}}</td>
            <td>{{ $structure->tel_struct}}</td>
            <td>{{ $structure->email_struct}}</td>
            <td>{{ $structure->responsable_struct}}</td>
            <td>{{ $structure->created_at}}</td>
            <td>
                <div class='btn-group'>
                    <a href="{{route('structures.edit',$structure->id) }}" class="btn btn-info data-tooltip" data-tooltip="Modifier la structure">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" data-url="{!! route('structures.delete', $structure->id) !!}" id="supprimerStruct" class="btn btn-info data-tooltip" data-tooltip="Supprimer la structure">
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
            <th>sigle</th>
            <th>Type</th>
            <th>Phase</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Responsable</th>
            <th>Inscrit le</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>