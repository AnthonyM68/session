function addRemoveButtonListeners() {
    $('.remove-programme-collection-widget').click(function (e) {
        e.preventDefault();
        $(this).closest('.programme-field').remove();
    });

    $('.remove-student-collection-widget').click(function (e) {
        e.preventDefault();
        $(this).closest('.student-field').remove();
    });
}


$(document).ready(function () {

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

    $('.add-another-collection-widget').click(function (e) {
        e.preventDefault();
        let list = $($(this).attr('data-list-selector'));
        let counter = list.data('widget-counter') || list.children().length;
        let newWidget = list.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g, counter);
        counter++;
        list.data('widget-counter', counter);
        let newElem = $(list.attr('data-widget-tags')).html(newWidget);
        newElem.append(`
            <button type="button" class="remove-program-collection-widget uk-button uk-button-danger">
                Supprimer
            </button>
        `);
        newElem.appendTo(list);
        addRemoveButtonListeners();
    });

    $('.add-student-collection-widget').click(function (e) {
        e.preventDefault();
        let list = $($(this).attr('data-list-selector'));
        let counter = list.data('widget-counter') || list.children().length;
        let newWidget = list.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g, counter);
        counter++;
        list.data('widget-counter', counter);
        let newElem = $(list.attr('data-widget-tags')).html(newWidget);
        newElem.append(`
            <button type="button" class="remove-program-collection-widget uk-button uk-button-danger">
                Supprimer
            </button>
        `);
        newElem.appendTo(list);
        addRemoveButtonListeners();
    });

    addRemoveButtonListeners();

});