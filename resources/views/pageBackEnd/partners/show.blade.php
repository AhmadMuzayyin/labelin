@extends('layouts.masterBackEnd')

@section('title', 'Detail Partner')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('partners-show', $partner) }}
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
                                    <td class="fw-bold">{{ __('Code') }}</td>
                                    <td>{{ $partner->code }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Name') }}</td>
                                    <td>{{ $partner->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Email') }}</td>
                                    <td>{{ $partner->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Phone') }}</td>
                                    <td>{{ $partner->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Pic') }}</td>
                                    <td>{{ $partner->pic }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Address') }}</td>
                                    <td>{{ $partner->address }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Photo') }}</td>
                                    <td>
                                        @if ($partner->photo == null)
                                            <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="photo"
                                                class="rounded" width="200" height="150" style="object-fit: cover">
                                        @else
                                            <img src="{{ asset('storage/uploads/photos/' . $partner->photo) }}"
                                                alt="photo" class="rounded" width="200" height="150"
                                                style="object-fit: cover">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" width="110">{{ __('Created at') }}</td>
                                    <td>{{ $partner->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Updated at') }}</td>
                                    <td>{{ $partner->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <a href="{{ route('partners.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
