@extends('layouts.dashboard')
@section('title', 'Statistik '. $statBulanIni->sosmed->sosmed.' ('.$statBulanIni->sosmed->name.')')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="mb-4 d-flex justify-content-between">
						<h5 class="mb-0">Statistik {{ $statBulanIni->sosmed->sosmed }} Periode {{ tanggalIndonesia($statBulanIni->periode, 'bulan tahun') }}</h5>
						<div>
							<a href="{{ route('statistik.edit', $statBulanIni->uuid) }}" class="badge bg-success"><i class="bi bi-pencil-square"></i> Edit</a>
							<x-modal.delete text="Hapus" :id="'deleteModal'.$statBulanIni->uuid" :route="route('statistik.destroy', $statBulanIni->uuid)" :data="'Periode '. tanggalIndonesia($statBulanIni->periode, 'bulan tahun')" />
						</div>
					</div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="border-end"></th>
									<th>Bulan Sebelumnya</th>
									<th>Bulan Ini</th>
									<th>Persentase</th>
									<th>Target</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th class="border-end">Pengikut</th>
									<td>{{ $statBulanLalu->pengikut }}</td>
									<td>{{ $statBulanIni->pengikut }}</td>
									@if ($persentase->pengikut > 0)
										<td class="text-success fw-bold"><i class="bi bi-chevron-double-up"></i> {{ $persentase->pengikut }}%</td>
									@elseif ($persentase->pengikut < 0)
										<td class="text-danger fw-bold"><i class="bi bi-chevron-double-down"></i> {{ $persentase->pengikut }}%</td>
									@else
										<td class="fw-bold"><i class="bi bi-dash-lg"></i> {{ $persentase->pengikut }}%</td>
									@endif
									<td class="fw-bold {{ isset($target->pengikut) && $statBulanIni->pengikut >= $target->pengikut ? 'text-success' : 'text-danger' }}">
										{{ $target->pengikut ?? '-' }}
									</td>
								</tr>
								<tr>
									<th class="border-end">Jangkauan</th>
									<td>{{ $statBulanLalu->jangkauan }}</td>
									<td>{{ $statBulanIni->jangkauan }}</td>
									@if ($persentase->jangkauan > 0)
										<td class="text-success fw-bold"><i class="bi bi-chevron-double-up"></i> {{ $persentase->jangkauan }}%</td>
									@elseif ($persentase->jangkauan < 0)
										<td class="text-danger fw-bold"><i class="bi bi-chevron-double-down"></i> {{ $persentase->jangkauan }}%</td>
									@else
										<td class="fw-bold"><i class="bi bi-dash-lg"></i> {{ $persentase->jangkauan }}%</td>
									@endif
									<td class="fw-bold {{ isset($target->jangkauan) && $statBulanIni->jangkauan >= $target->jangkauan ? 'text-success' : 'text-danger' }}">
										{{ $target->jangkauan ?? '-' }}
									</td>
								</tr>
								<tr>
									<th class="border-end">Interaksi</th>
									<td>{{ $statBulanLalu->interaksi }}</td>
									<td>{{ $statBulanIni->interaksi }}</td>
									@if ($persentase->interaksi > 0)
										<td class="text-success fw-bold"><i class="bi bi-chevron-double-up"></i> {{ $persentase->interaksi }}%</td>
									@elseif ($persentase->interaksi < 0)
										<td class="text-danger fw-bold"><i class="bi bi-chevron-double-down"></i> {{ $persentase->interaksi }}%</td>
									@else
										<td class="fw-bold"><i class="bi bi-dash-lg"></i> {{ $persentase->interaksi }}%</td>
									@endif
									<td class="fw-bold {{ isset($target->interaksi) && $statBulanIni->interaksi >= $target->interaksi ? 'text-success' : 'text-danger' }}">
										{{ $target->interaksi ?? '-' }}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@if (auth()->user()->role == 'ADMIN')
			<div class="col-12">
				<div class="card">
					<div class="card-body py-4-5 px-4">
						<h5 class="mb-3">Evaluasi</h5>
						<form action="{{ route('statistik.evaluasi', $statBulanIni->uuid) }}" method="POST">
							@csrf
							@method('PATCH')
							<textarea class="form-control mb-3" id="evaluasi" name="evaluasi" rows="3">{{ $statBulanIni->evaluasi }}</textarea>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		@endif
	</section>
@endsection
