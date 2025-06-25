@extends('vendor.Snrc97.layout.main', ['title' => $title ?? __('all.dashboard.title')])
@push('styles')
@endpush

@section('content')
    <div class="wrapper">
        @php
            $sidebarItems = [
                [
                    'title' => __('all.dashboard.title'),
                    'href' => url('/web/dashboard'),
                ],
                [
                    'title' => __('all.projects.title'),
                    'href' => url('/web/projects'),
                ],
                [
                    'title' => __('all.tasks.title'),
                    'href' => url('/web/tasks'),
                ],
            ];
        @endphp
        @include('vendor/Snrc97/includes/sidebars/index', ['sidebarItems' => $sidebarItems])
        @yield('dashboard-content')
    </div>
@endsection

@push('scripts')
@endpush
