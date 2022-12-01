@extends('layouts.masterBackEnd')

@section('title', 'Data Type QRs')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('type-qrs') }}
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
                        @can('partner_create')
                            <a href="{{ route('type-qrs.create') }}" class="btn btn-sm btn-success mb-3">
                                <i class="fas fa-plus"></i> TAMBAH
                            </a>
                        @endcan
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Name') }}</th>
											<th>{{ __('Price') }}</th>
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
    @endsection
    @push('js')
        <script>
            const action = '{{ auth()->user()->can('type_qr_update') || auth()->user()->can('type_qr_delete') ? 'yes yes yes': '' }}'

            let columns = [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'price',
                    name: 'price',
                },
            ];

            if (action) {
                columns.push({
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                })
            }

            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('type-qrs.index') }}",
                columns: columns
            });
        </script>
    @endpush
