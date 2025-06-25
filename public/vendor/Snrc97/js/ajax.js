function ProgressVisibility(visible) {
    $elm = $(".progress-circle-container");
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
    let csrf = $('meta[name="csrf-token"]').attr("content");

    ProgressVisibility(true);

    let file_upload = false;
    if (options.file_upload) {
        file_upload = options.file_upload;
        delete options.file_upload;
    }

    if (!options.completeCallback) {
        options.completeCallback = () => {
            ProgressVisibility(false);
        };
    } else {
        options.completeCallback = () => {
            ProgressVisibility(false);
            options.completeCallback();
        };
    }

    switch (options.type) {
        case "POST":
            options = {
                ...options,
                processData: false,
                contentType: "application/json",
            };

            if (!file_upload) {
                options.data = JSON.stringify(options.data);
            } else {
                options.contentType = false;
                options.data = { ...options.data, _token: csrf };
            }

            break;
        case "GET":
            break;
        case "PUT":
            // delete options.cache;
            options = {
                ...options,
                processData: false,
                contentType: "application/json",
            };

            options.data = JSON.stringify(options.data);

            break;
        case "DELETE":
            delete options.data;
            break;
    }

    // console.log("options", options);

    return $.ajax({
        url: options.url,
        type: options.type || "GET",
        data: options.data || {},
        headers: {
            Authorization:
                "Bearer " + localStorage.getItem("access_token") ?? "",
            "X-CSRF-TOKEN": csrf,
        },
        dataType: options.dataType || "json",
        beforeSend: options.beforeSendCallback ?? null,
        success: options.successCallback ?? null,
        error: options.errorCallback ?? null,
        complete: options.completeCallback ?? null,
    });
}
