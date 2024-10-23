<table class="display text-sm data-table" id="projets-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Libellé</th>
            <th>Description</th>
            <th>Quantité</th>
            <th>Montant Total</th>
            <th>État d'Exécution</th>
            <th>Localisation</th>
            <th>Composantes</th>
            <th>Coordonnateur</th> {{-- Champ unique --}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projets as $index => $projet)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $projet->libelle ?? '' }}</td>
            <td>{{ $projet->description ?? ''}}</td>
            <td>{{ $projet->quantite_total ?? ''}}</td>
            <td>{{ $projet->montant_total ?? '' }}</td>
            <td>{{ $projet->etat_execution ?? '' }}</td>
            <td>{{ $projet->localisation  ?? '' }}</td>
            <td>{{ implode(', ', $projet->composantes->pluck('libelle')->toArray()) }}</td>
            <td>{{ $projet->coordonnateurs->last()->nom ?? '' }} {{ $projet->coordonnateurs->last()->prenom ?? '' }}</td> 
            <td>
                <div class='btn-group'>
                    <a href="{{ route('projets.edit', $projet->id) }}" class="btn btn-info data-tooltip" data-tooltip="Modifier le projet">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" data-url="{!! route('projets.delete', $projet->id) !!}" id="supprimerProj" class="btn btn-danger data-tooltip" data-tooltip="Supprimer le projet">
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
            <th>Quantité</th>
            <th>Montant Total</th>
            <th>État d'Exécution</th>
            <th>Localisation</th>
            <th>Composantes</th>
            <th>Coordonnateur</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
