<table class="display text-sm data-table" id="annee-exercices-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Annnée exercice</th>
            <th>Début prévision</th>
            <th>Fin prévision</th>
            <th>Début réalisation</th>
            <th>Fin réalisation</th>
            <th>statut</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($annee_exercices as $ind => $annee_exercice)
        <tr>
            <td>{{ $ind }}</td>
            <td>{{ $annee_exercice->annee_exercice }}</td>
            <td>{{ $annee_exercice->date_debut_prevision }}</td>
            <td>{{ $annee_exercice->date_fin_prevision }}</td>
            <td>{{ $annee_exercice->date_debut_realisation }}</td>
            <td>{{ $annee_exercice->date_fin_realisation }}</td>
            <td>
                @if ($annee_exercice->statut == "clôturée")
                <span class="text-red">
                    {{ $annee_exercice->statut }}
                </span>
                @elseif($annee_exercice->statut == "active")
                <span class="text-success">
                    {{ $annee_exercice->statut }}
                </span>
                @else
                <span>
                    {{ $annee_exercice->statut }}
                </span>
                @endif
            </td>
            <td>
                <div class='btn-group'>

                    @if ($annee_exercice->statut == "inactive")
                    <a href="#" data-url="{!! route('annee-exercices.activer',$annee_exercice->id) !!}" id="activerAnneeExercice" class="btn btn-info data-tooltip" data-tooltip="Activer l'année">
                        <i class="fas fa-eye"></i> Activer
                    </a>
                    @else
                    @if ($annee_exercice->statut == "clôturée")
                    <a href="#" data-url="{!! route('annee-exercices.activer',$annee_exercice->id) !!}" id="activerAnneeExercice" class="btn btn-info data-tooltip" data-tooltip="Activer l'année">
                        <i class="fas fa-eye"></i> Réactiver
                    </a>
                    @else
                    <a href="#" data-url="{!! route('annee-exercices.cloturer',$annee_exercice->id) !!}" id="cloturerAnneeExercice" class="btn btn-info data-tooltip" data-tooltip="clôturer l'année">
                        <i class="fas fa-eye"></i> clôturer
                    </a>
                    @endif

                    @endif
                    <a href="#" data-url="{!! route('annee-exercices.edit',$annee_exercice) !!}" id="modifierAnnee" class="btn btn-info data-tooltip" data-tooltip="Modifier l'année">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>N°</th>
            <th>Annnée exercice</th>
            <th>Début prévision</th>
            <th>Fin prévision</th>
            <th>Début réalisation</th>
            <th>Fin réalisation</th>
            <th>statut</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>