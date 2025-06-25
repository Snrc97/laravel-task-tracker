function drawDataTable(id, options, customButtons) {
    var defaultOptions = {
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        columnDefs: [{
            targets: 0,
            data: null,
            orderable: false,
            className: 'select-checkbox',
            defaultContent: ''
        }, {
            targets: -1,
            data: null,
            defaultContent: customButtons || '<button class="btn-action">Action</button>'
        }]
    };

    var finalOptions = $.extend(true, {}, defaultOptions, options);

    $('#' + id).DataTable(finalOptions);
}

// Usage
// drawDataTable('exampleTable', {
//     paging: false,
//     searching: false
// }, '<button class="btn-edit">Edit</button><button class="btn-delete">Delete</button>');

