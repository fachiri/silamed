@extends('layouts.dashboard')
@section('title', 'Sosial Media '. $sosmed->sosmed)
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="mb-4 d-flex justify-content-between">
						<h5 class="mb-0">{{ $sosmed->sosmed }}</h5>
						<div>
							<a href="{{ route('sosmed.edit', $sosmed->uuid) }}" class="badge bg-success"><i class="bi bi-pencil-square"></i> Edit</a>
							<x-modal.delete text="Hapus" :id="'deleteModal'.$sosmed->uuid" :route="route('sosmed.destroy', $sosmed->uuid)" :data="$sosmed->sosmed" />
						</div>
					</div>
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th>Sosial Media</th>
								<td>{{ $sosmed->sosmed }}</td>
							</tr>
							<tr>
								<th>Icon</th>
								<td><i class="bi bi-{{ $sosmed->icon }}"></i></td>
							</tr>
							<tr>
								<th>Nama Akun</th>
								<td>{{ $sosmed->name }}</td>
							</tr>
							<tr>
								<th>Tautan Akun</th>
								<td><a href="{{ $sosmed->link }}">{{ $sosmed->link }}</a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
