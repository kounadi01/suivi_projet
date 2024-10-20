<table class="display text-sm data-table" id="reponse-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Structure</th>
            <th>Contact</th>
            <th>Envoyé ?</th>
            <th>Ouvert ?</th>
            <th>Date reportée</th>
            <th>Date d'envoie</th>
            <th>Situation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($data as $index => $reponse)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{ $reponse->structure->nom_struct }}</td>
            <td>{{ $reponse->structure->tel_struct }}</td>
            <td>
                <p>
                    <input type="checkbox" id="test3" disabled @if($reponse->envoye == 1) checked @endif/>
                    <label for="test3" aria-describedby="label"><span class="ui"></span></label>
                </p>
            </td>
            <td>
                <p>
                    <input type="checkbox" id="test3" disabled @if($reponse->ouvert == 1) checked @endif/>
                    <label for="test3" aria-describedby="label"><span class="ui"></span></label>
                </p>
            </td>
            <td>{{ $reponse->date_reouverture }}</td>
            <td>{{ $reponse->created_at }}</td>
            <td>
                @if ($reponse->envoye == 1)
                <span class="btn btn-sm btn-success btn-gradient btn-pill m-1">Terminé</span>
                @else
                    @if (\App\Models\AnneeExercice::getVerifDateDebut($ae,'realisation') == true)

                        @if (\App\Models\AnneeExercice::getDifDate($ae,$reponse->structure_id, 'realisation') >= 0)
                            @if (\App\Models\AnneeExercice::getDifDate($ae,$reponse->structure_id, 'realisation') > 30)
                                <span class="btn btn-sm btn-primary btn-gradient btn-pill m-1">
                                    Il reste {{ \App\Models\AnneeExercice::getDifDate($ae,$reponse->structure_id, 'realisation') }} jour(s)
                                </span>
                            @else
                                <span class="btn btn-sm btn-warning btn-gradient btn-pill m-1">
                                    Il reste {{ \App\Models\AnneeExercice::getDifDate($ae,$reponse->structure_id, 'realisation') }} jour(s)
                                </span>
                            @endif
                            
                        @else
                            <span class="btn btn-sm btn-danger btn-gradient btn-pill m-1">
                                En retard de {{ abs(\App\Models\AnneeExercice::getDifDate($ae,$reponse->structure_id, 'realisation')) }} jour(s)
                            </span>
                        @endif
                        
                    @else
                        <span class="btn btn-sm btn-default btn-gradient btn-pill m-1">
                            Pas encore arrivé
                        </span>
                    @endif
                    
                @endif
            </td>
            <td>
                <a href="{!! route('reponses.show', [$reponse->id,'option'=>'realisation']) !!}" id="showList" class="btn btn-info data-tooltip" data-tooltip="Voir la liste">
                    <i class="fas fa-eye"></i> Voir
                </a>
                @if(\App\Models\User::authUserProfil()->nom=='Administrateur')
                <a href="#" data-url="{!! route('reponses.delete', $reponse->id) !!}" id="supprimerList" class="btn btn-info data-tooltip" data-tooltip="Supprimer le produit">
                    <i class="fas fa-trash"></i> Supprimer
                </a>
                <a href="#" data-url="{!! route('reponses.edit', [$reponse->id,'option'=>'realisation']) !!}" id="modifierList" class="btn btn-info data-tooltip" data-tooltip="Repporter la date">
                    <i class="fa fa-window-restore"></i> Repporter
                </a>
                @else
                @if (\App\Models\Reponse::controleReponse($reponse->id))
                <a href="#" data-url="{!! route('approvisions.envoyerListe', [$reponse->id,'option'=>'realisation']) !!}" id="envoyerList" class="btn btn-info data-tooltip" data-tooltip="Repporter la date">
                    <i class="fa fa-window-restore"></i> Envoyer
                </a>
                @endif
                @endif
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>N°</th>
            <th>Structure</th>
            <th>Contact</th>
            <th>Envoyé ?</th>
            <th>Ouvert ?</th>
            <th>Date reportée</th>
            <th>Date d'envoie</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>