@extends('layouts.masterBackEndPartner')

@section('title', 'Partner Profile')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('partner-profile') }}
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
                        <form action="{{ route('partner.profile.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('pageBackEnd.partners.include.form')

                            <a href="{{ route('partners.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>

                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
