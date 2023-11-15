@extends('layouts.dashboard')
@section('title', 'Edit Data')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="mb-4 d-flex justify-content-between">
						<h5 class="mb-0">{{ $user->name }}</h5>
						<div>
							<a href="{{ route('user.show', $user->uuid) }}" class="badge bg-primary"><i class="bi bi-list-ul"></i> Detail</a>
							<x-modal.delete text="Hapus" :id="'deleteModal'.$user->uuid" :route="route('user.destroy', $user->uuid)" :data="$user->name" />
						</div>
					</div>
					<form action="{{ route('user.update', $user->uuid) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="mb-3">
							<label for="role" class="form-label">Role</label>
							<select class="form-select w-100" name="role" id="role" disabled>
								<option value="ADMIN">ADMIN</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Nama Lengkap</label>
							<input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" value="{{ $user->name }}">
						</div>
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control @error('username') border-danger @enderror" id="username" name="username" value="{{ $user->username }}">
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="text" class="form-control @error('email') border-danger @enderror" id="email" name="email" value="{{ $user->email }}">
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
@push('scripts')
	<script>
		const previewIcon = document.getElementById('preview-icon')
		const inputIcon = document.getElementById('icon')

		inputIcon.addEventListener('input', (e) => {
			previewIcon.innerHTML = `<i class="bi bi-${e.target.value}" style="margin-top: -10px;"></i>`;
		})
	</script>
@endpush