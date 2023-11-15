@extends('layouts.dashboard')
@section('title', 'Detail Pengguna')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="mb-4 d-flex justify-content-between">
						<h5 class="mb-0">Detail {{ $user->name }}</h5>
						<div>
							<a href="{{ route('user.edit', $user->uuid) }}" class="badge bg-success"><i class="bi bi-pencil-square"></i> Edit</a>
							<x-modal.delete text="Hapus" :id="'deleteModal'.$user->uuid" :route="route('user.destroy', $user->uuid)" :data="$user->name" />
						</div>
					</div>
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th>Nama Lengkap</th>
								<td>{{ $user->name }}</td>
							</tr>
							<tr>
								<th>Username</th>
								<td>{{ $user->username }}</td>
							</tr>
							<tr>
								<th>Email</th>
								<td>{{ $user->email }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
