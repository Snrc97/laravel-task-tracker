let csrf = null;

function ProgressVisibility(visible) {
    $elm = $(".progress-circle-container");
    if (visible) {
        $elm.removeClass("d-none");
    } else {
        $elm.addClass("d-none");
    }

    $elm = null;
}

function formDataToData(formData) {

    return Object.fromEntries(formData.entries());
}

/**
 *
 * @param {url, type, data, dataType, beforeSendCallback, successCallback, errorCallback, completeCallback} options
 * @returns
 */
function AjaxRequest(options) {
    const _csrf = csrf ?? options?.headers?.csrf ?? $('meta[name="csrf-token"]').attr("content");

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

            if (!file_upload && typeof options.data === "object") {
            } else {
                options.contentType = false;
                options.data = { ...options.data, _token: _csrf };
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
            Authorization: "Bearer " + localStorage.getItem("access_token") ?? "",
            "X-CSRF-TOKEN": _csrf,
            "cache-control": "no-cache",
            withCredentials: true,
            ...(options.headers || {}),
        },
        dataType: options.dataType || "json",
        beforeSend: options.beforeSendCallback ?? null,
        success: options.successCallback ?? null,
        error: options.errorCallback ?? null,
        complete: options.completeCallback ?? null,
    });
}

$( async () => {
    csrf = await AjaxRequest({
        url: "/sanctum/csrf-cookie",

    }).then(xhr => xhr.csrf_token);
});
