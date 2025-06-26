@php
$id ??= $title."Modal";
@endphp
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="{{ __('all.close') }}"><i class="fa fa-close"></i></button>
            </div>
            <form action="javascript:void(0)" id="{{ $id }}Form" method="{{ 'POST' }}">
                @csrf
                <div class="modal-body">
                    @foreach($inputs as $input)
                    @php
                    $label = $input['label'] ?? $input['title'];
                    $data = $input['name'] ?? $input['data'];
                    @endphp
                        <div class="mb-3">
                            <label for="{{ $data }}" class="form-label">{{ $label }}</label>
                            @if(isset($input['elementType']) && $input['elementType'] === 'select')
                                <select class="form-select" id="{{ $data }}" name="{{ $data }}">
                                    @foreach($input['options'] as $key => $value)
                                        <option value="{{ $key }}" {{ (old($data) ?? $input['value'] ?? '') === $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="{{ $input['type'] ?? 'text' }}" class="form-control" id="{{ $data }}" name="{{ $data }}" value="{{ old($data) ?? $input['value'] ?? '' }}">
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('all.close') }}</button>
                    <button type="submit" class="btn btn-dark">{{ __('all.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(()=>{
            $('#{{ $id }}Form').on('submit', function(e) {
            alert('submit');
            e.preventDefault();
            handleSubmit(e , '{{ $url }}')
        });
        });

    </script>
@endpush