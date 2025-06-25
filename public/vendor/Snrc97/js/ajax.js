function Progress() {
    return ``;
}

/**
 *
 * @param {url, type, data, dataType, beforeSendCallback, successCallback, errorCallback, completeCallback} options
 * @returns
 */
function AjaxRequest(options) {
    return $.ajax({
        url: options.url,
        type: options.type || 'GET',
        data: options.data || {},
        dataType: options.dataType || 'json',
        beforeSend: options.beforeSendCallback ?? null,
        success: options.successCallback ?? null,
        error: options.errorCallback ?? null,
        complete: options.completeCallback ?? null
    });
}
