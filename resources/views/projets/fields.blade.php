<div class="col-sm-12">
    {!! Form::open(['route' => 'projets.store', 'class' => 'form-horizontal panel', 'id' => 'regForm']) !!}
    
    <div class="row">
        <div class="required form-group col-md-6">
            <label class="control-label" for="libelle">Libellé</label>
            {!! Form::text('libelle', null, ['class' => 'form-control', 'placeholder' => 'Libellé du projet', 'id' => 'libelle']) !!}
        </div>
        <div class="required form-group col-md-6">
            <label class="control-label" for="categorie">Catégorie</label>
            {!! Form::text('categorie', null, ['class' => 'form-control', 'placeholder' => 'Catégorie', 'id' => 'categorie']) !!}
        </div>
    </div>
    <div class="row">
        <div class="required form-group col-md-6">
            <label class="control-label" for="quantite_total">Quantité totale</label>
            {!! Form::text('quantite_total', null, ['class' => 'form-control', 'placeholder' => 'Quantité totale', 'id' => 'quantite_total']) !!}
        </div>
        <div class="required form-group col-md-6">
            <label class="control-label" for="montant_total">Montant total</label>
            {!! Form::text('montant_total', null, ['class' => 'form-control', 'placeholder' => 'Montant total', 'id' => 'montant_total']) !!}
        </div>
    </div>
    <div class="row">
        <div class="required form-group col-md-6">
            <label class="control-label" for="localisation">Localisation</label>
            {!! Form::text('localisation', null, ['class' => 'form-control', 'placeholder' => 'Localisation', 'id' => 'localisation']) !!}
        </div>
        <div class="required form-group col-md-6">
            <label class="control-label" for="etat_execution">État d'exécution</label>
            {!! Form::text('etat_execution', null, ['class' => 'form-control', 'placeholder' => 'État d\'exécution', 'id' => 'etat_execution']) !!}
        </div>
    </div>

    <div class="row">
        <div class="required form-group col-md-6">
            <label class="control-label" for="date_demarrage">Date de démarrage</label>
            {!! Form::date('date_demarrage', null, ['class' => 'form-control', 'id' => 'date_demarrage']) !!}
        </div>
        <div class="required form-group col-md-6">
            <label class="control-label" for="date_fin_probable">Date de fin probable</label>
            {!! Form::date('date_fin_probable', null, ['class' => 'form-control', 'id' => 'date_fin_probable']) !!}
        </div>
    </div>
    <div class="row">
        <div class="required form-group col-md-6">
            <label class="control-label" for="taux_physique">Taux physique</label>
            {!! Form::text('taux_physique', null, ['class' => 'form-control', 'placeholder' => 'Taux', 'id' => 'taux_physique']) !!}
        </div>

        <div class="required form-group col-md-6">
            <label class="control-label" for="taux_financier">Taux financier</label>
            {!! Form::text('taux_financier', null, ['class' => 'form-control', 'placeholder' => 'Taux financier', 'id' => 'taux_financier']) !!}
        </div>
    </div>

    <div class="row">
        <div class="required form-group col-md-6">
            <label class="control-label" for="statut">Statut</label>
            {!! Form::text('statut', null, ['class' => 'form-control', 'placeholder' => 'statut', 'id' => 'statut']) !!}
        </div>

        <div class="required form-group col-md-6">
            <label class="control-label" for="unite">Unite</label>
            {!! Form::text('unite', null, ['class' => 'form-control', 'placeholder' => 'unite', 'id' => 'unite']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="idNat">Nature du projet</label>
            {!! Form::select('idNat', $natures, null, ['class' => 'form-control', 'id' => 'idNat', 'placeholder' => 'Sélectionner une nature de projet']) !!}
        </div>

        <div class="form-group col-md-6">
            <label class="control-label" for="idBai">Bailleur</label>
            {!! Form::select('idBai', $bailleurs, null, ['class' => 'form-control', 'id' => 'idBai', 'placeholder' => 'Sélectionner un bailleur']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="idSoc">Société</label>
            {!! Form::select('idSoc', $societes, null, ['class' => 'form-control', 'id' => 'idSoc', 'placeholder' => 'Sélectionner une société']) !!}
        </div>

        <div class="form-group col-md-6">
            <label class="control-label" for="idEntr">Entreprise</label>
            {!! Form::select('idEntr', $entreprises, null, ['class' => 'form-control', 'id' => 'idEntr', 'placeholder' => 'Sélectionner une entreprise']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="composantes">Composantes</label>
            {!! Form::select('composantes[]', $composantes, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'composantes']) !!}
        </div>

        <div class="form-group col-md-6">
            <label class="control-label" for="coordonnateur">Coordonnateur</label>
            {!! Form::select('coordonnateur', $coordonnateurs, null, ['class' => 'form-control', 'id' => 'coordonnateur']) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
                <label class="control-label" for="description">Description</label>
                {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Description du projet', 'id' => 'description']) !!}
        </div>
    </div>
</div>
