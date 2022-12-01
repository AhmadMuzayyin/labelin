@extends('layouts.masterBackEnd')

@section('title', 'Detail Category')

@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('categories-show', $category) }}
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
                                    <td>{{ $category->code }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Name') }}</td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Created at') }}</td>
                                    <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Updated at') }}</td>
                                    <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
