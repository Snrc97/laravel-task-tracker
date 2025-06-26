function drawDataTable(id, options, customButtons) {

    if(options.dataSrc)
    {
        options.dataSrc ??= 'data';
    }

    if(options.ajax)
    {
        options.ajax = {
            url: options.ajax,
            type: 'GET',
            dataSrc: 'data.records',
            'beforeSend' : function (xhr) {
                const token = localStorage.getItem('token');
                console.log(token);
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            error: function (xhr) {
                console.log(xhr.message);
            }
        }
    }

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
            defaultContent: `
                <button class="btn btn-warning"><i class="fa fa-pen fa-stack-1x"></i>Edit</button>
                <button class="btn btn-danger"><i class="fa fa-trash fa-stack-1x"></i>Delete</button>
                ${customButtons || ''}
            `
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

