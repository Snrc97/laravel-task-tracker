
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
