<div class="row mb-2">
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="code">{{ __('Code') }}</label>
            <input type="number" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ isset($category) ? $category->code : old('code') }}" placeholder="{{ __('Code') }}" required />
            @error('code')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($category) ? $category->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
