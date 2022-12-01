@extends('layouts.masterBackEnd')
@section('title', 'Data User')
@section('content')

<div id="content" class="app-content">
    {{ Breadcrumbs::render('user') }}
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
                    @can('user_create')
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-success mb-3"><i class="fas fa-plus"></i> TAMBAH</a>
                        @endcan

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
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

        const action = '{{ auth()->user()->can('user_update') || auth()->user()->can('user_delete') ? 'yes yes yes' : '' }}'

        let columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'roles',
                name: 'roles'
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

        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: columns
        });
    </script>
@endpush
