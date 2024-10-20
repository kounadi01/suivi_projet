<div id="createannee-exercice" class="main-modal modal" role="dialog" tabindex="-1">
    <div
        aria-hidden="true"
        aria-labelledby="createannee-exercice"
        class="modal-dialog modal-md modal-dialog-scrollable">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Nouvelle année exercice
                </h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                    <div class="form-group col-sm-12">
                        <form 
                            method="POST"
                            class = "main-form" role="form" action = "{!! route('annee-exercices.store') !!}"
                            id = "create-annee-exercice-form">
                            {!! csrf_field() !!}
                            <div class="card-body">
                                @include('annee-exercices.fields')
                            </div>
                   
                            <div class="card-footer " style="float: right;">
                                <button type="button" id="create-annee-exercice-btn" class="btn btn-success">Valider</button>
                                <button type="button" aria-label="Close" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>



