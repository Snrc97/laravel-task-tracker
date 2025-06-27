var table = null;
function drawDataTable(id, options, customButtons) {

    if(options.dataSrc)
    {
        options.dataSrc ??= 'data';
    }

    table = $('#' + id).DataTable();

    table.destroy();





    const modalId = id.replace('Datatable', 'Modal');

    options = {

        ...options,
        responsive: true,
        serverSide: true,
        processing: true,
        deferRender: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },


        columnDefs: [
            {
                targets: '_all',
                className: "all dt-center",
            },
            {
                targets: [0],
                orderable: false,
                defaultContent: '<input type="checkbox" class="form-check-input" />',
            },
            {
                targets: [options.columns.length-1],
                orderable: false,
                defaultContent: ``,
                render: function (data, type, row, meta) {
                    const row_json = JSON.stringify(row);
                    return `
                    <div class="btn-group px-2">
                        <button class="dt-row-btn btn btn-warning" onclick='EditModal("${modalId}", ${row_json})'><i class="fa fa-pencil mr-1"></i></button>
                        <button class="dt-row-btn btn btn-danger" onclick='DeleteModal("${modalId}", ${row_json})'><i class="fa fa-trash mr-1"></i></button>
                    </div>
                    `;
                },
            }
        ],


    };

    if(options.ajax)
    {
        options.ajax = {
            url: options.ajax,
            type: 'GET',
            dataSrc: 'data',
            beforeSend : function (xhr) {
                const token = localStorage.getItem('token');
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            complete: function (xhr) {
                const response = xhr.responseJSON;
            },
            error: function (xhr) {
                console.error(xhr.message);
            },

        }
    }


    table = $('#' + id).DataTable(options);


}

// Usage
// drawDataTable('exampleTable', {
//     paging: false,
//     searching: false
// }, '<button class="btn-edit">Edit</button><button class="btn-delete">Delete</button>');

