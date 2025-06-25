@extends('vendor.Snrc97.layout.main', ['title' => __('all.dashboard.title')])
@push('styles')
@endpush

@section('content')

<div class="container-fluid d-flex justify-content-center">
    <div class="col-md-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('auth.login') }}</label>
                <input id="email" type="email" name="email" required autofocus class="form-control" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('auth.password') }}</label>
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
                <a href="{{ route('password.request') }}" class="text-decoration-none">{{ __('auth.forgot_your_password') }}</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
@endpush

