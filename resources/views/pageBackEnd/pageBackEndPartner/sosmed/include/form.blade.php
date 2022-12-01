<div class="row mb-2">
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <select class="form-select @error('name') is-invalid @enderror" name="name" id="name"
                aria-label="Default select example" required>
                <option value="">Pilih jenis sosial media</option>
                <option value="Instagram">Instagram</option>
                <option value="Tiktok Shop">Tiktok Shop</option>
                <option value="Whatsapp">Whatsapp</option>
                <option value="Shopee">Shopee</option>
                <option value="Linktree">Linktree</option>
            </select>
            @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="icon">{{ __('Icon') }}</label>
            <select class="form-select @error('icon') is-invalid @enderror" name="icon" id="icon" required>
                <option value="">Pilih jenis sosial media</option>
                <option value='<i class="fa-brands fa-instagram"></i>'>Instagram</option>
                <option value='<i class="fa-brands fa-tiktok"></i>'>Tiktok Shop</option>
                <option value='<i class="fa-brands fa-whatsapp"></i>'>Whatsapp</option>
                <option value='<i class="fa-brands fa-shopify"></i>'>Shopee</option>
                <option value='<img src="{{ url('/img/linktree.ico') }}" alt="linktree">'>Linktree</option>
            </select>
            @error('icon')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="link">{{ __('Link') }}</label>
            <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror"
                value="{{ isset($sosmed) ? $sosmed->brand : old('link') }}" placeholder="{{ __('Link') }}"
                required />
            <small class="text-danger">*Harap menggunakan link yang lengkap ex(https://www.instagram.com/labelin_co)</small>
            @error('link')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>

    <input type="hidden" name="partner_id" id="partner_id"
        class="form-control @error('partner_id') is-invalid @enderror" value="{{ Session::get('id-partner') }}" required
        readonly />
    @error('partner_id')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>
