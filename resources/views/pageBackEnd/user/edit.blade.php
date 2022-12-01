@extends('layouts.masterBackEnd')
@section('title', 'Edit User')
@section('content')
    <div id="content" class="app-content">
        {{ Breadcrumbs::render('user-edit', $user) }}
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
                        <div class="form-group ">
                            <a href="{{ route('user.index') }}" class="btn btn-warning" style="float: right"><i
                                    class="fa fa-arrow-left"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('user.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Nama</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="
                                                                exampleFormControlInput1" type="text"
                                        value="{{ old('name') ? old('name') : $user->name }}" placeholder="Nama"
                                        name="name" autocomplete="off">
                                    @error('name')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="
                                                                exampleFormControlInput1" type="email"
                                        value="{{ old('email') ? old('email') : $user->email }}" placeholder="Email"
                                        name="email" autocomplete="off">
                                    @error('email')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="
                                                                exampleFormControlInput1" type="password"
                                        value="{{ old('password') }}" placeholder="Password" name="password">
                                        <span style="color: red">*kosongkan jika tidak ingin merubah password</span>
                                    @error('password')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Konfirmasi Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="
                                                                exampleFormControlInput1" type="password"
                                        value="{{ old('password_confirmation') }}" placeholder="Konfirmasi Password"
                                        name="password_confirmation">
                                    @error('password')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Role</label>
                                    <select name="role" class="form-control select2-lib  @error('role') is-invalid @enderror"
                                        id="exampleFormControlSelect1">
                                        <option value="" disabled="" selected="">-- Pilih --</option>
                                        @foreach ($role as $row)
                                            <option value="{{ $row->id }}"
                                                {{ old('role') && old('role') == $row->id ? 'selected' : '' }}
                                                {{ $user->roles->first()->id == $row->id ? 'selected' : '' }}
                                                >
                                                {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select2-component').select2();
        });
    </script>
@endpush
