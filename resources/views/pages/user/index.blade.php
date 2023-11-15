@extends('layouts.dashboard')
@section('title', 'Master Pengguna')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/simple-datatable-style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/table-datatable.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="mb-3">
						<a href="{{ route('user.create') }}" class="btn btn-primary">Tambah Data</a>
					</div>
					<div class="table-responsive datatable-minimal">
						<table class="table-striped table" id="tabel-user">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Username</th>
									<th>Email</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $item)
									<tr>
										<td>{{ $item->name }}</td>
										<td>{{ $item->username }}</td>
										<td>{{ $item->email }}</td>
										<td>
											<a href="{{ route('user.show', $item->uuid) }}" class="badge bg-primary"><i class="bi bi-list-ul"></i></a>
											<a href="{{ route('user.edit', $item->uuid) }}" class="badge bg-success"><i class="bi bi-pencil-square"></i></a>
											<x-modal.delete :id="'deleteModal'.$item->uuid" :route="route('user.destroy', $item->uuid)" :data="$item->user" />
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/extensions/simple-datatables.js') }}"></script>
	<script>
		let dataTable = new simpleDatatables.DataTable(
			document.getElementById("tabel-user")
		)
		function adaptPageDropdown() {
			const selector = dataTable.wrapper.querySelector(".dataTable-selector")
			selector.parentNode.parentNode.insertBefore(selector, selector.parentNode)
			selector.classList.add("form-select")
		}

		function adaptPagination() {
			const paginations = dataTable.wrapper.querySelectorAll(
				"ul.dataTable-pagination-list"
			)

			for (const pagination of paginations) {
				pagination.classList.add(...["pagination", "pagination-primary"])
			}

			const paginationLis = dataTable.wrapper.querySelectorAll(
				"ul.dataTable-pagination-list li"
			)

			for (const paginationLi of paginationLis) {
				paginationLi.classList.add("page-item")
			}

			const paginationLinks = dataTable.wrapper.querySelectorAll(
				"ul.dataTable-pagination-list li a"
			)

			for (const paginationLink of paginationLinks) {
				paginationLink.classList.add("page-link")
			}
		}

		const refreshPagination = () => {
			adaptPagination()
		}

		dataTable.on("datatable.init", () => {
			adaptPageDropdown()
			refreshPagination()
		})
		dataTable.on("datatable.update", refreshPagination)
		dataTable.on("datatable.sort", refreshPagination)

		dataTable.on("datatable.page", adaptPagination)
	</script>
@endpush
