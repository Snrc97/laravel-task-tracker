function ClearContainerInput(container) {
    $(container).find('#id').val('');
    $(container).find('input').val('');
    $(container).find('select').val('');
    $(container).find('textarea').val('');
}

function DisplayModal(modalId, display = true) {
    $modal = $('#' + modalId);
    ClearContainerInput($modal);
    $modal.modal(display ? 'show' : 'hide');
}