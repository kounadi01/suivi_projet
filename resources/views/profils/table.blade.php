
    <table class="display text-sm data-table" id="profils-table">
        <thead>
            <tr>
                <th>N°</th>
                <th>Profil Utilisateur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($profils as $profil)
            <tr>
                <td>{{ $profil->id }}</td>
                <td>{{ $profil->nom }}</td>
                <td>
                    <div class='btn-group'>
                        <a href="#"
                            data-url="{!! route('profils.edit',$profil->id) !!}"
                            id="modifierProfil"
                                class="btn btn-info data-tooltip" data-tooltip="Modifier du profil">         
                                <i class="fas fa-edit"></i>     
                        </a>
                        <a href="#"
                            data-url="{!! route('profils.delete', $profil->id) !!}"
                            id="supprimerProfil"
                                class="btn btn-info data-tooltip" data-tooltip="Supprimer du profil">         
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
            <th>Profil Utilisateur</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
