<div class="row">
    <div class="col-md-12 mb-3">
        <h3>Kode Request : {{ isset($requestQr) ? $requestQr->code : $kode_request }} </h3>
        <input type="hidden" name="code" value="{{ isset($requestQr) ? $requestQr->code : $kode_request }}">
        <hr>
        <div class="form-group">
            <label for="product-id">{{ __('Product') }}</label>
            <select class="form-select @error('product_id') is-invalid @enderror" name="product_id" id="product-id"
                class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select product') }} --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ isset($requestQr) && $requestQr->product_id == $product->id ? 'selected' : (old('product_id') == $product->id ? 'selected' : '') }}>
                        {{ $product->code . ' - ' . $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="type-qr-id">{{ __('Type Qr') }}</label>
            <select class="form-select @error('type_qr_id') is-invalid @enderror" name="type_qr_id" id="type-qr-id"
                class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select type qr') }} --</option>
                @foreach ($typeQrs as $typeQr)
                    <option value="{{ $typeQr->id }}"
                        {{ isset($requestQr) && $requestQr->type_qr_id == $typeQr->id ? 'selected' : (old('type_qr_id') == $typeQr->id ? 'selected' : '') }}>
                        {{ $typeQr->name }}
                    </option>
                @endforeach
            </select>
            @error('type_qr_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="harga-pcs">Harga Satuan</label>
                    <input readonly type="number" name="harga_pcs" id="harga-pcs" class="form-control"
                        value="{{ isset($requestQr) ? $requestQr->type_qr->price : '' }}" required />
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="qty">{{ __('Qty') }} <span style="color: red"> (Min 50) - (Max 10.000)</span> </label>
                    <input type="number" name="qty" id="qty"
                        class="form-control @error('qty') is-invalid @enderror" min="50" max="10000"
                        value="{{ isset($requestQr) ? $requestQr->qty : old('qty') }}"
                        placeholder="{{ __('Qty') }}" required />
                    @error('qty')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="amount-price">Total Harga</label>
                    <input readonly type="number" name="amount_price" id="amount-price" class="form-control"
                        value="{{ isset($requestQr) ? $requestQr->amount_price : '' }}" required />
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="sn-length">{{ __('Sn Length') }} <span style="color: red"> ( *5-10 Karakter )</span> </label>
            <input type="number" name="sn_length" placeholder="Masukan Angka 5 Sampai 10" id="sn-length" min="5"
                max="10" class="form-control @error('sn_length') is-invalid @enderror"
                value="{{ isset($requestQr) ? $requestQr->sn_length : old('sn_length') }}" required />
            @error('sn_length')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
@push('js')
    <script>
        $('#type-qr-id').on('change', function(e) {
            $.ajax({
                url: `/api/type-qrs/${$(this).val()}/price`,
                method: 'GET',
                success: function(res) {
                    $('#harga-pcs').val(res.type_qr.price)

                    calculateTotal()
                }
            })
        })

        $('#qty').on('keypress blur change keydown keyup', function(e) {
            calculateTotal()
        })

        function calculateTotal(){
            let qty = parseInt($('#qty').val())
            let total = $('#amount-price')
            let harga = $('#harga-pcs').val()

            if (qty != 0 || qty != NaN) {
                total.val(qty * parseInt(harga))
            } else {
                total.val('')
            }
        }
    </script>
@endpush
