@if ($errors->any())
	<div class="alert alert-light-danger color-danger alert-dismissible show fade">
		<ul class="m-0 ps-4">
			@foreach ($errors->all() as $error)
				<li>{!! $error !!}</li>
			@endforeach
		</ul>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@endif
@if (session('success'))
	<div class="alert alert-light-success color-success alert-dismissible show fade">
		{!! session('success') !!}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@endif
