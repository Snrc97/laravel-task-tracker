@php
    $id ??= $title . 'Datatable';
@endphp
<table id="{{ $id }}" class="display" style="width:100%">
    <thead>
        <tr>
            @foreach ($columns as $column)
                <th>{{ $column['title'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('modals')
    @include('vendor.Snrc97.includes.modals.index', ['title' => $title, 'inputs' => $columns, 'url' => $ajax ?? null])
@endpush

@push('scripts')
    <script>
        drawDataTable('{{ $id }}', {
            @if (isset($ajax))
                ajax: '{{ $ajax }}',
            @endif
            columns: [
                @foreach ($columns as $index => $column)
                    {
                        data: '{{ $column['data'] }}',
                        title: '{{ $column['title'] }}'
                        @if (isset($column['visible']))
                            , visible: {{ $column['visible'] ? 'true' : 'false' }}
                        @endif
                        @if (isset($column['render']))
                            , render: (data, type, row, meta) => {
                                let rendit = '{!! $column['render'] ?? "" !!}';

                                return '<div align="center">' + rendit + '</div>';
                            }
                        @endif
                    },
                @endforeach
            ],
            @if (isset($paging))
                paging: {{ $paging ? 'true' : 'false' }},
            @endif
            @if (isset($searching))
                searching: {{ $searching ? 'true' : 'false' }},
            @endif
            @if (isset($ordering))
                ordering: {{ $ordering ? 'true' : 'false' }},
            @endif
            @if (isset($info))
                info: {{ $info ? 'true' : 'false' }},
            @endif
            customButtons: '{{ $customButtons ?? '' }}',
        });
    </script>
@endpush
