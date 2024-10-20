@extends('layouts.app')
@section('titre' , 'Liste approvisionnement' )
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Nouveau
    </a>
</li>
@endsection

@section('main')
<div class="content col-sm-10" style="margin-left: auto;margin-right: auto;">
    <div class="card card-primary">
        <div class="card-header bg-light">
            <div class="row float-left" style="width: 100px;border:2px double blue;color: white">
                <select class="form-control" name="annee" id="annee" onChange="getFiltre(this.value);">
                    <option value="{{\App\Models\AnneeExercice::anneeActive()->id}}">{{\App\Models\AnneeExercice::anneeActive()->annee_exercice}}</option>
                    <!-- @foreach(\App\Models\AnneeExercice::all() as $annee )
                    <option style="" value="{{$annee ->id}}" @if ($annee->id == $ae)
                        selected
                        @endif
                        >

                        {{$annee->annee_exercice}}
                    </option>
                    @endforeach -->
                </select>
                <small class="text-danger" id="anneeSpan"> </small>
            </div>

            <div class="row float-left" style="width: 200px;border:2px double blue;color: white;margin-left: 10px;">
                <select class="form-control" name="type" id="type" onChange="getFiltre(this.value);">
                    <option value="tout" @if ($type=="tout" ) selected @endif>Tout</option>
                    <option value="service" @if ($type=="service" ) selected @endif>Service</option>
                    <option value="bien" @if ($type=="bien" ) selected @endif>Bien</option>
                </select>
                <small class="text-danger" id="typeSpan"> </small>
            </div>
            {{--@if(!\App\Models\User::authUserProfil()->nom=='Responsable' || !\App\Models\User::authUserProfil()->nom=='Administrateur' )--}}
            <h1 class="row float-right">
                <a href="{!! route('reponses.index') !!}" class="btn btn-primary float-right ml-4"> <i class="fa fa-plus-circle"></i> Retour</a>
            </h1>
            {{--@endif--}}
        </div>
        <div class="card-body">
            <div class="form-group col-sm-12">
                <!-- <form method="POST" enctype="multipart/form-data" accept-charset="UTF-8" class="main-form" role="form" action="{!! route('reponses.envoyer',['option'=>'create']) !!}"> -->
                {!! csrf_field() !!}
                <div class="card-body">
                    @include('reponse.fields')
                </div>

                <!-- <div class="card-footer " style="float: right;">
                    <button type="submit" class="btn btn-success">Valider</button>

                </div> -->
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
@endsection

@include('partials.main-modal', ['id' => 'createProg'])
@include('partials.main-modal', ['id' => 'showProg'])
@include('partials.main-modal', ['id' => 'editProg'])

@section('scripts')
<script>
    function ajouterLigne() {
        var table = document.getElementById('tableEditable');
        var newRow = table.insertRow(table.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);

        var select = document.createElement('select');
        select.innerHTML = `
        @foreach ($options as $produit)
            <option value="{{ $produit->id }}">{{ $produit->libelle }}</option>
        @endforeach
      `;

        console.log(select);
        cell1.appendChild(select);

        cell2.contentEditable = "true";
        cell3.contentEditable = "true";
        cell4.contentEditable = "true";
    }

    function sauvegarderDonnees() {
        // Récupérer le jeton CSRF du tag meta dans le HTML
        console.log('csrf-token', document.getElementsByName('csrf-token')[0].getAttribute('content'))
        //const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');

        var table = document.getElementById('tableEditable');
        var table1 = document.getElementById('tableEditable1');
        var data = [];
        var url = '/reponses';

        var annee = $('#annee').val();

        for (var i = 1; i < table.rows.length; i++) {
            if (table.rows[i].cells.length > 5) {
                var rowData = {
                    //produit_id: table.rows[i].cells[0].querySelector('select').value,
                    liste_produit_id: table.rows[i].cells[0].innerText,
                    produit: table.rows[i].cells[1].innerText,
                    produit: table.rows[i].cells[2].innerText,
                    taux: table.rows[i].cells[3].innerText,
                    montant_total: table.rows[i].cells[4].innerText,
                    montant_local: table.rows[i].cells[5].innerText,
                    produit_id: table.rows[i].cells[7].innerText
                };
                data.push(rowData);
            }
        }

        for (var i = 1; i < table1.rows.length; i++) {
            if (table1.rows[i].cells.length > 5) {
                var rowData = {
                    //produit_id: table.rows[i].cells[0].querySelector('select').value,
                    liste_produit_id: table1.rows[i].cells[0].innerText,
                    produit: table1.rows[i].cells[1].innerText,
                    produit: table1.rows[i].cells[2].innerText,
                    taux: table1.rows[i].cells[3].innerText,
                    montant_total: table1.rows[i].cells[4].innerText,
                    montant_local: table1.rows[i].cells[5].innerText,
                    produit_id: table1.rows[i].cells[7].innerText
                };
                data.push(rowData);
            }
        }

        console.log(data);
        // Envoi des données au backend (ici, on utilise une requête HTTP POST)
        fetch('/admin/reponse/store?ae=' + annee, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    //'X-CSRF-TOKEN': 'GK0UgNhH30LQpgx2Uk5uGKH5QfCnqNEwSmwDASx5', // Ajouter le jeton CSRF ici
                },
                body: JSON.stringify(data),
            })
            // .then(response => response.json())
            .then(data => {
                console.log('Réponse du serveur:', data);
                // Ajouter tout code de gestion de réponse ici
                document.location.href = url;
            })
            .catch((error) => {
                console.error('Erreur :', error);
            });
    }

    document.getElementById('tableEditable').addEventListener('input', function(e) {
        if (e.target && e.target.nodeName === 'TD') {
            console.log('Cellule éditée :', e.target.innerText);
            // Tu peux ajouter d'autres actions ici, comme sauvegarder les changements dans une base de données
            var row = e.target.parentNode;
            console.log('Ligne :', row);
            row.cells[5].innerText = row.cells[4].innerText * (row.cells[3].innerText / 100)

            var table = document.getElementById('tableEditable');
            var total = document.getElementById('total');
            var result = 0

            for (var i = 1; i < table.rows.length; i++) {
                result += parseInt(table.rows[i].cells[4].innerText)
            }

            total.value = parseInt(result)
        }
    });

    document.getElementById('tableEditable1').addEventListener('input', function(e) {
        if (e.target && e.target.nodeName === 'TD') {
            console.log('Cellule éditée :', e.target.innerText);
            // Tu peux ajouter d'autres actions ici, comme sauvegarder les changements dans une base de données
            var row = e.target.parentNode;
            console.log('Ligne :', row);
            row.cells[5].innerText = row.cells[4].innerText * (row.cells[3].innerText / 100)

            var table = document.getElementById('tableEditable1');
            var total = document.getElementById('total');
            var result = 0

            for (var i = 1; i < table.rows.length; i++) {
                result += parseInt(table.rows[i].cells[4].innerText)
            }

            total.value = parseInt(result)
        }
    });

    function getOption(val) {
        val = $('#type').val();
        console.log(val)
        $.ajax({
            type: "GET",
            url: "{{ route('reponses.getOption') }}",
            data: {
                type: val,
            },
            success: function(data) {
                var table = document.getElementById('tableEditable');
                var newRow = table.insertRow(table.rows.length);
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                var cell4 = newRow.insertCell(3);
                // var cell5 = newRow.insertCell(4);
                var cell6 = newRow.insertCell(4);

                var select = document.createElement('select');
                select.addEventListener('change', function() {
                    console.log(select)
                    getProduit(this);
                });
                select.innerHTML = data;

                // console.log(select);

                cell1.appendChild(select);

                cell2.contentEditable = "false";
                cell3.contentEditable = "true";
                // cell4.contentEditable = "true";

                // var inputNumber = document.createElement('input');
                // inputNumber.type = 'number'; // Ajoutez l'attribut type="number"
                // inputNumber.value = ''; // Vous pouvez initialiser la valeur si nécessaire
                // cell3.appendChild(inputNumber);
                // cell4.appendChild(inputNumber);

                var deleteButton = document.createElement('button');
                deleteButton.innerText = 'Supprimer';
                deleteButton.className = 'btn btn-danger';
                deleteButton.onclick = function() {
                    supprimerLigne(this);
                };
                cell6.appendChild(deleteButton);
            }
        });
    }

    function supprimerLigne(button) {
        console.log(button);
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    function getProduit(select) {
        var optionsSelect = select.parentNode.nextElementSibling.querySelector('select');
        var selectedCategory = select.value;

        var total = document.getElementById('total');
        ae = $('#annee').val();

        console.log(selectedCategory);
        $.ajax({
            type: "GET",
            url: "{{ route('reponses.getProduit') }}",
            data: {
                produit_id: selectedCategory,
                ae: ae
            },
            success: function(data) {
                console.log(data);
                var row = select.parentNode.parentNode;
                console.log("Ligne", row);

                row.cells[1].innerHTML = data['exploration']
                // row.cells[2].innerText = data['prix_connu']
                // row.cells[3].innerText = 1
                // row.cells[4].innerText = data['prix_connu']
                // total.value = data['prix_connu']

                // document.getElementById('PondereTache').value = data['niveau_execution'];
            }
        });
    }

    function getFiltre() {
        var annee_id = $('#annee').val();
        var type = $('#type').val();
        document.location.href = "{{asset('/reponses/create')}}?ae=" + annee_id + "&ty=" + type;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ID de l'élément à activer
        var activeId = 'non'; // Par exemple, activez l'élément "À propos"

        // Retirer la classe 'active' de tous les éléments nav-item
        // var navItems = document.querySelectorAll('.nav-item');
        // navItems.forEach(function(item) {
        //     item.classList.remove('active');
        // });

        // Ajouter la classe 'active' à l'élément souhaité
        var activeElement = document.getElementById(activeId);
        if (activeElement) {
            activeElement.classList.remove('active');
        }
    });
</script>
@endsection