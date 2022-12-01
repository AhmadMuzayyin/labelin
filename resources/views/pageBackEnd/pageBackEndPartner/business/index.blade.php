@extends('layouts.masterBackEndPartner')

@section('title', 'Data business')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('part-business') }}
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
                        <a href="{{ route('part-bus.business.create') }}" class="btn btn-sm btn-success mb-3">
                            <i class="fas fa-plus"></i> TAMBAH
                        </a>

                        <div class="table-responsive">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Company Name') }}</th>
                                        <th>{{ __('Brand') }}</th>
                                        <th>{{ __('Manufacture Address') }}</th>
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
                name: 'Company Name',
            },
            {
                data: 'brand',
                name: 'brand',
            },
            {
                data: 'manufacture',
                name: 'Manufacture Address',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]

        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('part-bus.business.index') }}",
            columns: columns
        });
    </script>
@endpush
