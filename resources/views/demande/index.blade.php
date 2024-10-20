@extends('layouts.app')
@section('titre' , "Liste des demandes" )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Demandes
    </a>
</li>
@endsection
@section('css')

@endsection
@section('main')
<div class="content">
    <div class="card card-primary">
        <div class="card-header bg-light">
            <h1 class="row float-right">
                <a href="{{route('demandes.create')}}"  class="btn btn-primary float-right ml-4"> <i class="fa fa-plus-circle"></i> Nouvelle demande</a>
                <a href="#" class="btn btn-primary float-right ml-4" id="createdemande-btn"> <i class="fa fa-plus-circle"></i> Nouvelle demande</a>
            </h1>
        </div>
        <div class="card-body">
            @include('demande.table')
        </div>
    </div>
</div>
@include('demande.create_old')
@endsection


@include('partials.main-modal', ['id' => 'showdemande'])
@include('partials.main-modal', ['id' => 'editdemande'])

@section('scripts')

<script type="text/javascript">
    $(function() {
        $('.select2').each(function() {
            $(this).select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });

    });

    // Affichage du formulaire d'enregistrement
    $(document).on('click', '#createdemande-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('demandes.create') !!}";
        $('#createdemande').modal('show');
    });

    // Validation du formulaire d'enregistrement
    $(document).on('click', '#create-demande-btn', function(e) {
        $.ajax({
                method: $('#create-demande-form').attr('method'),
                url: $('#create-demande-form').attr('action'),
                data: $('#create-demande-form').serialize()
            })
            .done(function() {
                success("Demande enregistrée avec succès!");
                actualiseTable('#createdemande')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-demande-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Valider
    $(document).on('click', '#validerDemande', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous valider cette demande ?", function() {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    success("Demande validée");
                    actualiseTableDelete()
                },
                error: function(request, status, errors) {
                    error("L'opération a échoué");
                }
            })
        })
    });

    //Rejeter
    $(document).on('click', '#rejeterDemande', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous rejeter cette demande ?", function() {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    success("Demande rejetée");
                    actualiseTableDelete()
                },
                error: function(request, status, errors) {
                    erreur("Impossible de rejeter la demande");
                }
            })
        })
    });

    // affichage du formulaire de modification
    $(document).on('click', '#modifierDemande', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        //console.log(url);
        $.get(url)
            .done(function(data) {
                //console.log(data);
                $('#editdemande .modal-content').html(data);
                $('#editdemande').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#edit-demande-btn', function(e) {
        $.ajax({
                method: $('#edit-demande-form').attr('method'),
                url: $('#edit-demande-form').attr('action'),
                data: $('#edit-demande-form').serialize()
            })
            .done(function() {
                success("Demande modifiée avec succès!");
                actualiseTable("#editDemande")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#edit-demande-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Suppression d'une demande
    $(document).on('click', '#supprimerDemande', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous supprimer la demande ?", function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("Demande bien supprimée")
                actualiseTableDelete()
            })
        })
    })


    // actualisation du tableau
    function actualiseTable(idModal) {
        var url = "{!! route('demandes.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#demande-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('demandes.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#demande-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    //-----------------Prévision-------------------------------
    // Récupérer les éléments de date
    const startDateInput = document.getElementById('date_debut_prevision');
    const endDateInput = document.getElementById('date_fin_prevision');
    const startDateInputRea = document.getElementById('date_debut_realisation');
    const endDateInputRea = document.getElementById('date_fin_realisation');

    // Ajouter un écouteur d'événements pour la date de début
    startDateInput.addEventListener('change', function() {
        // Récupérer les valeurs des dates
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        // Définir les attributs min et max
        startDateInput.setAttribute('max', endDateInput.value);
        endDateInput.setAttribute('min', startDateInput.value);

        // Vérifier si la date de début est postérieure à la date de fin
        if (startDate > endDate) {
            alert('La date de début ne peut pas être après la date de fin.');
            startDateInput.value = ''; // Réinitialiser la valeur
            startDateInput.setAttribute('max', ''); // Réinitialiser l'attribut max
        }
    });

    // Ajouter un écouteur d'événements pour la date de fin
    endDateInput.addEventListener('change', function() {
        // Récupérer les valeurs des dates
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        const startDateRea = new Date(startDateInputRea.value);

        // Définir les attributs min et max
        startDateInput.setAttribute('max', endDateInput.value);
        endDateInput.setAttribute('min', startDateInput.value);

        startDateInputRea.setAttribute('min', endDateInput.value);

        // Vérifier si la date de fin est antérieure à la date de début
        if (endDate < startDate) {
            alert('La date de fin ne peut pas être avant la date de début.');
            endDateInput.value = ''; // Réinitialiser la valeur
            endDateInput.setAttribute('min', ''); // Réinitialiser l'attribut min
        }
    });

    //-----------------Realisation-------------------------------

    // Ajouter un écouteur d'événements pour la date de début
    startDateInputRea.addEventListener('change', function() {
        // Récupérer les valeurs des dates
        const startDate = new Date(startDateInputRea.value);
        const endDate = new Date(endDateInputRea.value);
        const endDatePre = new Date(endDateInput.value);

        // Définir les attributs min et max
        startDateInputRea.setAttribute('max', endDateInputRea.value);
        endDateInputRea.setAttribute('min', startDateInputRea.value);
        endDateInput.setAttribute('max', startDateInputRea.value);

        console.log(startDateInputRea.value)
        // Vérifier si la date de début est postérieure à la date de fin
        if (startDate > endDate) {
            alert('La date de début ne peut pas être après la date de fin.');
            startDateInputRea.value = ''; // Réinitialiser la valeur
            startDateInputRea.setAttribute('max', ''); // Réinitialiser l'attribut max
        }
    });

    // Ajouter un écouteur d'événements pour la date de fin
    endDateInputRea.addEventListener('change', function() {
        // Récupérer les valeurs des dates
        const startDate = new Date(startDateInputRea.value);
        const endDate = new Date(endDateInputRea.value);

        // Définir les attributs min et max
        startDateInputRea.setAttribute('max', endDateInputRea.value);
        endDateInputRea.setAttribute('min', startDateInputRea.value);

        // Vérifier si la date de fin est antérieure à la date de début
        if (endDate < startDate) {
            alert('La date de fin ne peut pas être avant la date de début.');
            endDateInputRea.value = ''; // Réinitialiser la valeur
            endDateInputRea.setAttribute('min', ''); // Réinitialiser l'attribut min
        }
    });
</script>
@endsection