<div class="col-sm-12">
    <div class="row">
        <div class="required form-group col-md-6">
            <label class="control-label" for="date_execution">Date d'éxecution</label>
            {!! Form::date('date_execution', null, ['class' => 'form-control', 'placeholder' => 'Date execution', 'id' => 'date_execution']) !!}
        </div>
        <div class="required form-group col-md-6">
            <label class="control-label" for="statut">Statut</label>
            {!! Form::select('statut', [
            'Démarré' => 'Démarré',
            'En cours' => 'En cours',
            'Terminé' => 'Terminé'
            ], null, ['class' => 'form-control', 'placeholder' => 'Sélectionner le statut', 'id' => 'statut']) !!}
        </div>

    </div>
    <div class="row">
        <div class="required form-group col-md-6">
            <label class="control-label" for="taux_physique">Taux physique (%)</label>
            {!! Form::number('taux_physique', null, ['class' => 'form-control', 'placeholder' => 'Taux', 'id' => 'taux_physique']) !!}
        </div>

        <div class="required form-group col-md-6">
            <label class="control-label" for="taux_financier">Taux financier (%)</label>
            {!! Form::number('taux_financier', null, ['class' => 'form-control', 'placeholder' => 'Taux financier', 'id' => 'taux_financier']) !!}
        </div>
    </div>

    <div class="row">
        <div class="required form-group col-md-6">
            <label class="control-label" for="difficultes">Difficultés</label>
            {!! Form::text('difficultes', null, ['class' => 'form-control', 'placeholder' => 'Difficultés rencontrées', 'id' => 'difficultes']) !!}
        </div>

        <div class="required form-group col-md-6">
            <label class="control-label" for="action">Action à méner</label>
            {!! Form::text('action', null, ['class' => 'form-control', 'placeholder' => 'Saisir l\'action', 'id' => 'action']) !!}
        </div>
    </div>
</div>