function showLoader() {
    HoldOn.open({
        theme: "sk-circle",
        message: "<h4>Veuillez patienter</h4>"
    });
}

function closeLoader() {
    HoldOn.close();
}

function success(message) {
    swal(
            'L\'opération est un succès!',
            message,
            'success'
        );
}

function error(message) {
    swal(
            'Echec!',
            message,
            'error'
            );
}

function fetchAjaxOptions(path, selector, options) {
    $.get(path, function (data) {
        $(selector).html(data);
        if (options && options.callback) {
            options.callback();
        }
    });
}

var ajaxFormHandlerSuccessCallback = null;

function question(message, yesCallback, noCallback) {

    swal({
        title: 'Confirmation',
        text: message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.value) {
            yesCallback();

        } else if (result.dismiss === swal.DismissReason.cancel) {
            if (noCallback)
                noCallback();
        }
    })
}

function yesOrNoQuestion(title, message, yesCallback, noCallback) {

    swal({
        title: title,
        text: message,
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'
    }).then((result) => {
        if (result.value) {
            yesCallback();

        } else if (result.dismiss === swal.DismissReason.cancel) {
            if (noCallback)
                noCallback();
        }
    });
}

function choixQuestion(title, message, yesCallback, noCallback) {

    swal({
        title: title,
        text: message,
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'
    }).then((result) => {
        if (result.value) {
            yesCallback();

        } else if (result.dismiss === swal.DismissReason.cancel) {
            if (noCallback)
                noCallback();
        }
    });
}

function applyDatePickers() {
    createDatePicker('.date-picker');
}

function createDatePicker(selector, callback) {
    // var formats ={
    //     "fr-FR" : "mm-dd-yy",formats[navigator.language] ||
    // }
    var options = {
        dateFormat: 'yy-mm-dd'
    };
    if(callback) {
        options.beforeShowDay = callback;
    }
    $(selector).datepicker(options);
    $(selector).datepicker( "option", $.datepicker.regional['fr-CA']);
}

// function applyDatePickers() {
//     $('.date-picker').datepicker({
//         dateFormat: 'yy-mm-dd',
//         dayNamesMin: [
//             "Lun",
//             "Mar",
//             "Mer",
//             "Jeu",
//             "Ven",
//             "Sam",
//             "Dim"
//         ],
//         monthNames: [
//             'Janvier',
//             'Février',
//             'Mars',
//             'Avril',
//             'Mai',
//             'Juin',
//             'Juillet',
//             'Août',
//             'Septembre',
//             'Octobre',
//             'Novembre',
//             'Décembre'
//         ]

//     });
// }

// function createDatePicker(selector, callback) {
//     var options = {
//         dateFormat: 'yy-mm-dd',
//         dayNamesMin: [
//             "Lun",
//             "Mar",
//             "Mer",
//             "Jeu",
//             "Ven",
//             "Sam",
//             "Dim"
//         ],
//         monthNames: [
//             'Janvier',
//             'Février',
//             'Mars',
//             'Avril',
//             'Mai',
//             'Juin',
//             'Juillet',
//             'Août',
//             'Septembre',
//             'Octobre',
//             'Novembre',
//             'Décembre'
//         ]

//     };
//     if(callback) {
//         options.beforeShowDay = callback;
//     }
//     $(selector).datepicker(options);
// }

function syntaxHighlight(json) {
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}