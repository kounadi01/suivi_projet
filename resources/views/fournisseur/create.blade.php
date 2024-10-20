<div id="create-fournisseur" class="main-modal modal" role="dialog" tabindex="-1">
    <div aria-hidden="true" aria-labelledby="createfournisseur" class="modal-dialog modal-md modal-dialog-scrollable">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Nouveau fournisseur
                </h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group col-sm-12">
                    <form method="POST" class="main-form" role="form" action="{!! route('fournisseurs.store') !!}" id="create-fournisseur-form">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            @include('fournisseur.fields')
                        </div>

                        <div class="card-footer " style="float: right;">
                            <button type="button" id="create-fournisseur-btn" class="btn btn-success">Valider</button>
                            <button type="button" aria-label="Close" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>