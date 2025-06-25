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
                    'icon' => 'fa fa-tachometer fa-stack-1x',
                ],
                [
                    'title' => __('all.projects.title'),
                    'href' => url('/web/dashboard/projects'),
                    'icon' => 'fa fa-wrench fa-stack-1x',
                ],
                [
                    'title' => __('all.tasks.title'),
                    'href' => url('/web/dashboard/tasks'),
                    'icon' => 'fa fa-tasks fa-stack-1x',
                ],
            ];
        @endphp
        @include('vendor/Snrc97/includes/sidebars/index', ['sidebarItems' => $sidebarItems])
        @yield('dashboard-content')
    </div>
@endsection

@push('scripts')
@endpush
