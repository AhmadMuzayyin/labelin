@extends('layouts.masterBackEnd')
@section('title', 'Edit Roles')
@section('content')
<div id="content" class="app-content">
    {{ Breadcrumbs::render('roles-edit', $role) }}
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
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group ">
                            <a href="{{ route('roles.index') }}" class="btn btn-warning" style="float: right"><i
                                    class="fa fa-arrow-left"></i> Back</a>
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1">Nama Role</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="exampleFormControlInput1" placeholder=""
                                value="{{ old('name') ? old('name') : $role->name }}" autocomplete="off">
                            @error('name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-control overflow-auto h-100  @error('permissions') is-invalid @enderror">
                            <div class="row">
                                @foreach (config('permission.authorities') as $manageName => $permission)
                                    <div class="col-md-3 mb-4">
                                        <div class="card ">
                                            <div class="card-header bg-dark" style="color: white">
                                                {{ ucwords($manageName) }}
                                            </div>
                                            <div class="card-body">
                                                @foreach ($permission as $list)
                                                    <div class="form-check mb-1">
                                                        @if (old('permissions', $permissionChecked))
                                                            <input class="form-check-input" type="checkbox"
                                                                id="{{ Str::slug($list) }}" name="permissions[]"
                                                                value="{{ $list }}"
                                                                {{ in_array($list, old('permissions', $permissionChecked)) ? 'checked' : null }}
                                                                {{ $role->id == 1 ? 'disabled' : '' }} />
                                                        @else
                                                            <input class="form-check-input" type="checkbox"
                                                                id="{{ Str::slug($list) }}" name="permissions[]"
                                                                value="{{ $list }}"
                                                                {{ $role->id == 1 ? 'disabled' : '' }} />
                                                        @endif

                                                        <label class="form-check-label"
                                                            for="{{ Str::slug($list) }}">{{ $list }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('permissions')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <br>
                        <div class="form-group">
                            <button type="submit" {{ $role->id == 1 ? 'disabled' : '' }} class="btn btn-primary" style="float: right"><i
                                    class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

</div>

@endsection
