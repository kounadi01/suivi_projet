var clientSideDataTable;
function makeClientSideDataTable() {
  clientSideDataTable = $('.data-table').DataTable({
    // "dataSrc": "Data",
    //  "scrollY": 200,
    dom: 'Bfrtip',
    // to limit records
    pageLength: 15,
    "order": [[0, 'asc']],
    lengthMenu: [[10, 25, 50, 100, 1000, -1], [10, 25, 50, 100, 1000, "All"]],
    buttons: [

      'pageLength',
      {
        extend: 'colvis',
        collectionLayout: 'fixed four-column',
        text: 'visibilité des colonnes'
      },
      {
        extend: 'excelHtml5',
        text: 'Exporter en excel',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdfHtml5',
        text: 'Exporter en pdf',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csvHtml5',
        text: 'Exporter en csv',
        exportOptions: {
          columns: ':visible'
        }
      }

    ],
    processing: true,
    serverSide: false,
    scrollY: true,
    "language": {
      "sEmptyTable": "Aucune donnée disponible dans le tableau",
      "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
      "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
      "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
      "sInfoPostFix": "",
      "sInfoThousands": ",",
      "sLengthMenu": "Afficher _MENU_ éléments",
      "sLoadingRecords": "Chargement...",
      "sProcessing": "Traitement...",
      "sSearch": "Rechercher :",
      "sZeroRecords": "Aucun élément correspondant trouvé",
      "oPaginate": {
        "sFirst": "Premier",
        "sLast": "Dernier",
        "sNext": "Suivant",
        "sPrevious": "Précédent"
      },
      "oAria": {
        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
      }
    },
    responsive: true
  });
}
makeClientSideDataTable();