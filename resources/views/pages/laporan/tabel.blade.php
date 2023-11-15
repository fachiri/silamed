@extends('layouts.dashboard')
@section('title', 'Laporan Perkembangan Sosial Media')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header pb-0">
					<h5 class="mb-0">Filter</h5>
				</div>
				<div class="card-body py-4-5 px-4">
					<form action="{{ route('laporan.tabel') }}" method="GET">
						<div class="row mb-3">
							<div class="col-12">
								<label for="tahun" class="form-label">Tahun</label>
								<select name="tahun" id="tahun" class="form-select" {{ request('periode') == 'tahun' ? 'disabled' : '' }}>
									@foreach ($tahun as $item)
										<option value="{{ $item }}" {{ $item == request('tahun') ? 'selected' : '' }}>{{ $item }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<button type="submit" class="btn btn-primary w-100">
									<i class="bi bi-funnel"></i>
									Filter
								</button>
							</div>
							<div class="col-4">
								<a href="{{ route('laporan.tabel.cetak', ['tahun' => request('tahun')]) }}" class="btn btn-success w-100">
									<i class="bi bi-printer"></i>
									Cetak
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		@foreach ($stats as $stat)
			<div class="col-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5 class="mb-0">{{ tanggalIndonesia($stat['periode'], 'bulan tahun') }}</h5>
					</div>
					<div class="card-body py-4-5 px-4">
						<table class="table-striped table">
							<thead>
								<tr class="table-primary text-center">
									<th rowspan="2">Media Sosial</th>
									<th colspan="2">Pengikut</th>
									<th rowspan="2">Persentase</th>
									<th colspan="2">Jangkauan</th>
									<th rowspan="2">Persentase</th>
									<th colspan="2">Interaksi</th>
									<th rowspan="2">Persentase</th>
								</tr>
								<tr class="table-primary text-center">
									<th>Bulan Lalu</th>
									<th>Bulan Ini</th>
									<th>Bulan Lalu</th>
									<th>Bulan Ini</th>
									<th>Bulan Lalu</th>
									<th>Bulan Ini</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($stat['data'] as $key => $item)
									<tr>
										<th>{{ $key }}</th>
										<td>{{ $item['pengikutBulanLalu'] }}</td>
										<td>{{ $item['pengikutBulanIni'] }}</td>
										<td>{{ $item['pengikutPersentase'] }}%</td>
										<td>{{ $item['jangkauanBulanLalu'] }}</td>
										<td>{{ $item['jangkauanBulanIni'] }}</td>
										<td>{{ $item['jangkauanPersentase'] }}%</td>
										<td>{{ $item['interaksiBulanLalu'] }}</td>
										<td>{{ $item['interaksiBulanIni'] }}</td>
										<td>{{ $item['interaksiPersentase'] }}%</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		@endforeach
	</section>
@endsection
