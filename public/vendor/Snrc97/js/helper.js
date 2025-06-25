function ClearContainerInput(container) {
    $(container).find('#id').val('');
    $(container).find('input').val('');
    $(container).find('select').val('');
    $(container).find('textarea').val('');
}

function DisplayModal(modal, display = true) {
    ClearContainerInput(modal);
    $(modal).modal(display ? 'show' : 'hide');
}