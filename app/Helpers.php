<?php

if (!function_exists('tanggalIndonesia')) {
  function tanggalIndonesia($tanggal, $option = null)
  {
    $bulan = [
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember',
    ];

    $tanggalArray = explode('-', $tanggal);
    $bulanAngka = (int) $tanggalArray[1];

    switch ($option) {
      case 'bulan':
        return $bulan[$bulanAngka];

      case 'bulan tahun':
        return $bulan[$bulanAngka].' '.$tanggalArray[0];
      
      default:
        return $tanggalArray[2].' '.$bulan[$bulanAngka].' '.$tanggalArray[0];
    }

  }
}
