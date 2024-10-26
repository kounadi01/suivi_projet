<table class="display text-sm data-table" id="projets-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Libellé</th>
            <th>Description</th>
            <th>Quantité</th>
            <th>Unité</th>
            <th>Montant Total</th>
            <th>Localisation</th>
            <th>Composantes</th>
            <th>Coordonnateur</th> {{-- Champ unique --}}
            <th>Statut</th>
            <th>Taux financier</th>
            <th>Taux physique</th>
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
            <td>{{ $projet->unite ?? ''}}</td>
            <td>{{ $projet->montant_total ?? '' }}</td>
            <td>{{ $projet->localisation  ?? '' }}</td>
            <td>{{ implode(', ', $projet->composantes->pluck('libelle')->toArray()) }}</td>
            <td>{{ $projet->coordonnateurs->last()->nom ?? '' }} {{ $projet->coordonnateurs->last()->prenom ?? '' }}</td> 
            <td>{{ $projet->statut ?? ''}}</td>
            <td>{{ $projet->taux_financier ?? '' }}</td>
            <td>{{ $projet->taux_physique  ?? '' }}</td>
            <td>
                <div class='btn-group'>
                    <a href="{{ route('projets.edit', $projet->id) }}" class="btn btn-info data-tooltip" title="Modifier le projet">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('projets.show', $projet->id) }}" class="btn btn-info data-tooltip" title="Voir détails du projet">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" data-url="{!! route('realisations.create',['id'=>$projet->id]) !!}" id="evaluerProj"  class="btn btn-success data-tooltip" title="Evaluer projet">
                        <i class="fas fa-check"></i>
                    </a>
                    <a href="#" data-url="{!! route('projets.delete', $projet->id) !!}" id="supprimerProj" class="btn btn-danger data-tooltip" title="Supprimer le projet">
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
