<div class="row mb-2">
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="code">{{ __('Code') }}</label>
            <input type="number" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                value="{{ isset($business) ? $business->code : old('code') }}" placeholder="{{ __('Code') }}"
                required />
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
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ isset($business) ? $business->name : old('name') }}" placeholder="{{ __('Name') }}"
                required />
            @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="brand">{{ __('Brand') }}</label>
            <input type="text" name="brand" id="brand"
                class="form-control @error('brand') is-invalid @enderror"
                value="{{ isset($business) ? $business->brand : old('brand') }}" placeholder="{{ __('Brand') }}"
                required />
            @error('brand')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="manufacture">{{ __('Manufacture') }}</label>
            <textarea name="manufacture" id="manufacture" class="form-control @error('manufacture') is-invalid @enderror"
                placeholder="{{ __('Manufacture') }}" required>{{ isset($business) ? $business->manufacture : old('manufacture') }}</textarea>
            @error('manufacture')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    @isset($business)
        <div class="col-md-6 mb-2">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($business->logo == null)
                        <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="Logo"
                            class="rounded mb-2 mt-2" alt="Logo" width="200" height="150"
                            style="object-fit: cover">
                    @else
                        <img src="{{ asset('storage/uploads/logos/' . $business->logo) }}" alt="Logo"
                            class="rounded mb-2 mt-2" width="200" height="150" style="object-fit: cover">
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="form-group ms-3">
                        <label for="logo">{{ __('Logo') }}</label>
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror"
                            id="logo">

                        @error('logo')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        <div id="logoHelpBlock" class="form-text">
                            {{ __('Biarkan logo kosong jika tidak ingin diganti.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label for="logo">{{ __('Logo') }}</label>
                <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo"
                    required>

                @error('logo')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    @endisset
</div>
