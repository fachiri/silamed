@extends('layouts.dashboard')
@section('title', 'Statistik '. $statBulanIni->sosmed->sosmed)
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
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
