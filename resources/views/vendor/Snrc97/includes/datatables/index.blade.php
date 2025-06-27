@php
    $id ??= $title . 'Datatable';
    $modalId = $title . 'Modal';
@endphp

    <div class="row">
        <div class="col-6">
            <h3>{{ $title }} Tablosu</h3>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <button type="button" class="btn btn-dark" onclick="CreateModal('{{ $modalId }}')" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                <i class="fa fa-plus"></i> {{ __('all.add') }}
            </button>
        </div>

    </div>

    <div class="row my-3">
        <div class="col">
            <div class="table-responsive">
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
            </div>

        </div>
    </div>



@push('modals')
    @include('vendor.Snrc97.includes.modals.index', ['title' => $title, 'id' => $modalId, 'inputs' => $inputs, 'url' => $ajax ?? null])
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

            customButtons: '{{ $customButtons ?? '' }}',
        });
    </script>
@endpush
