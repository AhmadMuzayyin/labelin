<div class="row mb-2">
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="production_code">{{ __('Production Code') }}</label>
            <input type="text" name="production_code" id="production_code" class="form-control @error('production_code') is-invalid @enderror"
                value="{{ isset($product) ? $product->production_code : old('production_code') }}" placeholder="{{ __('Production Code') }}" required />
            @error('production_code')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="name">{{ __('Product Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ isset($product) ? $product->name : old('name') }}" placeholder="{{ __('Product Name') }}"
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
            <label for="category-id">{{ __('Category') }}</label>
            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category-id"
                class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select category') }} --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ isset($product) && $product->category_id == $category->id ? 'selected' : (old('category_id') == $category->id ? 'selected' : '') }}>
                        {{ $category->code . ' - ' . $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="business-partner-id">{{ __('Company Name') }}</label>
            <select class="form-select @error('business_id') is-invalid @enderror" name="business_id"
                id="business-partner-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select Company Name') }} --</option>
                @foreach ($businessPartners as $businessPartner)
                    <option value="{{ $businessPartner->id }}"
                        {{ isset($product) && $product->business_id == $businessPartner->id ? 'selected' : (old('business_id') == $businessPartner->id ? 'selected' : '') }}>
                        {{ $businessPartner->name }}
                    </option>
                @endforeach
            </select>
            @error('business_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="bpom">{{ __('Bpom') }}</label>
            <input type="text" name="bpom" id="bpom" class="form-control @error('bpom') is-invalid @enderror"
                value="{{ isset($product) ? $product->bpom : old('bpom') }}" placeholder="{{ __('Bpom') }}"
                required />
            @error('bpom')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                placeholder="{{ __('Description') }}" required>{{ isset($product) ? $product->description : old('description') }}</textarea>
            @error('description')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="expired_date">{{ __('Expired date') }}</label>
            <input type="date" name="expired_date" id="expired_date" class="form-control @error('expired_date') is-invalid @enderror"
                value="{{ isset($product) ? $product->expired_date : old('expired_date') }}" placeholder="{{ __('Expired date') }}"
                required />
            @error('expired_date')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="netto">{{ __('Netto') }}</label>
            <input type="text" name="netto" class="form-control @error('netto') is-invalid @enderror"
                id="netto" required value="{{ isset($product) ? $product->netto : old('netto') }}">

            @error('netto')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    @isset($product)
        <div class="col-md-6 mb-2">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($product->photo == null)
                        <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="Photo"
                            class="rounded mb-2 mt-2" alt="Photo" width="200" height="150"
                            style="object-fit: cover">
                    @else
                        <img src="{{ asset('storage/uploads/photos/' . $product->photo) }}" alt="Photo"
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
                            {{ __('Leave the Photo blank if you don`t want to change it.') }}
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
