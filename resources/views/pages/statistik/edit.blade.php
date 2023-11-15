@extends('layouts.dashboard')
@section('title', 'Edit Data '. $statBulanIni->sosmed->sosmed)
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="mb-4 d-flex justify-content-between">
						<h5 class="mb-0">Statistik {{ $statBulanIni->sosmed->sosmed }} Periode {{ tanggalIndonesia($statBulanIni->periode, 'bulan tahun') }}</h5>
						<div>
							<a href="{{ route('statistik.show', $statBulanIni->uuid) }}" class="badge bg-primary"><i class="bi bi-list-ul"></i> Detail</a>
							<x-modal.delete text="Hapus" :id="'deleteModal'.$statBulanIni->uuid" :route="route('statistik.destroy', $statBulanIni->uuid)" :data="'Periode '. tanggalIndonesia($statBulanIni->periode, 'bulan tahun')" />
						</div>
					</div>
					<form action="{{ route('statistik.update', $statBulanIni->uuid) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="row mb-3">
							<div class="col-12 col-md-3"><label for="bulan" class="mb-2 mb-md-0 w-100 text-start">Bulan</label></div>
							<div class="col-12 col-md-9">
								<select class="form-select w-100" name="bulan" id="bulan" disabled>
									<option>{{ tanggalIndonesia($statBulanIni->periode, 'bulan') }}</option>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12 col-md-3"><label for="pengikut" class="mb-2 mb-md-0 w-100 text-start">Pengikut</label></div>
							<div class="col-12 col-md-9">
								<input type="number" class="form-control @error('pengikut') border-danger @enderror" id="pengikut" name="pengikut" value="{{ $statBulanIni->pengikut }}">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12 col-md-3"><label for="jangkauan" class="mb-2 mb-md-0 w-100 text-start">Jangkauan</label></div>
							<div class="col-12 col-md-9">
								<input type="number" class="form-control @error('jangkauan') border-danger @enderror" id="jangkauan" name="jangkauan" value="{{ $statBulanIni->jangkauan }}">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12 col-md-3"><label for="interaksi" class="mb-2 mb-md-0 w-100 text-start">Interaksi</label></div>
							<div class="col-12 col-md-9">
								<input type="number" class="form-control @error('interaksi') border-danger @enderror" id="interaksi" name="interaksi" value="{{ $statBulanIni->interaksi }}">
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
