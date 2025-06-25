<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('all.close') }}"></button>
            </div>
            <form action="{{ $url }}" method="{{ $method }}">
                @csrf
                <div class="modal-body">
                    @foreach($inputs as $input)
                        <div class="mb-3">
                            <label for="{{ $input['name'] }}" class="form-label">{{ $input['label'] }}</label>
                            @if(isset($input['elementType']) && $input['elementType'] === 'select')
                                <select class="form-select" id="{{ $input['name'] }}" name="{{ $input['name'] }}">
                                    @foreach($input['options'] as $key => $value)
                                        <option value="{{ $key }}" {{ (old($input['name']) ?? $input['value'] ?? '') === $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="{{ $input['type'] ?? 'text' }}" class="form-control" id="{{ $input['name'] }}" name="{{ $input['name'] }}" value="{{ old($input['name']) ?? $input['value'] ?? '' }}">
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('all.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('all.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
