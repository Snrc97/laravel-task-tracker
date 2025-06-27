function FillFormInputs({ mode, container, data }) {
    $.each(
        data,
        function (key, value) {

            if(key == "json_props")
            {

                let sub_data = [value];

                FillFormInputs({ mode, container, data: sub_data });

                return;
            }

            console.log(key,data);
            const input = $(container).find(`input[name="${key}"]`);
            const input_select = $(container).find(`select[name="${key}"]`);
            const input_bladewind_select = $(container).find(`.bw-select input[name="${key}"]`);

            const input_textarea = $(container).find(`textarea[name="${key}"]`);

            if ($(input_textarea).length > 0) {
                $(input_textarea).val(value);


            } else if ($(input_select).length > 0) {
                input_select.val(value).trigger("change");
            } else if ($(input_bladewind_select).length > 0) {

                input_bladewind_select.val(value).trigger("change");
                const input_bladewind_select_element = eval("bw_"+key);


                if(input_bladewind_select_element.totalItems() > 0)
                {
                    input_bladewind_select_element.selectByValue(value);
                }
            }
            else if (input.is(":checkbox")) {
                const valMap = value == 1 || value == true ? true : false;
                input.prop("checked", valMap);
            } else if (input.is(":radio")) {
                input.filter(`[value="${value}"]`).prop("checked", true);
            } else {
                let input_type = $(input).prop("type");
                if(input_type == "date")
                {
                    value = moment(value).format("YYYY-MM-DD");
                }
                input.val(value);
            }

            input.prop("disabled", false);
            input_select.prop("disabled", false);
            $(container).find(".modal-footer").prop("hidden", false);

            if (mode == "detail") {
                input.prop("disabled", true);
                input_select.prop("disabled", true);
                $(container).find(".modal-footer").prop("hidden", true);
            }
        },
        [mode, data]
    );
}

async function FillSelectOptions({ type, selectElement, url, options }) {
    if (!options && url) {
        options = await AjaxGet({ url, notify: "none" }).then((x) => x.data);
    }
    if (options) {
        if(type == "select")
        {

            console.log(options);
                // Use the provided options array to fill the select element
                options.forEach((option) => {
                    $(selectElement).append(
                        $("<option>", { value: option.id ?? option.value, text: option.name ?? option.text })
                    );
                });

        }

        else if(type == "bladewind-select")
        {
            options = options.map(x => {
                return {
                    value: x.id ?? x.value,
                    label: x.name ?? x.text
                }
            });
            populateBladewindSelect(options, selectElement);
        }
    }
}

async function handleLogoutFormSubmit(e) {
    e.preventDefault();
    let options = {
        url: "/api/auth/logout",
        type: 'POST',
        successCallback: (xhr) => {
            localStorage.removeItem('token');
            alert(xhr.message);
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    }
    await AjaxRequest(options);
}


async function handleSubmitForm(form,url, completedCallback = null) {

    const id = $(form).find('#id').val();
    if(id != "") {
        url = url + '/' +id;
    }
    const type = id == "" ? "POST" : "PUT";

    const formData = new FormData(form);
    const data = formDataToData(formData);
    let options = {
        url: url,
        type: type,
        data: data,
        successCallback: (xhr) => {
            alert(xhr.message);
            setTimeout(() => {
                table?.ajax.reload();
                if(completedCallback)
                {
                    completedCallback();
                }
            }, 1000);
        }
    }
    await AjaxRequest(options);
    document.dispatchEvent(new CustomEvent('dataUpdated'));
}

