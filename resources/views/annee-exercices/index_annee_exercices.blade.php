@extends('layouts.app')
@section('titre' , "Liste des année d'exercice" )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Année d'exercice
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
                <a href="#" class="btn btn-primary float-right ml-4" id="createannee-exercice-btn"> <i class="fa fa-plus-circle"></i> Nouvelle année exercice</a>
            </h1>
        </div>
        <div class="card-body">
            @include('annee-exercices.table')
        </div>
    </div>
</div>
@include('annee-exercices.create')
@endsection


@include('partials.main-modal', ['id' => 'showannee'])
@include('partials.main-modal', ['id' => 'editannee'])

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

    // Affichage du formulaire d'enregistrement d'une annee-exercice
    $(document).on('click', '#createannee-exercice-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('annee-exercices.create') !!}";
        $('#createannee-exercice').modal('show');
    });

    // Validation du formulaire d'enregistrement de annee-exercice
    $(document).on('click', '#create-annee-exercice-btn', function(e) {
        $.ajax({
                method: $('#create-annee-exercice-form').attr('method'),
                url: $('#create-annee-exercice-form').attr('action'),
                data: $('#create-annee-exercice-form').serialize()
            })
            .done(function() {
                success("année d'exercice enregistrée avec succès!");
                actualiseTable('#createannee-exercice')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-annee-exercice-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Activer une année exercice
    $(document).on('click', '#activerAnneeExercice', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous activer cette année d'exercice ?", function() {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    success("Année d'exercice activée");
                    actualiseTableDelete()
                },
                error: function(request, status, errors) {
                    error("Impossible d'activer plus de deux année exercice");
                }
            })
        })
    });

    //Activer une année exercice
    $(document).on('click', '#cloturerAnneeExercice', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous cloturer cette année d'exercice ?", function() {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    success("Année d'exercice clôturée");
                    actualiseTableDelete()
                },
                error: function(request, status, errors) {
                    erreur("Impossible de cloturer plus de deux année exercice");
                }
            })
        })
    });

    // affichage du formulaire de modification de profil
    $(document).on('click', '#modifierAnnee', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        //console.log(url);
        $.get(url)
            .done(function(data) {
                //console.log(data);
                $('#editannee .modal-content').html(data);
                $('#editannee').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#edit-annee-btn', function(e) {
        $.ajax({
                method: $('#edit-annee-form').attr('method'),
                url: $('#edit-annee-form').attr('action'),
                data: $('#edit-annee-form').serialize()
            })
            .done(function() {
                success("Année modifiée avec succès!");
                actualiseTable("#editAnnee")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#edit-annee-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });


    // actualisation du tableau des annee-exercices
    function actualiseTable(idModal) {
        var url = "{!! route('annee-exercices.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#annee-exercices-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('annee-exercices.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#annee-exercices-table').html(data);
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