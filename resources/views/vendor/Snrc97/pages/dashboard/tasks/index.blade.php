@extends('vendor.Snrc97.pages.dashboard.index', ['title' => __('all.tasks.title')])
@section('dashboard-content')
    @php
        $columns = [
            [
                'title' => __('all.select'),
                'data' => 'DT_RowIndex',
            ],
            [
                'title' => 'ID',
                'data' => 'id',
            ],
            [
                'title' => __('all.projects.singular'),
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
            [
                'title' => __('all.actions'),
                'data' => 'actions',
            ]
        ];

        $projects = App\Models\ProjectModel::pluck('name', 'id')->toArray();


        $inputs = [

            [
                'title' => __('all.projects.singular'),
                'name' => 'project_id',
                'elementType' => 'select',
                'options' => $projects
            ],
            [
                'title' => __('all.status'),
                'name' => 'status',
                'elementType' => 'switch',

            ],

        ];

    @endphp
    @include('vendor.Snrc97.includes.datatables.index', [
        'columns' => $columns,
        'inputs' => $inputs,
        'ajax' => '/api/dashboard/tasks',
        'title' => __('all.tasks.title'),
    ])
@endsection
