<div class="wrapper">
    @php
    $sidebarItems = [
        [
            'title' => __('all.dashboard.title'),
            'href' => route('dashboard'),
        ],
        [
        'title' => __('all.projects.title'),
        'href' => route('projects.index'),
        ],
        [
            'title' => __('all.tasks.title'),
            'href' => route('tasks.index'),
        ],
    ]
    @endphp
    @include('vendor/Snrc97/includes/sidebar/index', compact('sidebarItems'))
</div>