<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Laporan Perkembangan Akun Media Sosial</title>
		<style>
			* {
				font-family: 'Calibri', sans-serif;
			}

			.table {
				border-collapse: collapse;
				width: 100%;
			}

			.table td,
			.table th {
				border: 1px solid white;
				padding: 10px 2.5px;
				text-align: center;
			}

			.page-break {
				page-break-after: always;
			}

			.banner {
				margin-bottom: 10px;
			}

			.banner img {
				width: 100%;
			}

			.logo {
				float: left;
			}

			.logo img {
				width: 100px;
				height: auto;
			}
		</style>
	</head>

	<body>
		@foreach ($stats as $stat)
			<div>
				<div class="logo">
					<img src="{{ public_path('images/logo.png') }}">
				</div>
				<div style="text-align: center; color: #4f81bc; margin-right: 100px;">
					<h3 style="margin-bottom: 5px !important; text-transform: uppercase;">
						Perkembangan Akun Media Sosial <br>
						TVRI Gorontalo
					</h3>
					<p style="margin-bottom: 10px; margin-top: 0;">Bulan {{ tanggalIndonesia($stat['periode'], 'bulan tahun') }}</p>
				</div>
				<div class="banner">
					<img src="{{ public_path('images/banner.png') }}">
				</div>
				<div>
					<table class="table">
						<thead style="color: rgb(231, 231, 231)99, 199, 199); font-weight: 500;">
							<tr style="background-color: #4f81bc">
								<td rowspan="2">Media Sosial</td>
								<td colspan="3">Pengikut</td>
								<td rowspan="2">Persentase</td>
								<td colspan="3">Jangkauan</td>
								<td rowspan="2">Persentase</td>
								<td colspan="3">Interaksi</td>
								<td rowspan="2">Persentase</td>
							</tr>
							<tr style="background-color: #4f81bc">
								<td>Bulan Lalu</td>
								<td>Bulan Ini</td>
								<td>Target</td>
								<td>Bulan Lalu</td>
								<td>Bulan Ini</td>
								<td>Target</td>
								<td>Bulan Lalu</td>
								<td>Bulan Ini</td>
								<td>Target</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($stat['data'] as $key => $item)
								<tr style="background-color: {{ $loop->iteration % 2 == 0 ? '#d0d8e7' : '#e8eef4' }}">
									<td>{{ $key }}</td>
									<td>{{ $item['pengikutBulanLalu'] }}</td>
									<td>{{ $item['pengikutBulanIni'] }}</td>
									<td>{{ $item['targetPengikut'] }}</td>
									<td>{{ $item['pengikutPersentase'] }}%</td>
									<td>{{ $item['jangkauanBulanLalu'] }}</td>
									<td>{{ $item['jangkauanBulanIni'] }}</td>
									<td>{{ $item['targetJangkauan'] }}</td>
									<td>{{ $item['jangkauanPersentase'] }}%</td>
									<td>{{ $item['interaksiBulanLalu'] }}</td>
									<td>{{ $item['interaksiBulanIni'] }}</td>
									<td>{{ $item['targetInteraksi'] }}</td>
									<td>{{ $item['interaksiPersentase'] }}%</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="page-break"></div>
		@endforeach
	</body>

</html>
