@extends('vendor.Snrc97.pages.dashboard.index', ['title' => __('all.projects.title')])
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
            /*
            [
                'title' => __('all.users.singular'),
                'data' => 'user_id',
            ],
            */
            [
                'title' => __('all.name'),
                'data' => 'name',
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

$users_pluck = App\Models\UserModel::pluck('name', 'id')->toArray();

$inputs = [

            [
                'title' => __('all.users.singular'),
                'name' => 'user_id',
                'elementType' => 'select',
                'options' => $users_pluck
            ],
            [
                'title' => __('all.name'),
                'name' => 'name',
            ],

        ];

    @endphp
    @include('vendor.Snrc97.includes.datatables.index', [
        'columns' => $columns,
        'inputs' => $inputs,
        'ajax' => '/api/dashboard/projects',
        'title' => __('all.projects.title'),
    ])
@endsection
