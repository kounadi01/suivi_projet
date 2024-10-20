<table class="display text-sm data-table" id="demande-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Annnée</th>
            <th>Structure</th>
            <th>Type</th>
            <th>Produit</th>
            <th>Montant total</th>
            <th>Montant local</th>
            <th>Fichier</th>
            <th>statut</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($demandes as $ind => $demande)
        <tr>
            <td>{{ $ind }}</td>
            <td>{{ $demande->annee->annee_exercice }}</td>
            <td>{{ $demande->structure->nom_struct }}</td>
            <td>{{ $demande->type }}</td>
            <td>{{ $demande->produit->libelle }}</td>
            <td>{{ $demande->montant_total }}</td>
            <td>{{ $demande->montant_local }}</td>
            <td>
                @if($demande->fichier != "")
                <a href="{{asset('uploads/demande')}}/{{$demande->fichier}}" target="_blank" class="btn btn-success btn-circle m-1"><i class="fa fa-file"></i></a>
                @endif
            </td>
            <td>
                @if ($demande->refuse == 1)
                <span class="text-red">
                    Rejeté
                </span>
                @elseif($demande->accepte == 1)
                <span class="text-success">
                    Validé
                </span>
                @else
                <span>
                    En cours
                </span>
                @endif
            </td>
            <td>
                <div class='btn-group'>
                    @if(\App\Models\User::authUserProfil()->nom=='Administrateur' )
                        @if ($demande->accepte == false)
                        <a href="#" data-url="{!! route('demandes.valider',$demande->id) !!}" id="validerDemande" class="btn btn-info data-tooltip" data-tooltip="Valider la demande">
                            <i class="fas fa-eye"></i> Valider
                        </a>
                        @endif
                        @if ($demande->refuse == false)
                        <a href="#" data-url="{!! route('demandes.rejeter',$demande->id) !!}" id="rejeterDemande" class="btn btn-info data-tooltip" data-tooltip="Rejeter la demande">
                            <i class="fas fa-eye"></i> Rejeter
                        </a>
                        @endif
                    @endif
                    @if ($demande->accepte == false)
                    <a href="#" data-url="{!! route('demandes.edit',$demande) !!}" id="modifierDemande" class="btn btn-info data-tooltip" data-tooltip="Modifier la demande">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="#" data-url="{!! route('demandes.delete', $demande->id) !!}" id="supprimerDemande" class="btn btn-info data-tooltip" data-tooltip="Supprimer la demande">
                        <i class="fas fa-trash"></i> Supprimer
                    </a>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>N°</th>
            <th>Annnée</th>
            <th>Structure</th>
            <th>Type</th>
            <th>Produit</th>
            <th>Montant total</th>
            <th>Montant local</th>
            <th>Fichier</th>
            <th>statut</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>