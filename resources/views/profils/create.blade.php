<div class="modal-header">
    <h5 class="modal-title">
        Nouveau profil
    </h5>
    <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
</div>
<div class="modal-body">
        <div class="form-group col-sm-12">
            <form 
                method="POST"
                class = "main-form" role="form" action = "{!! route('profils.store') !!}"
                id = "create-profil-form">
                {!! csrf_field() !!}
                <div class="card-body">
                    @include('profils.fields')
                </div>
       
                <div class="card-footer " style="float: right;">
                    <button type="button" id="create-profil-btn" class="btn btn-success">Valider</button>
                    <button type="button" aria-label="Close" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
</div>