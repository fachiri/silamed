@extends('layouts.dashboard')
@section('title', 'Tambah Data')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<h5 class="mb-4">Sosial Media</h5>
					<form action="{{ route('sosmed.store') }}" method="POST">
						@csrf
						<div class="mb-3">
							<label for="sosmed" class="form-label">Sosial Media</label>
							<input type="text" class="form-control @error('sosmed') border-danger @enderror" id="sosmed" name="sosmed" value="{{ old('sosmed') }}" placeholder="Instagram">
						</div>
						<div class="mb-3">
							<label for="icon" class="form-label">Icon</label>
							<div class="input-group">
								<input type="text" class="form-control @error('icon') border-danger @enderror" id="icon" name="icon" value="{{ old('icon') }}" placeholder="instagram">
								<span class="input-group-text" id="preview-icon"></span>
							</div>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Nama Akun</label>
							<input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="TVRI GORONTALO">
						</div>
						<div class="mb-3">
							<label for="link" class="form-label">Tautan</label>
							<input type="text" class="form-control @error('link') border-danger @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="https://instagram.com/tvrigorontalo">
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