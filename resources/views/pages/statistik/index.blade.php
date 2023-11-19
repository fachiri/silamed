@extends('layouts.dashboard')
@section('title', 'Statistik '. $data->sosmed.' ('.$data->name.')')
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
						<a href="{{ route('statistik.create', ['sosmed' => strtolower($data->sosmed)]) }}" class="btn btn-primary">Tambah Data</a>
					</div>
					<div class="table-responsive datatable-minimal">
						<table class="table-striped table" id="tabel-sosmed">
							<thead>
								<tr>
									<th>Periode</th>
									<th>Pengikut</th>
									<th>Jangkauan</th>
									<th>Interaksi</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data->statistiks as $item)
									<tr>
										<td>{{ tanggalIndonesia($item->periode, 'bulan tahun') }}</td>
										<td>{{ $item->pengikut }}</td>
										<td>{{ $item->jangkauan }}</td>
										<td>{{ $item->interaksi }}</td>
										<td>
											<a href="{{ route('statistik.show', $item->uuid) }}" class="badge bg-primary"><i class="bi bi-list-ul"></i></a>
											<a href="{{ route('statistik.edit', $item->uuid) }}" class="badge bg-success"><i class="bi bi-pencil-square"></i></a>
											<x-modal.delete :id="'deleteModal'.$item->uuid" :route="route('statistik.destroy', $item->uuid)" :data="'Periode '. tanggalIndonesia($item->periode, 'bulan tahun')" />
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
			document.getElementById("tabel-sosmed")
		)
		// Move "per page dropdown" selector element out of label
		// to make it work with bootstrap 5. Add bs5 classes.
		function adaptPageDropdown() {
			const selector = dataTable.wrapper.querySelector(".dataTable-selector")
			selector.parentNode.parentNode.insertBefore(selector, selector.parentNode)
			selector.classList.add("form-select")
		}

		// Add bs5 classes to pagination elements
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

		// Patch "per page dropdown" and pagination after table rendered
		dataTable.on("datatable.init", () => {
			adaptPageDropdown()
			refreshPagination()
		})
		dataTable.on("datatable.update", refreshPagination)
		dataTable.on("datatable.sort", refreshPagination)

		// Re-patch pagination after the page was changed
		dataTable.on("datatable.page", adaptPagination)
	</script>
@endpush
