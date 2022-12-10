@extends('layouts.masterBackEnd')

@section('title', 'Data Report')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('Report') }}
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
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Nama Lengkap') }}</th>
                                        <th>{{ __('Nomor Telepon') }}</th>
                                        <th>{{ __('Kronologi') }}</th>
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
                data: 'fullname',
                name: 'nama_lengkap',
            },
            {
                data: 'phone_number',
                name: 'nomor_telepon',
            },
            {
                data: 'kronologi',
                name: 'kronologi',
            },
        ]


        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('report.index') }}",
            columns: columns
        });
    </script>
@endpush
