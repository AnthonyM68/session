function editSession(event, url) {
    window.location = url;
}
function editStudent(event, url) {
    window.location = url;
}
function addRemoveButtonListeners() {
    $('.remove-program-collection-widget').click(function (e) {
        e.preventDefault();
        $(this).closest('.programme-field').remove();
    });

    $('.remove-student-collection-widget').click(function (e) {
        e.preventDefault();
        $(this).closest('.student-field').remove();
    });
}
// fonction permettant l'ajout d'un bouton "Supprimer ce module" dans un bloc "programme", et d'enregistrer l'évenement "click" associé
function addDeleteLink($moduleForm) {
    var $removeFormButton = $('<div class="block uk-padding"><button type="button" class="ui-button ui-widget ui-corner-all">Supprimer ce module</button></div>');
    $moduleForm.append($removeFormButton)

    $removeFormButton.on('click', function (e) {
        $moduleForm.remove()
    })
}
// pagination jquery
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
    // Initialiser les onglets jQuery UI
    $("#interface").tabs();
    // Initialiser les onglets Semantic UI
    $('.menu .item').tab();
    // Active la pagination a chaque click sur les onglet tabs
    $('#interface').on('tabsactivate', function (event, ui) {
        setupPagination();
    });
    setupPagination();
    // Ecouteur d'événement sur le bouton supprimer widget
    addRemoveButtonListeners();

});
