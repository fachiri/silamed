@extends('layouts.dashboard')
@section('title', 'Dasbor')
@push('css')
  <link rel="stylesheet" href="{{ asset('css/iconly.css') }}">
@endpush
@section('content')
	<section>
		<div class="row">
			@if (count($sosmed) > 0)
				@foreach ($sosmed as $item)
					<div class="col-6">
						<div class="card">
							<div class="card-header pb-0">
								<h5 class="mb-0">
									<i class="bi bi-{{ $item->icon }}"></i>
									<span>{{ $item->sosmed }}</span>
								</h5>
							</div>
							<div class="card-body py-4-5 px-4">
								<div class="row">
									<div class="col-4">
										<div class="d-flex justify-content-start">
											<div class="stats-icon blue mb-2">
												<i class="iconly-boldProfile"></i>
											</div>
										</div>
										<div>
											<h6 class="text-muted font-semibold">Pengikut</h6>
											<h6 class="mb-0 font-extrabold">{{ $item->statistiks[0]->pengikut }}</h6>
										</div>
									</div>
									<div class="col-4">
										<div class="d-flex justify-content-start">
											<div class="stats-icon purple mb-2">
												<i class="iconly-boldShow"></i>
											</div>
										</div>
										<div>
											<h6 class="text-muted font-semibold">Jangkauan</h6>
											<h6 class="mb-0 font-extrabold">{{ $item->statistiks[0]->jangkauan }}</h6>
										</div>
									</div>
									<div class="col-4">
										<div class="d-flex justify-content-start">
											<div class="stats-icon green mb-2">
												<i class="iconly-boldAdd-User"></i>
											</div>
										</div>
										<div>
											<h6 class="text-muted font-semibold">Interaksi</h6>
											<h6 class="mb-0 font-extrabold">{{ $item->statistiks[0]->interaksi }}</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			@else
			<div class="col-12">
				<div class="card">
					<div class="card-body py-4-5 px-4 text-center">
						<h5 class="mb-3">Data Sosmed Tidak Ditemukan</h5>
						<a href="{{ route('sosmed.index') }}" class="btn btn-primary">Tambah Sosmed Disini</a>
					</div>
				</div>
			</div>
			@endif
		</div>
	</section>
@endsection