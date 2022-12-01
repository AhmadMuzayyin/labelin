@extends('layouts.masterBackEnd')

@section('title', 'Detail Type QR')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('type-qrs-show', $typeQr) }}
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
                                    <td class="fw-bold">{{ __('Name') }}</td>
                                    <td>{{ $typeQr->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Price') }}</td>
                                    <td>{{ $typeQr->price }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Photo') }}</td>
                                    <td>
                                        @if ($typeQr->photo == null)
                                            <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="photo"
                                                class="rounded" width="200" height="150" style="object-fit: cover">
                                        @else
                                            <img src="{{ asset('storage/uploads/photos/' . $typeQr->photo) }}"
                                                alt="photo" class="rounded" width="200" height="150"
                                                style="object-fit: cover">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Created at') }}</td>
                                    <td>{{ $typeQr->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Updated at') }}</td>
                                    <td>{{ $typeQr->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <a href="{{ route('type-qrs.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
