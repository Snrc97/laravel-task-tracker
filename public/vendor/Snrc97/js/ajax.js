function ProgressVisibility(visible) {
    $elm = $('.progress-circle-container');
    if (visible) {
        $elm.removeClass("d-none");
    } else {
        $elm.addClass("d-none");
    }

    $elm = null;
}

/**
 *
 * @param {url, type, data, dataType, beforeSendCallback, successCallback, errorCallback, completeCallback} options
 * @returns
 */
function AjaxRequest(options) {
    let csrf = $('meta[name="csrf-token"]').attr('content');

        ProgressVisibility(true);

        if(!options.completeCallback) {
            options.completeCallback = () => {
                ProgressVisibility(false);
            }
        }
        else
        {
            options.completeCallback = () => {
                ProgressVisibility(false);
                options.completeCallback();
            }
        }

    return $.ajax({
        url: options.url,
        type: options.type || 'GET',
        data: options.data || {},
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('access_token') ?? '',
            'X-CSRF-TOKEN': csrf
        },
        dataType: options.dataType || 'json',
        beforeSend: options.beforeSendCallback ?? null,
        success: options.successCallback ?? null,
        error: options.errorCallback ?? null,
        complete: options.completeCallback ?? null
    });
}
