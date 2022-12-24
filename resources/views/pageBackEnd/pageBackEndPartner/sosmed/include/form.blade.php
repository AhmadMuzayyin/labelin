<div class="row mb-2">
    <div class="col-md-6 mb-2">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <select class="form-select @error('name') is-invalid @enderror" name="name" id="name"
                aria-label="Default select example" required>
                <option value="" selected disabled>Pilih jenis sosial media</option>
                <option value="Instagram">Sosial Media Instagram</option>
                <option value="Facebook">Sosial Media Facebook</option>
                <option value="Twitter">Sosial Media Twitter</option>
                <option value="Linkedin">Sosial Media Linkedin</option>
                <option value="Tiktok">Sosial Media Tiktok</option>
                <option value="Youtube">Sosial Media Youtube</option>
                <option value="" disabled>--------------------------------</option>
                <option value="TiktokShop">TiktokShop</option>
                <option value="Lazada">Lazada</option>
                <option value="Shopee">Shopee</option>
                <option value="Tokopedia">Tokopedia</option>
                <option value="Buka Lapak">Bukalapak</option>
                <option value="" disabled>--------------------------------</option>
                <option value="Whatsapp">CS Whatsapp</option>
                <option value="Telepon">CS Telepon</option>
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
            <label for="link">{{ __('Link') }}</label>
            <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror"
                value="{{ isset($sosmed) ? $sosmed->brand : old('link') }}" placeholder="{{ __('Link') }}"
                required />
            <small class="text-danger">*Harap menggunakan link yang benar ex(https://www.instagram.com/labelin_co)</small>
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
