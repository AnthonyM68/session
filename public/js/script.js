function editSession(event, url) {
    window.location = url;
}
function editStudent(event, url) {
    window.location = url;
}

/* jquery tab vertical */
$(function () {
    $("#tabs-active").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
});
$(function () {
    $("#interface").tabs();
});
// Fonction de pagination
function setupPagination() {

    let itemsPerPage = 5;
    let tableRows = $('#table-list tbody tr');
    let pageCount = Math.ceil(tableRows.length / itemsPerPage);
    tableRows.hide().slice(0, itemsPerPage).show();

    $('#pagination').empty(); // Vide les liens de pagination existants

    for (let i = 1; i <= pageCount; i++) {
        $('#pagination').append('<a class="icon item pageNumber" data-page="' + i + '">' + i + '</a>');
    }

    $('.pageNumber').removeClass('active');
    $('.pagination .pageNumber:first').addClass('active');

    $('.pagination .pageNumber').on('click', function () {
        let pageNumber = parseInt($(this).attr('data-page'));
        let startIndex = (pageNumber - 1) * itemsPerPage;
        let endIndex = startIndex + itemsPerPage;
        tableRows.hide().slice(startIndex, endIndex).show();
        $('.pageNumber').removeClass('active');
        $(this).addClass('active');
    });
}
// fonction permettant l'ajout d'un bouton "Supprimer ce module" dans un bloc "programme", et d'enregistrer l'évenement "click" associé
function addDeleteLink($moduleForm) {
    var $removeFormButton = $('<div class="block"><button type="button" class="button">Supprimer ce module</button></div>');
    $moduleForm.append($removeFormButton)

    $removeFormButton.on('click', function (e) {
        $moduleForm.remove()
    })
}
// Fonction permettant l'affichage de la fenêtre modale de confirmation pour chaque situation
function showModalConfirm($id, $href, $title) {
    console.log("id   = " + $id)
    console.log("href = " + $href)
    $('#modalPopup .modal-title').html($title)
    $('#modalPopup .modal-body').html("<span class='center'><i class='fas fa-spinner fa-spin fa-4x'></i></span>")
    $.get(
        "confirm", // La route doit toujours être accessible au moyen du chemin "confirm" dans le contrôleur associé à l'entité concernée 
        {
            'id': $id
        },
        function (resView) {
            $('#modalPopup .modal-body').html(resView)
        }
    )
    $('#modalConfirm').on('click', function (e) {
        window.location.href = $href
    })
    $('#modalPopup').modal('show')
}

$(document).ready(function () {
    $('.menu .item').tab();


    setupPagination();

    // $('#interface').on('tabsactivate', function (event, ui) {
    //     setupPagination();
    // });


    // remove-session.js : fonction permettant de demander la confirmation de suppression d'une session
    $('.remove-session-confirm').on('click', function (e) {
        e.preventDefault()
        let id = $(this).data('id')
        let href = $(this).attr('href')
        showModalConfirm(id, href, "Confirmation de suppression d'une session")
    })
    // remove-stagiaire.js : fonction permettant de demander la confirmation de suppression d'un stagiaire
    $('.remove-stagiaire-confirm').on('click', function (e) {
        e.preventDefault()
        let id = $(this).data('id')
        let href = $(this).attr('href')
        showModalConfirm(id, href, "Confirmation de suppression d'un stagiaire")
    })
    // anonymize-stagiaire.js : fonction permettant de demander la confirmation d'anonymisation d'un stagiaire
    $('.anonymize-stagiaire-confirm').on('click', function (e) {
        e.preventDefault()
        let id = $(this).data('id')
        let href = $(this).attr('href')
        showModalConfirm(id, href, "Confirmation de l'anonymisation d'un stagiaire")
    })


});
