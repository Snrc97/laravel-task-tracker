
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


async function handleSubmit(e,url) {

    const formData = new FormData(e.target);
    const data = formDataToData(formData);
    let options = {
        url: url,
        type: 'POST',
        data: data,
        successCallback: (xhr) => {
            alert(xhr.message);
            setTimeout(() => {
                table?.ajax.reload();
            }, 1000);
        }
    }
    await AjaxRequest(options);
}