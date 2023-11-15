@extends('layouts.auth')
@section('title', 'Dasbor')
@section('content')
	<h1>Login {{ config('app.name') }}</h1>
	<p class="auth-subtitle mb-5">Sistem Informasi Laporan Media Sosial.</p>
	<x-main.alert />
	<form action="{{ route('auth.login') }}" method="POST">
    @csrf
		<div class="form-group position-relative has-icon-left mb-4">
			<input type="username" name="username" class="form-control form-control-xl" placeholder="Username">
			<div class="form-control-icon">
				<i class="bi bi-person"></i>
			</div>
		</div>
		<div class="form-group position-relative has-icon-left mb-4">
			<input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
			<div class="form-control-icon">
				<i class="bi bi-shield-lock"></i>
			</div>
		</div>
		<button class="btn btn-primary btn-block btn-lg mt-5 shadow-lg">Log in</button>
	</form>
@endsection
