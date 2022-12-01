<div class="row mb-2">
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="code">{{ __('Code') }}</label>
            <input type="number" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                value="{{ isset($partner) ? $partner->code : old('code') }}" placeholder="{{ __('Code') }}" required />
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
                value="{{ isset($partner) ? $partner->name : old('name') }}" placeholder="{{ __('Name') }}"
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
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ isset($partner) ? $partner->email : old('email') }}" placeholder="{{ __('Email') }}"
                required />
            @error('email')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="tel" name="phone" id="phone"
                class="form-control @error('phone') is-invalid @enderror"
                value="{{ isset($partner) ? $partner->phone : old('phone') }}" placeholder="{{ __('Phone') }}"
                required />
            @error('phone')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="pic">{{ __('Pic') }}</label>
            <input type="text" name="pic" id="pic" class="form-control @error('pic') is-invalid @enderror"
                value="{{ isset($partner) ? $partner->pic : old('pic') }}" placeholder="{{ __('Pic') }}"
                required />
            @error('pic')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                {{ empty($partner) ? ' required' : '' }} />
            @error('password')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
            @isset($partner)
                <div id="PasswordHelpBlock" class="form-text">
                    {{ __('Biarkan password kosong jika tidak ingin diganti') }}
                </div>
            @endisset
        </div>
    </div>

    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="password-confirmation">{{ __('Password Confirmation') }}</label>
            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control"
                placeholder="{{ __('Password Confirmation') }}" {{ empty($partner) ? ' required' : '' }} />
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                placeholder="{{ __('Address') }}">{{ isset($partner) ? $partner->address : old('address') }}</textarea>
            @error('address')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>

    @isset($partner)
        <div class="col-md-6 mb-2">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($partner->photo == null)
                        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($partner->email))) }}&s=500" alt="photo"
                            class="rounded mb-2 mt-2" alt="photo" width="200" height="150"
                            style="object-fit: cover">
                    @else
                        <img src="{{ asset('storage/uploads/photos/' . $partner->photo) }}" alt="photo"
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
