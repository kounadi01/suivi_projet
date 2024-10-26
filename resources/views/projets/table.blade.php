<table class="display text-sm data-table" id="projets-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Libellé</th>
            <th>Puissance totale</th>
            <th>Montant Total</th>
            <th>Taux physique</th>
            <th>Taux financier</th>
            <th>Localisation</th>
            <th>Coordonnateur</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projets as $index => $projet)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $projet->libelle ?? '' }}</td>
            <td>{{ $projet->quantite_total ?? ''}}</td>
            <td>{{ $projet->montant_total ?? '' }}</td>
            <td>{{ $projet->taux_physique ?? '' }}</td>
            <td>{{ $projet->taux_financier ?? '' }}</td>
            <td>{{ $projet->localisation  ?? '' }}</td>
            <td>{{ $projet->dernierCoordonnateur()->nom ?? '' }} {{ $projet->dernierCoordonnateur()->prenom ?? '' }}</td>
            {{-- <td>{{ $projet->coordonnateurs->last()->nom ?? '' }} {{ $projet->coordonnateurs->last()->prenom ?? '' }}</td> --}}
            <td>{{ $projet->statut ?? '' }}</td> 
            <td>
                <div class='btn-group'>
                    <a href="{{ route('projets.show', $projet->id) }}" class="btn btn-info data-tooltip" data-tooltip="Voir le projet">
                        <i class="fas fa-eye"></i>
                    </a>

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
