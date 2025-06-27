var table = null;
function drawDataTable(id, options, customButtons) {

    if(options.dataSrc)
    {
        options.dataSrc ??= 'data';
    }

    table = $('#' + id).DataTable();

    table.destroy();







    var defaultOptions = {
        responsive: true,
        serverSide: true,
        processing: true,
        deferRender: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },




    };


    options = {
        ...options,

        columnDefs: [
            {
                targets: '_all',
                className: "all dt-center",
            },

        ],
    }


    var finalOptions = $.extend(true, {}, defaultOptions, options);
    if(finalOptions.ajax)
    {
        finalOptions.ajax = {
            url: finalOptions.ajax,
            type: 'GET',
            dataSrc: 'data',
            beforeSend : function (xhr) {
                const token = localStorage.getItem('token');
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            complete: function (xhr) {
                const response = xhr.responseJSON;
                console.log(response);
            },
            error: function (xhr) {
                console.log(xhr.message);
            },

        }
    }


    table = $('#' + id).DataTable(finalOptions);
    // table.columns.adjust().draw();

}

// Usage
// drawDataTable('exampleTable', {
//     paging: false,
//     searching: false
// }, '<button class="btn-edit">Edit</button><button class="btn-delete">Delete</button>');

