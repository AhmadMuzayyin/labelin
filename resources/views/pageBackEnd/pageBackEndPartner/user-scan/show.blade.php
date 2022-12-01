@extends('layouts.masterBackEndPartner')

@section('title', 'Customer Data')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('user-scan') }}
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
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <td class="fw-bold">{{ __('Serial Number') }}</td>
                                    <td>{{ $product[$id][0]->serial_number }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Nama Produk') }}</td>
                                    <td>{{ $product[$id][0]->nama_produk }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Customer Data') }}</td>
                                    <td>
                                        @foreach ($product as $item)
                                            @foreach ($item as $val)
                                                <ul>
                                                    <li>{{ $val->nama_lengkap }} - {{ $val->gender }} - {{ $val->birth_date }}</li>
                                                </ul>
                                            @endforeach
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <a href="{{ route('user.scan.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
