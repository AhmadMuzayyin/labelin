@extends('layouts.masterBackEnd')

@section('title', 'Detail Request Qrs')

@section('content')



<!-- #modal-dialog -->
<div class="modal fade" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Resi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST" action="{{ route('upResi') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jasa_kirim">Jasa Kirim</label>
                        <input type="hidden" name="request_qr_id" value="{{ $requestQr[0]->id }}">
                        <input type="text" class="form-control" id="jasa_kirim" name="jasa_kirim" required>
                    </div> <br>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nomor Resi</label>
                        <input type="text" class="form-control" name="resi" id="resi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="content" class="app-content">
    <div class="row">
        <div class="col-xl-8 ui-sortable">
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">@yield('title')</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <tr>
                                <td class="fw-bold">{{ __('Nama Partner') }}</td>
                                <td>{{ $requestQr[0]->nama_partner }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Product') }}</td>
                                <td>{{ $requestQr[0]->nama_produk }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Type Qr') }}</td>
                                <td>{{ $requestQr[0]->nama_type }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Qty') }}</td>
                                <td>{{ number_format($requestQr[0]->qty) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Sn Length') }}</td>
                                <td>{{ number_format($requestQr[0]->sn_length) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Amount Price (Qty x Type QR Price)') }}</td>
                                <td>{{ number_format($requestQr[0]->amount_price) . ' (' .
                                    number_format($requestQr[0]->qty) . ' x ' .
                                    number_format($requestQr[0]->harga_satuan) . ')' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Status') }}</td>
                                <td>{{ $requestQr[0]->status }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Tanggal Request') }}</td>
                                <td>{{ $requestQr[0]->tanggal_request }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Bukti Pembayaran') }}</td>
                                <td>
                                    @if ($requestQr[0]->bukti_pembayaran)
                                    <a href="{{ route('request-qrs.download', $requestQr[0]->bukti_pembayaran) }}"
                                        target="_blank">Download</a>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold" width="160">{{ __('Tgl Upload Bukti Bayar') }}</td>
                                <td>{{ isset($requestQr[0]->tgl_upload_bukti_bayar) ?
                                    $requestQr[0]->tgl_upload_bukti_bayar : '-' }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <td class="fw-bold">{{ __('Created at') }}</td>
                                <td>{{ $requestQr[0]->created_at }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Updated at') }}</td>
                                <td>{{ $requestQr[0]->updated_at }}</td>
                            </tr> --}}
                            <tr>
                                <td class="fw-bold">{{ __('Generate QR') }}</td>
                                <td>{{ $requestQr[0]->is_generate }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Jasa Kirim') }}</td>
                                <td>{{ $requestQr[0]->jasa_kirim }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Nomor Resi') }}</td>
                                <td>{{ $requestQr[0]->no_resi }}</td>
                            </tr>

                            @php
                            $history = DB::table('history_requests')
                            ->where('request_qr_id', '=', $requestQr[0]->id)
                            ->get();
                            @endphp
                            <tr>
                                <td class="fw-bold">{{ __('Histori') }}</td>
                                <td>
                                    <ul class="m-1 p-1">
                                        @foreach ($history as $history)
                                        <li>{{ $history->created_at . ' - ' . $history->status }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <input type="hidden" value="{{ $requestQr[0]->id  }}" id="request_qr_id">
                    <input type="hidden" value="{{ $requestQr[0]->sn_length }}" id="sn_length">
                    <input type="hidden" value="{{ $requestQr[0]->qty }}" id="qty_qr">
                    <a href="{{ route('requestAll') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> {{ __('Kembali') }}</a>



                    @if($requestQr[0]->status == 'Pending Payment')
                    <button type="button" id="btn-progress" class="btn btn-primary btn-progress">
                        <i class="fa fa-spinner" aria-hidden="true"></i> Set Cetak QR
                    </button>
                    @endif

                    @if($requestQr[0]->is_generate != null && $requestQr[0]->status == 'Proses Cetak QR')
                    <a href="#modal-dialog" class="btn btn-primary" data-bs-toggle="modal"> Update Resi</a>
                    @endif

                    @if($requestQr[0]->is_generate == null && $requestQr[0]->status == 'Proses Cetak QR' )
                    <button type="button" id="btn-generate" class="btn btn-warning btn-generate">
                        <i class="fa fa-refresh" aria-hidden="true"></i> Generate QR
                    </button>
                    @endif


                    @if($requestQr[0]->is_generate != null || $requestQr[0]->is_generate !='')
                    <a href="{{ route('export.qr' , $requestQr[0]->id) }}" class="btn  btn-success ">
                        <i class="fa fa-file-excel" aria-hidden="true"></i> Download File Excel
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-4 ui-sortable">
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">Alamat Pengiriman</h4>

                    @php
                    $dataPartner = DB::table('partners')
                    ->where('id', '=', $requestQr[0]->id_partner)
                    ->get();
                    @endphp

                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <tr>
                                <td class="fw-bold">{{ __('Nama') }}</td>
                                <td>{{ $dataPartner[0]->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Email') }}</td>
                                <td>{{ $dataPartner[0]->email }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Telepon') }}</td>
                                <td>{{ $dataPartner[0]->phone }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Alamat') }}</td>
                                <td>{{ $dataPartner[0]->address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).on('click', '.btn-generate', function() {
            const request_qr_id = $('#request_qr_id').val();
            const sn_length = $('#sn_length').val();
            const qty_qr = $('#qty_qr').val();
            let dataGen = {
                request_qr_id : request_qr_id,
                sn_length: sn_length,
                qty_qr: qty_qr,
            }

			swal.fire({
				title: 'Konfirmasi !!!',
				text: "Apakah anda yakin Untuk Generate QR Request Ini ?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Generate!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
                    type: 'POST',
                    url: '{{ route('generateQR') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: dataGen,
                    beforeSend: function(){
                                Swal.fire({
                                    title: 'Please Wait !',
                                    html: 'Sedang melakukan proses generate',// add html attribute if you want or remove
                                    allowOutsideClick: false,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                    },
                                });
                            },
                    success: function(data) {
                        if (data == 'error') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Informasi !!!',
                                        text: 'Generate QR Gagal',
                                    }).then(function() {
                                        location.reload();
                                    })
                                }else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Informasi !!!',
                                        text: 'Generate QR Berhasil, Silahkan Download File Excel',
                                    }).then(function() {
                                        location.reload();
                                    })
                                }


                    },
                })
				}
			})
		});
</script>

<script>
    $(document).on('click', '.btn-progress', function() {
            const request_qr_id = $('#request_qr_id').val();
            const sn_length = $('#sn_length').val();
            const qty_qr = $('#qty_qr').val();
            let dataGen = {
                request_qr_id : request_qr_id,
                sn_length: sn_length,
                qty_qr: qty_qr,
            }

			swal.fire({
				title: 'Konfirmasi !!!',
				text: "Apakah anda yakin Untuk Set Progress Request Ini ?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Set Progress!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
                    type: 'POST',
                    url: '{{ route('upProgress') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: dataGen,
                    beforeSend: function(){
                                Swal.fire({
                                    title: 'Please Wait !',
                                    html: 'Sedang melakukan update',// add html attribute if you want or remove
                                    allowOutsideClick: false,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                    },
                                });
                            },
                    success: function(data) {
                        if (data == 'error') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Informasi !!!',
                                        text: 'Update Status Proses Cetak QR Gagal',
                                    }).then(function() {
                                        location.reload();
                                    })
                                }else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Informasi !!!',
                                        text: 'Update Status Proses Cetak QR Berhasil',
                                    }).then(function() {
                                        location.reload();
                                    })
                                }


                    },
                })
				}
			})
		});
</script>
@endpush
