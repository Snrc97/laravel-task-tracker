
async function handleLoginFormSubmit(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = formDataToData(formData);
    let options = {
        url: "{{ route('api.login') }}",
        type: 'POST',
        data: data,
        headers : {
            'X-CSRF-TOKEN': csrf
        },
        successCallback: (xhr) => {
            let token = xhr.data.records.token;
            localStorage.setItem('token', token);
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    }
    await AjaxRequest(options);

}

$(()=>{
    $('#login-form').on('submit', (e) => handleLoginFormSubmit(e));
});
