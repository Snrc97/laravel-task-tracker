function ClearContainerInput(container) {
    $(container).find('#id').val('');
    $(container).find('input').val('');
    $(container).find('select').val('');
    $(container).find('textarea').val('');
}

function DisplayModal(modalId, callback = null, display = true) {
    $modal = $('#' + modalId);
    ClearContainerInput($modal);
    if(callback)
    {
        callback($modal);
    }
    $modal.modal(display ? 'show' : 'hide');
}
function CreateModal(modalId) {
    DisplayModal(modalId, null, true);
}

function EditModal(endpoint,modalId, row) {
    DisplayModal(modalId, (modal)=> {
        const id = row.id;
        $modal = $(modal);
        $modal.find('#id').val(id);
        console.log($modal);
        FillFormInputs({ mode: 'edit', container: $modal, data: row });
    }, true);
}