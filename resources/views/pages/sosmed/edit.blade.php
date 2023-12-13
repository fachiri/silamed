@extends('layouts.dashboard')
@section('title', 'Edit Data')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="mb-4 d-flex justify-content-between">
						<h5 class="mb-0">{{ $sosmed->sosmed }}</h5>
						<div>
							<a href="{{ route('sosmed.show', $sosmed->uuid) }}" class="badge bg-primary"><i class="bi bi-list-ul"></i> Detail</a>
							<x-modal.delete text="Hapus" :id="'deleteModal'.$sosmed->uuid" :route="route('sosmed.destroy', $sosmed->uuid)" :data="$sosmed->sosmed" />
						</div>
					</div>
					<form action="{{ route('sosmed.update', $sosmed->uuid) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="mb-3">
							<label for="sosmed" class="form-label">Sosial Media</label>
							<input type="text" class="form-control @error('sosmed') border-danger @enderror" id="sosmed" name="sosmed" value="{{ $sosmed->sosmed }}" placeholder="Instagram">
						</div>
						<div class="mb-3">
							<label for="icon" class="form-label">Icon</label>
							<div class="input-group">
								<input type="file" class="form-control @error('icon') border-danger @enderror" id="icon">
								<input type="hidden" id="icon-value" name="icon" value="{{ $sosmed->icon }}">
								<span class="input-group-text" id="preview-icon">
									{!! $sosmed->icon !!}
								</span>
							</div>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Nama Akun</label>
							<input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" value="{{ $sosmed->name }}" placeholder="Instagram">
						</div>
						<div class="mb-3">
							<label for="link" class="form-label">Tautan Akun</label>
							<input type="text" class="form-control @error('link') border-danger @enderror" id="link" name="link" value="{{ $sosmed->link }}" placeholder="Instagram">
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