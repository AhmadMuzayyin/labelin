@extends('layouts.masterBackEnd')

@section('title', 'Data Request Qrs')

@section('content')
    <div id="content" class="app-content">
        {{-- {{ Breadcrumbs::render('request-qrs') }} --}}
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive p-1">
                                            <table class="table table-striped table-sm" id="data-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('Kode Request')  }}</th>
                                                        <th>{{ __('Produk') }}</th>
                                                        <th>{{ __('Type Qr') }}</th>
                                                        <th>{{ __('Qty') }}</th>
                                                        <th>{{ __('Total Harga') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let columns = [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'code',
                name: 'code'
            },
            {
                data: 'product',
                name: 'product.id'
            },
            {
                data: 'type_qr',
                name: 'type_qr.id'
            },
            {
                data: 'qty',
                name: 'qty',
            },
            {
                data: 'amount_price',
                name: 'amount_price',
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ];

        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('requestAll') }}",
            columns: columns
        });
    </script>
@endpush
