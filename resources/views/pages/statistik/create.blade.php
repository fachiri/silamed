@extends('layouts.dashboard')
@section('title', 'Tambah Data')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<h5 class="mb-4">Statistik {{ $data->sosmed }}</h5>
					<form action="{{ route('statistik.store') }}" method="POST">
						@csrf
						<input type="hidden" name="sosmed_id" value="{{ $data->id }}">
						<input type="hidden" name="sosmed" value="{{ $data->sosmed }}">
						<div class="row mb-3">
							<div class="col-12 col-md-3"><label for="bulan" class="mb-md-0 w-100 mb-2 text-start">Bulan / Tahun</label></div>
							<div class="col-12 col-md-7">
								<select class="form-select w-100" name="bulan" id="bulan">
									<option value="01" {{ old('bulan') == '01' ? 'selected' : '' }}>Januari</option>
									<option value="02" {{ old('bulan') == '02' ? 'selected' : '' }}>Februari</option>
									<option value="03" {{ old('bulan') == '03' ? 'selected' : '' }}>Maret</option>
									<option value="04" {{ old('bulan') == '04' ? 'selected' : '' }}>April</option>
									<option value="05" {{ old('bulan') == '05' ? 'selected' : '' }}>Mei</option>
									<option value="06" {{ old('bulan') == '06' ? 'selected' : '' }}>Juni</option>
									<option value="07" {{ old('bulan') == '07' ? 'selected' : '' }}>Juli</option>
									<option value="08" {{ old('bulan') == '08' ? 'selected' : '' }}>Agustus</option>
									<option value="09" {{ old('bulan') == '09' ? 'selected' : '' }}>September</option>
									<option value="10" {{ old('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
									<option value="11" {{ old('bulan') == '11' ? 'selected' : '' }}>November</option>
									<option value="12" {{ old('bulan') == '12' ? 'selected' : '' }}>Desember</option>
								</select>
							</div>
							<div class="col-12 col-md-2">
								<input type="text" class="form-control @error('tahun') border-danger @enderror" id="tahun" name="tahun" maxlength="4" value="{{ date('Y') }}" >
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12 col-md-3"><label for="pengikut" class="mb-md-0 w-100 mb-2 text-start">Pengikut</label></div>
							<div class="col-12 col-md-9">
								<input type="number" class="form-control @error('pengikut') border-danger @enderror" id="pengikut" name="pengikut" value="{{ old('pengikut') }}">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12 col-md-3"><label for="jangkauan" class="mb-md-0 w-100 mb-2 text-start">Jangkauan</label></div>
							<div class="col-12 col-md-9">
								<input type="number" class="form-control @error('jangkauan') border-danger @enderror" id="jangkauan" name="jangkauan" value="{{ old('jangkauan') }}">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12 col-md-3"><label for="interaksi" class="mb-md-0 w-100 mb-2 text-start">Interaksi</label></div>
							<div class="col-12 col-md-9">
								<input type="number" class="form-control @error('interaksi') border-danger @enderror" id="interaksi" name="interaksi" value="{{ old('interaksi') }}">
							</div>
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
