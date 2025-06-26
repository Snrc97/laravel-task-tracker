@extends('vendor.Snrc97.pages.dashboard.index', ['title' => __('all.tasks.title')])
@section('dashboard-content')
    @php
        $columns = [
            [
                'title' => 'ID',
                'data' => 'id',
            ],
            [
                'title' => __('all.projects.title'),
                'data' => 'project_id',
            ],
            [
                'title' => __('all.status'),
                'data' => 'status',
            ],
            [
                'title' => __('all.created_at'),
                'data' => 'created_at',
            ],
            [
                'title' => __('all.updated_at'),
                'data' => 'updated_at',
            ],
        ];

        $inputs = collect($columns)->only(1, 2)->toArray();
    @endphp
    @include('vendor.Snrc97.includes.datatables.index', [
        'columns' => $columns,
        'inputs' => $inputs,
        'ajax' => '/api/dashboard/tasks',
        'title' => __('all.tasks.title'),
    ])
@endsection
