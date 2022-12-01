@extends('layouts.masterBackEndPartner')

@section('title', 'Upload Bukti Pembayaran Request Qrs')

@section('content')
    <div id="content" class="app-content">
        {{-- {{ Breadcrumbs::render('request-qrs-tambah') }} --}}
        <div class="row">
            <div class="col-xl-6 ui-sortable">
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
                        <form action="{{ route('request-qrs.upload.save', $requestQr->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="bukti-pembayaran">
                                    {{ __('Bukti Pembayaran') }}
                                </label>
                                <input type="file" name="bukti_pembayaran" id="bukti-pembayaran"
                                    class="form-control @error('bukti_pembayaran') is-invalid @enderror" />
                                @error('bukti_pembayaran')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <a href="{{ route('request-qrs.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>

                            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
