<div class="row mb-2">
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ isset($typeQr) ? $typeQr->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="price">{{ __('Price') }}</label>
            <input type="number" name="price" id="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ isset($typeQr) ? $typeQr->price : old('price') }}" placeholder="{{ __('Price') }}"
                required />
            @error('price')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    @isset($typeQr)
        <div class="col-md-6 mb-2">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($typeQr->photo == null)
                        <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="photo"
                            class="rounded mb-2 mt-2" alt="photo" width="200" height="150"
                            style="object-fit: cover">
                    @else
                        <img src="{{ asset('storage/uploads/photos/' . $typeQr->photo) }}" alt="photo"
                            class="rounded mb-2 mt-2" width="200" height="150" style="object-fit: cover">
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="form-group ms-3">
                        <label for="photo">{{ __('Photo') }}</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                            id="photo">

                        @error('photo')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        <div id="photoHelpBlock" class="form-text">
                            {{ __('Biarkan photo kosong jika tidak ingin diganti.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label for="photo">{{ __('Photo') }}</label>
                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                    id="photo" required>

                @error('photo')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    @endisset
</div>
