@extends('layouts.masterBackEnd')
@section('title', 'Setting Web Topup')
@section('content')

<div id="content" class="app-content">
    {{ Breadcrumbs::render('settingWeb') }}
    <div class="row">
        <div class="col-xl-12 ui-sortable">

            <div class="panel panel-inverse" data-sortable-id="table-basic-1">

                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">@yield('title')</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <form method="POST" action="{{ route('settingWeb.update', $setting_web->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_website">Nama Website </label>
                                    <input class="form-control @error('nama_website') is-invalid @enderror" id="nama_website" type="text" value="{{ old('nama_website') ? old('nama_website') : $setting_web->nama_website }}" placeholder="" name="nama_website" autocomplete="off">
                                    @error('nama_website')
                                    <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    @if ($setting_web->logo_dark != '' || $setting_web->logo_dark != null)
                                    <img src="{{ Storage::url('public/img/setting_web/') . $setting_web->logo_dark }}" class="img-preview d-block w-50 mb-3 col-sm-5 rounded ">
                                    <p style="color: red">*Silahkan pilih logo dark jika ingin merubahnya</p>
                                    @endif

                                    <input type="file" class="form-control @error('logo_dark') is-invalid @enderror" id="logo_dark" name="logo_dark" onchange="previewImg()" value="{{  $setting_web->logo_dark }}">
                                    @error('logo_dark')
                                    <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    @if ($setting_web->logo_light != '' || $setting_web->logo_light != null)
                                    <img src="{{ Storage::url('public/img/setting_web/') . $setting_web->logo_light }}" class="img-preview d-block w-50 mb-3 col-sm-5 rounded " style="width: 150px">
                                    <p style="color: red">*Silahkan pilih logo light jika ingin merubahnya</p>
                                    @endif

                                    <input type="file" class="form-control @error('logo_light') is-invalid @enderror" id="logo_light" name="logo_light" onchange="previewImg()" value="{{  $setting_web->logo_light }}">
                                    @error('logo_light')
                                    <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="telpon">Telpon</label>
                                    <input class="form-control @error('telpon') is-invalid @enderror" id="telpon" type="text" value="{{ old('telpon') ? old('telpon') : $setting_web->telpon }}" placeholder="" name="telpon" autocomplete="off">
                                    @error('telpon')
                                    <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" value="{{ old('email') ? old('email') : $setting_web->email }}" placeholder="" name="email" autocomplete="off">
                                    @error('email')
                                    <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea rows="5" class="form-control @error('alamat') is-invalid @enderror" id="alamat" type="text" placeholder="" name="alamat">{{ old('alamat') ? old('alamat') : $setting_web->alamat }}</textarea>
                                    @error('alamat')
                                    <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="deskripsi">Deskripsi</label>
                                    <textarea rows="5" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" type="text" placeholder="" name="deskripsi">{{ old('deskripsi') ? old('deskripsi') : $setting_web->deskripsi }}</textarea>
                                    @error('deskripsi')
                                    <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="is_aktif_website">Is Aktif Website</label>
                                    <select name="is_aktif_website" id="is_aktif_website" class="form-control select2-lib @error('is_aktif_website') is-invalid @enderror">
                                        <option value="Y" {{  old('is_aktif_website') == 'Y' ? 'selected' : '' }} {{ $setting_web->is_aktif_website == 'Y' ? 'selected' : '' }}>Aktif</option>
                                        <option value="T" {{  old('is_aktif_website') == 'T' ? 'selected' : '' }} {{ $setting_web->is_aktif_website == 'T' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('is_aktif_website')
                                    <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                @can('setting_web_update')
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Update</button>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

</div>


@endsection
