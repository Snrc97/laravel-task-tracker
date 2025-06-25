<table id="{{ $id }}" class="display" style="width:100%">
    <thead>
    <tr>
        @foreach($columns as $column)
            <th>{{ $column['title'] }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    <script>
        drawDataTable('{{ $id }}', {
            @if(isset($ajax))
            ajax: '{{ $ajax }}',
            @endif
            columns: [
                @foreach($columns as $index => $column)
                {data: '{{ $column['data'] }}', title: '{{ $column['title'] }}' @if(isset($column['visible'])) , visible: {{ $column['visible'] ? 'true' : 'false' }} @endif},
                @endforeach
            ],
            @if(isset($paging))
            paging: {{ $paging ? 'true' : 'false' }},
            @endif
            @if(isset($searching))
            searching: {{ $searching ? 'true' : 'false' }},
            @endif
            @if(isset($ordering))
            ordering: {{ $ordering ? 'true' : 'false' }},
            @endif
            @if(isset($info))
            info: {{ $info ? 'true' : 'false' }},
            @endif
            customButtons: '{{ $customButtons ?? '' }}',
        });
    </script>
@endpush
