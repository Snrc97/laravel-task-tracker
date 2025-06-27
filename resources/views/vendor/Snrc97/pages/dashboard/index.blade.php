@php
$title = "Project Task Tracker - " . __('all.dashboard.title');
@endphp
@extends('vendor.Snrc97.layout.main', ['title' => $title])
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
                [
                    'title' => 'GitHub',
                    'href' => env('GITHUB_URL', 'https://github.com/Snrc97/Project-Task-Tracker'),
                    'icon' => 'fa-brands fa-github fa-stack-1x',
                ],
            ];
        @endphp
        @include('vendor/Snrc97/includes/sidebars/index', ['sidebarItems' => $sidebarItems])
        <div class="container-fluid">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <h1>
                        {{ $title }}
                    </h1>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
@endpush
