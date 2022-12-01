@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="form-floating mb-20px">
        <input type="email" name="email" class="form-control fs-13px h-45px border-0  @error('password') is-invalid @enderror" placeholder="Email Address" id="email" />
        @error('email')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <label for="emailAddress" class="d-flex align-items-center text-gray-600 fs-13px">Email Address</label>
    </div>
    <div class="form-floating mb-20px">
        <input type="password" class="form-control fs-13px h-45px border-0  @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password" />
        @error('password')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <label for="emailAddress" class="d-flex align-items-center text-gray-600 fs-13px">Password</label>
    </div>
    <div class="form-check mb-20px">
        <input class="form-check-input border-0" type="checkbox" value="1" id="rememberMe" onclick="myFunction()" />

        <label class="form-check-label fs-13px text-gray-300" for="rememberMe">
            Show Password
        </label>
    </div>
    <div class="mb-20px">
        <button type="submit" class="btn btn-cyan d-block w-100 h-45px btn-lg">Sign me in</button>
    </div>
</form>
@endsection
