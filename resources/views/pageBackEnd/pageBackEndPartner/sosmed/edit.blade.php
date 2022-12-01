@extends('layouts.masterBackEndPartner')

@section('title', 'Edit Sosial media')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('sosmedEdit', $sosmed->id) }}
        <div class="row">
            <div class="col-xl-12 ui-sortable">
                <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">@yield('title')</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand">
                                <i class="fa fa-expand"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload">
                                <i class="fa fa-redo"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse">
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('sosmed.update', $sosmed->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-2">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <select class="form-select @error('name') is-invalid @enderror" name="name"
                                            id="name" aria-label="Default select example" required>
                                            <option value="">Pilih jenis sosial media</option>
                                            <option value="Instagram"
                                                {{ $sosmed->name == 'Instagram' ? 'selected' : '' }}>
                                                Instagram</option>
                                            <option value="Tiktok Shop" {{ $sosmed->name == 'Tiktok Shop' ? 'selected' : '' }}>Tiktok Shop</option>
                                            <option value="Whatsapp" {{ $sosmed->name == 'Tiktok Shop' ? 'selected' : '' }}>Whatsapp</option>
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
                                        <select class="form-select @error('icon') is-invalid @enderror" name="icon"
                                            id="icon" required>
                                            <option value="">Pilih icon sosial media</option>
                                            <option value='<i class="fa-brands fa-instagram"></i>' {{ $sosmed->name == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                            <option value='<i class="fa-brands fa-tiktok"></i>' {{ $sosmed->name == 'Tiktok Shop' ? 'selected' : '' }}>Tiktok Shop</option>
                                            <option value='<i class="fa-brands fa-whatsapp"></i>' {{ $sosmed->name == 'Whatsapp' ? 'selected' : '' }}>Whatsapp</option>
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
                                        <input type="text" name="link" id="link"
                                            class="form-control @error('link') is-invalid @enderror"
                                            value="{{ isset($sosmed) ? $sosmed->link_sosmed : old('link') }}"
                                            placeholder="{{ __('Link') }}" required />
                                        <small class="text-danger">*Harap menggunakan link yang lengkap
                                            ex(https://www.instagram.com/labelin_co)</small>
                                        @error('link')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <input type="hidden" name="partner_id" id="partner_id"
                                    class="form-control @error('partner_id') is-invalid @enderror"
                                    value="{{ Session::get('id-partner') }}" required readonly />
                                @error('partner_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <a href="{{ route('sosmed.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>

                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
