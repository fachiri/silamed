@extends('layouts.dashboard')
@section('title', 'Pengaturan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
          <h5 class="mb-4">Ganti Password</h5>
					<form action="{{ route('setting.change_password') }}" method="POST">
						@csrf
						<div class="form-group my-2">
							<label for="old_password" class="form-label">Password Sekarang</label>
							<input type="password" name="old_password" id="old_password" class="form-control" placeholder="Masukkan Password Lama">
						</div>
						<div class="form-group my-2">
							<label for="new_password" class="form-label">Password Baru</label>
							<input type="password" name="new_password" id="new_password" class="form-control" placeholder="Masukkan Password Baru">
						</div>
						<div class="form-group my-2">
							<label for="repeat_new_password" class="form-label">Ulangi Password Baru</label>
							<input type="password" name="repeat_new_password" id="repeat_new_password" class="form-control" placeholder="Ulangi Password Baru">
						</div>
						<div class="form-group d-flex justify-content-end my-2">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
