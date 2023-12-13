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
								<input type="file" class="form-control @error('icon') border-danger @enderror" id="icon">
								<input type="hidden" id="icon-value" name="icon" value="">
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
		const previewIcon = document.getElementById('preview-icon');
		const inputIcon = document.getElementById('icon');
    const iconValueInput = document.getElementById('icon-value');

		inputIcon.addEventListener('input', (e) => {
			const file = inputIcon.files[0];

			if (file && file.type === 'image/svg+xml') {
				const reader = new FileReader();

				reader.onload = (e) => {
					const svgContent = e.target.result;

					// Create a new SVG element
					const svgElement = new DOMParser().parseFromString(svgContent, 'image/svg+xml').querySelector('svg');

					// Set the width and height attributes
					svgElement.setAttribute('width', '16');
					svgElement.setAttribute('height', '16');

					// Convert the modified SVG element back to a string
					const modifiedSvgContent = new XMLSerializer().serializeToString(svgElement);
					
					iconValueInput.value = modifiedSvgContent;

					// Set the modified SVG content as the innerHTML of previewIcon
					previewIcon.innerHTML = modifiedSvgContent;
				};

				reader.readAsText(file);
			} else {
				previewIcon.innerHTML = '';
				alert('Please select a valid SVG file.');
			}
		});
	</script>
@endpush
