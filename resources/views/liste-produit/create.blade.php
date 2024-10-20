<div id="create-liste-produit" class="main-modal modal" role="dialog" tabindex="-1">
    <div aria-hidden="true" aria-labelledby="createliste-produit" class="modal-dialog modal-md modal-dialog-scrollable">
        <!-- Modal content-->
        <div class="modal-content" style="min-width: 750px">
            <div class="modal-header" style="background-color: #007bff;color: white">
                <h5 class="modal-title">
                    Nouvel liste des produits
                </h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group col-sm-12">
                    <form method="POST" class="main-form" role="form" action="{!! route('listeProduits.store') !!}" id="create-liste-produit-form">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            @include('liste-produit.fields')
                        </div>

                        <div class="card-footer " style="float: right;">
                            <button type="button" id="create-liste-produit-btn" class="btn btn-success">Valider</button>
                            <button type="button" aria-label="Close" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>