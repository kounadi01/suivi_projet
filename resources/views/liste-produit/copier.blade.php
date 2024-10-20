<div class="modal-header">
    <h5 class="modal-title">
        Coipier la liste
    </h5>
    <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
</div>
<div class="modal-body">
    <div class="form-group col-sm-12">
        <form method="POST" class="main-form" role="form" action="{!! route('listeProduits.copier') !!}" id="paste-liste-produit-form">
            {!! csrf_field() !!}
            <div class="card-body">
                @include('liste-produit.fields')
            </div>

            <div class="card-footer " style="float: right;">
                <button type="button" id="paste-liste-produit-btn" class="btn btn-success">Valider</button>
                <button type="button" aria-label="Close" class="btn btn-primary" data-dismiss="modal">Annuler</button>
            </div>
        </form>
    </div>
</div>