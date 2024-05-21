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

$(document).ready(function () {
    $('.menu .item').tab();


    setupPagination();

    // $('#interface').on('tabsactivate', function (event, ui) {
    //     setupPagination();
    // });

});
