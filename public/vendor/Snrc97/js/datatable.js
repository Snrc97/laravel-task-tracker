
var table = null;

document.addEventListener('dataUpdated', (event) => {
    table.ajax.reload( null, false );
});

function drawDataTable(id, options, customButtons) {

    if(options.dataSrc)
    {
        options.dataSrc ??= 'data';
    }

    table = $('#' + id).DataTable();

    table.destroy();





    const modalId = id.replace('Datatable', 'Modal');

    const ajax_url = options.ajax;


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
                defaultContent: '<input type="checkbox" class="form-check-input p-0 m-0 position-relative" />',
            },
            {
                targets: [options.columns.length-1],
                orderable: false,
                defaultContent: ``,
                render: function (data, type, row, meta) {
                    const endpoint = ajax_url + '/' + row.id;
                    const row_json = JSON.stringify(row);

                    return `
                    <div class="btn-group px-2">
                        <button class="dt-row-btn btn btn-warning" onclick='EditModal("${endpoint}", "${modalId}", ${row_json})'><i class="fa fa-pencil mr-1"></i></button>
                        <button class="dt-row-btn btn btn-danger" onclick='DataTableRowDelete("${endpoint}")'><i class="fa fa-trash mr-1"></i></button>
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


async function DataTableRowDelete(endpoint) {
    const res = await AjaxRequest({ url: endpoint, type: "DELETE"});
    document.dispatchEvent(new CustomEvent('dataUpdated'));
}

// Usage
// drawDataTable('exampleTable', {
//     paging: false,
//     searching: false
// }, '<button class="btn-edit">Edit</button><button class="btn-delete">Delete</button>');

