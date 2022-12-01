@extends('layouts.masterBackEnd')

@section('title', 'Data Bisnis')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('business') }}
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
                        @can('business_create')
                            <a href="{{ route('business.create') }}" class="btn btn-sm btn-success mb-3">
                                <i class="fas fa-plus"></i> TAMBAH
                            </a>
                        @endcan
                        <div class="table-responsive">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Brand') }}</th>
                                        <th>{{ __('Manufacture') }}</th>
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
        const action =
            '{{ auth()->user()->can('business_update') ||auth()->user()->can('business_delete')? 'yes yes yes': '' }}'

            // {
            //     data: 'logo',
            //     name: 'logo',
            //     orderable: false,
            //     searchable: false,
            //     render: function(data) {
            //         return `<div class="Logo">
            //                 <img src="${data}" alt="Logo" class="img-fluid" width="100" height="90" style="object-fit: cover">
            //             </div>`;
            //     }
            // },

        let columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'code',
                name: 'code',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'brand',
                name: 'brand',
            },
            {
                data: 'manufacture',
                name: 'manufacture',
            },
        ]

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
            ajax: "{{ route('business.index') }}",
            columns: columns
        });
    </script>
@endpush
