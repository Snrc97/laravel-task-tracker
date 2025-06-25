@extends('vendor.Snrc97.pages.dashboard.index', ['title' => __('all.tasks.title')])
@section('dashboard-content')
    @include('vendor.Snrc97.includes.datatables.index', ['url' => url('/api/tasks')])
@endsection