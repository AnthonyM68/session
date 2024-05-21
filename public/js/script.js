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

    // Scripts jQuery / JavaScript généraux


    // add-collection-widget.js : fonction permettant d'ajouter un nouveau bloc "programme" au sein d'une session (pour agrandir la collection)
    $('.add-student-collection-widget').click(function (e) {


        let list = $($(this).attr('data-list-selector'))
        console.log(list);
        // Récupération du nombre actuel d'élément "programme" dans la collection (à défaut, utilisation de la longueur de la collection)
        let counter = list.data('widget-counter') || list.children().length
        // Récupération de l'identifiant de la session concernée, en cours de création/modification
        let session = list.data('session')
        // Extraction du prototype complet du champ (que l'on va adapter ci-dessous)
        let newWidget = list.attr('data-prototype')
        // Remplacement des séquences génériques "__name__" utilisées dans les parties "id" et "name" du prototype
        // par un numéro unique au sein de la collection de "programmes" : ce numéro sera la valeur du compteur
        // courant (équivalent à l'index du prochain champ, en cours d'ajout).
        // Au final, l'attribut ressemblera à "session[programmes][n°]"
        newWidget = newWidget.replace(/__name__/g, counter)
        // Ajout également des attributs personnalisés "class" et "value", qui n'apparaissent pas dans le prototype original 
        newWidget = newWidget.replace(/><input type="hidden"/, ' class="borders"><input type="hidden" value="' + session + '"')
        // Incrément du compteur d'éléments et mise à jour de l'attribut correspondant
        counter++
        list.data('widget-counter', counter)
        // Création d'un nouvel élément (avec son bouton de suppression), et ajout à la fin de la liste des éléments existants
        let newElem = $(list.attr('data-widget-tags')).html(newWidget)
        addDeleteLink($(newElem).find('div.borders'))
        newElem.appendTo(list)
    })
    // anonymize-collection-widget.js : fonction permettant de supprimer un bloc "programme" existant au sein d'une session
    $('.remove-collection-widget').find('div.borders').each(function () {
        addDeleteLink($(this))
    })






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
