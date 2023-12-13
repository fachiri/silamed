@extends('layouts.dashboard')
@section('title', 'Tambah Data')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<h5 class="mb-4">Pengguna Admin</h5>
					<form action="{{ route('user.store') }}" method="POST">
						@csrf
						<div class="mb-3">
							<label for="role" class="form-label">Role</label>
							<select class="form-select w-100" name="role" id="role" disabled>
								<option value="KARYAWAN">KARYAWAN</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Nama Lengkap</label>
							<input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" value="{{ old('name') }}">
						</div>
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control @error('username') border-danger @enderror" id="username" name="username" value="{{ old('username') }}">
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="text" class="form-control @error('email') border-danger @enderror" id="email" name="email" value="{{ old('email') }}">
						</div>
						<div class="d-flex">
							<button type="submit" class="btn btn-primary w-100">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection