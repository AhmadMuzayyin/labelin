@extends('layouts.masterBackEndPartner')

@section('title', 'Detail Request Qrs')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('request-qrs-show', $requestQr) }}
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
                                    <td class="fw-bold">{{ __('Product') }}</td>
                                    <td>{{ $requestQr->product ? $requestQr->product->code . ' - ' . $requestQr->product->name : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Type Qr') }}</td>
                                    <td>{{ $requestQr->type_qr ? $requestQr->type_qr->name : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Qty') }}</td>
                                    <td>{{ number_format($requestQr->qty) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Sn Length') }}</td>
                                    <td>{{ number_format($requestQr->sn_length) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Amount Price (Qty x Type QR Price)') }}</td>
                                    <td>{{ number_format($requestQr->amount_price) . ' (' . number_format($requestQr->qty) . ' x ' . number_format($requestQr->type_qr->price) . ')' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Status') }}</td>
                                    <td>{{ $requestQr->status }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Tanggal Request') }}</td>
                                    <td>{{ $requestQr->tanggal_request->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Bukti Pembayaran') }}</td>
                                    <td>
                                        @if ($requestQr->bukti_pembayaran)
                                            <a href="{{ route('request-qrs.download', $requestQr->bukti_pembayaran) }}"
                                                target="_blank">Download</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" width="160">{{ __('Tgl Upload Bukti Bayar') }}</td>
                                    <td>{{ isset($requestQr->tgl_upload_bukti_bayar) ? $requestQr->tgl_upload_bukti_bayar->format('d/m/Y H:i') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Jasa Kirim') }}</td>
                                    <td>{{ $requestQr->jasa_kirim }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Nomor Resi') }}</td>
                                    <td>{{ $requestQr->no_resi }}</td>
                                </tr>

                                {{-- <tr>
                                    <td class="fw-bold">{{ __('Created at') }}</td>
                                    <td>{{ $requestQr->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Updated at') }}</td>
                                    <td>{{ $requestQr->updated_at->format('d/m/Y H:i') }}</td>
                                </tr> --}}
                                <tr>
                                    <td class="fw-bold">{{ __('Histori') }}</td>
                                    <td>
                                        <ul class="m-1 p-1">
                                            @foreach ($requestQr->histories as $history)
                                                <li>{{ $history->created_at->format('d/m/Y H:i') . ' - ' . $history->status }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <a href="{{ route('request-qrs.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
