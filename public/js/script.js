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


$(document).ready(function () {
    $('.menu .item').tab();

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
    /**
     * Pagination jquery
     *
     */

    // // éléments par page
    // let itemsPerPage = 5;
    // let tableRows = $('#table-list tbody tr');

    // // calcul le nombre de pages selon taille / itemsPerPage
    // let pageCount = Math.ceil(tableRows.length / itemsPerPage);

    // // Afficher les éléments de la première page initialement
    // tableRows.hide().slice(0, itemsPerPage).show();

    // // liens de pagination
    // for (let i = 1; i <= pageCount; i++) {
    //     $('#pagination').append('<a class="icon item pageNumber" data-page="' + i + '">' + i + '</a>');
    // }

    // // Mettre en surbrillance le numéro de la première page au chargement
    // $('.pageNumber').removeClass('active');
    // $('.pagination .pageNumber:first').addClass('active');

    // // ecouteur d'événement au click
    // $('.pagination .pageNumber').on('click', function () {
    //     // on récupère le numéro de page et on le parse
    //     let pageNumber = parseInt($(this).attr('data-page'));
    //     // on retire 1 pour correspondre a l'indice tableRows * nombre item par page
    //     let startIndex = (pageNumber - 1) * itemsPerPage;
    //     // calcul l'item de fin
    //     let endIndex = startIndex + itemsPerPage;
    //     // Masquer tous les éléments et afficher ceux de la page sélectionnée
    //     tableRows.hide().slice(startIndex, endIndex).show();

    //     // focus sur le numéro de page actif
    //     $('.pageNumber').removeClass('active');
    //     $(this).addClass('active');
    // });

    // Appeler la fonction de pagination chaque fois qu'un onglet est activé
    $('#interface').on('tabsactivate', function(event, ui) {
        setupPagination();
    });

});
