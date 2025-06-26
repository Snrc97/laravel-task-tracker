@extends('vendor.Snrc97.layout.main', ['title' => __('all.dashboard.title')])
@push('styles')
@endpush

@section('content')

<div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="col-lg-6">
        <form id="login-form" method="POST" action="javascript:void(0)">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('auth.email_label') }}</label>
                <input id="email" type="email" name="email" required autofocus class="form-control" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('auth.password_label') }}</label>
                <input id="password" type="password" name="password" required class="form-control" />
            </div>
            <div class="mb-3 form-check">
                <input id="remember" name="remember" type="checkbox" class="form-check-input" />
                <label for="remember" class="form-check-label">{{ __('auth.remember_me') }}</label>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">{{ __('auth.login') }}</button>
            </div>
            <div class="mb-3">
                <a href="#" class="text-decoration-none">{{ __('auth.forgot_your_password') }}</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')

<script type="text/javascript">

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

</script>
@endpush

