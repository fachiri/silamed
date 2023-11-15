@extends('layouts.dashboard')
@section('title', 'Laporan Grafik')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header pb-0">
					<h5 class="mb-0">Filter</h5>
				</div>
				<div class="card-body py-4-5 px-4">
					<form action="{{ route('laporan.grafik') }}" method="GET">
						<div class="row mb-3">
							<div class="col-4">
								<label for="periode" class="form-label">Periode</label>
								<select name="periode" id="periode" class="form-select">
									<option value="tahun" {{ 'tahun' == request('periode') ? 'selected' : '' }}>Tahun</option>
									<option value="triwulan" {{ 'triwulan' == request('periode') ? 'selected' : '' }}>Triwulan</option>
									<option value="bulan" {{ 'bulan' == request('periode') ? 'selected' : '' }}>Bulan</option>
								</select>
							</div>
							<div class="col-4">
								<label for="tahun" class="form-label">Tahun</label>
								<select name="tahun" id="tahun" class="form-select" {{ request('periode') == 'tahun' ? 'disabled' : '' }}>
									@foreach ($tahun as $item)
										<option value="{{ $item }}" {{ $item == request('tahun') ? 'selected' : '' }}>{{ $item }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-4">
								<label for="sosmed" class="form-label">Sosmed</label>
								<select name="sosmed" id="sosmed" class="form-select">
									<option value="semua" {{ 'semua' == request('sosmed') ? 'selected' : '' }}>Semua</option>
									@foreach ($sosmedOptions as $sosmedValue => $sosmedLabel)
										<option value="{{ strtolower($sosmedValue) }}" {{ strtolower($sosmedValue) == request('sosmed') ? 'selected' : '' }}>
											{{ $sosmedLabel }}
										</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<button type="submit" class="btn btn-primary w-100">
									<i class="bi bi-funnel"></i>
									Filter
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header pb-0">
					<h5 class="mb-0">Pengikut Tahun {{ request('periode') == 'tahun' ? reset($tahun).' - '.end($tahun) : request('tahun') }}</h5>
				</div>
				<div class="card-body py-4-5 px-4">
					<div id="linePengikut"></div>
				</div>
			</div>
		</div>
    <div class="col-12">
			<div class="card">
				<div class="card-header pb-0">
					<h5 class="mb-0">Jangkauan Tahun {{ request('periode') == 'tahun' ? reset($tahun).' - '.end($tahun) : request('tahun') }}</h5>
				</div>
				<div class="card-body py-4-5 px-4">
					<div id="lineJangkauan"></div>
				</div>
			</div>
		</div>
    <div class="col-12">
			<div class="card">
				<div class="card-header pb-0">
					<h5 class="mb-0">Interaksi Tahun {{ request('periode') == 'tahun' ? reset($tahun).' - '.end($tahun) : request('tahun') }}</h5>
				</div>
				<div class="card-body py-4-5 px-4">
					<div id="lineInteraksi"></div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/extensions/apexcharts.min.js') }}"></script>
	<script>
		const grafikPengikut = @json($grafikPengikut);
		const grafikJangkauan = @json($grafikJangkauan);
		const grafikInteraksi = @json($grafikInteraksi);

		const linePengikutOptions = {
			chart: {
				type: "line",
				height: 300
			},
			series: grafikPengikut.series,
			xaxis: {
				categories: grafikPengikut.periode,
			},
		}
    const lineJangkauanOptions = {
			chart: {
				type: "line",
				height: 300
			},
			series: grafikJangkauan.series,
			xaxis: {
				categories: grafikJangkauan.periode,
			},
		}
    const lineInteraksiOptions = {
			chart: {
				type: "line",
				height: 300
			},
			series: grafikInteraksi.series,
			xaxis: {
				categories: grafikInteraksi.periode,
			},
		}

		const linePengikut = new ApexCharts(document.querySelector("#linePengikut"), linePengikutOptions)
		const lineJangkauan = new ApexCharts(document.querySelector("#lineJangkauan"), lineJangkauanOptions)
		const lineInteraksi = new ApexCharts(document.querySelector("#lineInteraksi"), lineInteraksiOptions)
		linePengikut.render()
		lineJangkauan.render()
		lineInteraksi.render()
	</script>
@endpush
