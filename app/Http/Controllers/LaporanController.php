<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use App\Models\Statistik;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function grafik(Request $request)
    {
        if (!$request->has('periode') || !$request->has('sosmed')) {
            return redirect()->route('laporan.grafik', [
                'periode' => 'bulan',
                'tahun' => date('Y'),
                'sosmed' => 'semua',
            ]);
        }

        if (!$request->has('tahun')) {
            return redirect()->route('laporan.grafik', [
                'periode' => $request->periode,
                'tahun' => date('Y'),
                'sosmed' => $request->sosmed,
            ]);
        }

        $sosmedOptions = Sosmed::pluck('sosmed', 'sosmed');
        $statistiks = Statistik::all();

        $oldestYear = (int)$statistiks->pluck('periode')->min();
        $newestYear = (int)$statistiks->pluck('periode')->max();

        $tahun = range($oldestYear, $newestYear);
        $triwulan = ['Januari - Maret', 'April - Juni', 'Juli - September', 'Oktober - Desember'];
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $requestedPeriode = $request->periode;
        $requestedYear = $request->tahun;
        $requestedSosmed = $request->sosmed;

        $sosmed = Sosmed::when($requestedSosmed !== 'semua', function ($query) use ($requestedSosmed) {
            $query->where('sosmed', $requestedSosmed);
        })->with(['statistiks' => function ($query) use ($requestedYear, $requestedPeriode) {
            if ($requestedPeriode == 'tahun') {
                $query->whereMonth('periode', 12);
            } else {
                $query->whereYear('periode', $requestedYear);
            }
            $query->orderBy('periode', 'asc');
        }])->get();

        $grafikPengikut = (object) [
            'series' => [],
            'periode' => []
        ];

        $grafikJangkauan = (object) [
            'series' => [],
            'periode' => []
        ];

        $grafikInteraksi = (object) [
            'series' => [],
            'periode' => []
        ];

        if ($request->periode == 'tahun') {
            $grafikPengikut->periode = $tahun;
            $grafikJangkauan->periode = $tahun;
            $grafikInteraksi->periode = $tahun;

            foreach ($sosmed as $key => $item) {
                $dataPengikut = [];
                $dataJangkauan = [];
                $dataInteraksi = [];

                for ($i = 0; $i < count($tahun); $i++) {
                    if (isset($item->statistiks[$i])) {
                        $dataPengikut[$i] = $item->statistiks[$i]->pengikut;
                        $dataJangkauan[$i] = $item->statistiks[$i]->jangkauan;
                        $dataInteraksi[$i] = $item->statistiks[$i]->interaksi;
                    } else {
                        $dataPengikut[$i] = null;
                        $dataJangkauan[$i] = null;
                        $dataInteraksi[$i] = null;
                    }
                }

                $grafikPengikut->series[$key] = (object) [
                    'name' => $item->sosmed,
                    'data' => $dataPengikut,
                ];

                $grafikJangkauan->series[$key] = (object) [
                    'name' => $item->sosmed,
                    'data' => $dataJangkauan,
                ];

                $grafikInteraksi->series[$key] = (object) [
                    'name' => $item->sosmed,
                    'data' => $dataInteraksi,
                ];
            }
        }

        if ($request->periode == 'triwulan') {
            $grafikPengikut->periode = $triwulan;
            $grafikJangkauan->periode = $triwulan;
            $grafikInteraksi->periode = $triwulan;

            foreach ($sosmed as $key => $item) {
                $dataPengikut = [];
                $dataJangkauan = [];
                $dataInteraksi = [];
                $j = 0;

                for ($i = 0; $i < count($triwulan); $i++) {
                    $startMonth = $i * 3;
                    $endMonth = $startMonth + 2;

                    for ($month = $startMonth; $month <= $endMonth; $month++) {
                        if (isset($item->statistiks[$month])) {
                            $dataPengikut[$j] = $item->statistiks[$month]->pengikut;
                            $dataJangkauan[$j] = $item->statistiks[$month]->jangkauan;
                            $dataInteraksi[$j] = $item->statistiks[$month]->interaksi;
                        } else {
                            $dataPengikut[$j] = null;
                            $dataJangkauan[$j] = null;
                            $dataInteraksi[$j] = null;
                        }
                        $j++;
                    }
                }

                $grafikPengikut->series[$key] = (object) [
                    'name' => $item->sosmed,
                    'data' => $dataPengikut,
                ];

                $grafikJangkauan->series[$key] = (object) [
                    'name' => $item->sosmed,
                    'data' => $dataJangkauan,
                ];

                $grafikInteraksi->series[$key] = (object) [
                    'name' => $item->sosmed,
                    'data' => $dataInteraksi,
                ];
            }
        }

        if ($request->periode == 'bulan') {
            $grafikPengikut->periode = $bulan;
            $grafikJangkauan->periode = $bulan;
            $grafikInteraksi->periode = $bulan;

            foreach ($sosmed as $key => $item) {
                $dataPengikut = [];
                $dataJangkauan = [];
                $dataInteraksi = [];

                for ($i = 0; $i < count($bulan); $i++) {
                    if (isset($item->statistiks[$i])) {
                        $dataPengikut[$i] = $item->statistiks[$i]->pengikut;
                        $dataJangkauan[$i] = $item->statistiks[$i]->jangkauan;
                        $dataInteraksi[$i] = $item->statistiks[$i]->interaksi;
                    } else {
                        $dataPengikut[$i] = null;
                        $dataJangkauan[$i] = null;
                        $dataInteraksi[$i] = null;
                    }
                }

                $grafikPengikut->series[$key] = (object) [
                    'name' => $item->sosmed,
                    'data' => $dataPengikut,
                ];

                $grafikJangkauan->series[$key] = (object) [
                    'name' => $item->sosmed,
                    'data' => $dataJangkauan,
                ];

                $grafikInteraksi->series[$key] = (object) [
                    'name' => $item->sosmed,
                    'data' => $dataInteraksi,
                ];
            }
        }

        return view('pages.laporan.grafik', compact('sosmedOptions', 'tahun', 'grafikPengikut', 'grafikJangkauan', 'grafikInteraksi'));
    }

    public function tabel(Request $request)
    {
        if (!$request->has('tahun')) {
            return redirect()->route('laporan.tabel', [
                'tahun' => date('Y'),
            ]);
        }

        $statistiks = Statistik::all();
        $oldestYear = (int)$statistiks->pluck('periode')->min();
        $newestYear = (int)$statistiks->pluck('periode')->max();
        $tahun = range($oldestYear, $newestYear);

        $requestedYear = $request->tahun;
        $sosmed = Sosmed::with(['statistiks' => function ($query) use ($requestedYear) {
            $query->whereYear('periode', $requestedYear);
            $query->orderBy('periode', 'asc');
        }])->get();

        $stats = [];

        for ($i = 0; $i < 12; $i++) {
            $month = sprintf('%02d', $i + 1);
            $periode = $requestedYear . '-' . $month . '-01';
            $stats[$i]['periode'] = $periode;

            foreach ($sosmed as $sosmedItem) {
                $statBulanIni = Statistik::where(['periode' => $periode, 'sosmed_id' => $sosmedItem->id])->first();
                if (isset($statBulanIni)) {
                    $periodeBulanIni = $statBulanIni->periode;

                    $periodeBulanIniArray = explode('-', $periodeBulanIni);
                    $year = $periodeBulanIniArray[0];
                    $month = $periodeBulanIniArray[1];
                    if ($month == 1) {
                        $year = $year - 1;
                        $month = 12;
                    } else {
                        $month = $month - 1;
                    }

                    $periodeBulanLalu = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
                    $statBulanLalu = Statistik::where(['periode' => $periodeBulanLalu, 'sosmed_id' => $sosmedItem->id])->first();
                }

                $pengikutBulanIni = isset($statBulanIni) ? $statBulanIni->pengikut : 1;
                $pengikutBulanLalu = isset($statBulanLalu) ? $statBulanLalu->pengikut : 1;
                $jangkauanBulanIni = isset($statBulanIni) ? $statBulanIni->jangkauan : 1;
                $jangkauanBulanLalu = isset($statBulanLalu) ? $statBulanLalu->jangkauan : 1;
                $interaksiBulanIni = isset($statBulanIni) ? $statBulanIni->interaksi : 1;
                $interaksiBulanLalu = isset($statBulanLalu) ? $statBulanLalu->interaksi : 1;

                $stats[$i]['data'][$sosmedItem->sosmed] = [
                    'pengikutBulanIni' => $pengikutBulanIni,
                    'pengikutBulanLalu' => $pengikutBulanLalu,
                    // 'pengikutPersentase' => number_format((($pengikutBulanIni - $pengikutBulanLalu) / $pengikutBulanLalu) * 100, 2),
                    'jangkauanBulanIni' => $jangkauanBulanIni,
                    'jangkauanBulanLalu' => $jangkauanBulanLalu,
                    // 'jangkauanPersentase' => number_format((($jangkauanBulanIni - $jangkauanBulanLalu) / $jangkauanBulanLalu) * 100, 2),
                    'interaksiBulanIni' => $interaksiBulanIni,
                    'interaksiBulanLalu' => $interaksiBulanLalu,
                    // 'interaksiPersentase' => number_format((($interaksiBulanIni - $interaksiBulanLalu) / $interaksiBulanLalu) * 100, 2),
                    'pengikutPersentase' => $pengikutBulanLalu > 0 ? number_format((($pengikutBulanIni - $pengikutBulanLalu) / $pengikutBulanLalu) * 100, 2) : ($pengikutBulanLalu == 0 && $pengikutBulanIni > 0 ? 100 : 0),
                    'jangkauanPersentase' => $jangkauanBulanLalu > 0 ? number_format((($jangkauanBulanIni - $jangkauanBulanLalu) / $jangkauanBulanLalu) * 100, 2) : ($jangkauanBulanLalu == 0 && $jangkauanBulanIni > 0 ? 100 : 0),
                    'interaksiPersentase' => $interaksiBulanLalu > 0 ? number_format((($interaksiBulanIni - $interaksiBulanLalu) / $interaksiBulanLalu) * 100, 2) : ($interaksiBulanLalu == 0 && $interaksiBulanIni > 0 ? 100 : 0),
                ];
            }
        }

        return view('pages.laporan.tabel', compact('tahun', 'stats'));
    }

    public function tabel_cetak(Request $request)
    {
        if (!$request->has('tahun')) {
            return redirect()->route('laporan.tabel', [
                'tahun' => date('Y'),
            ]);
        }

        $statistiks = Statistik::all();
        $oldestYear = (int)$statistiks->pluck('periode')->min();
        $newestYear = (int)$statistiks->pluck('periode')->max();
        $tahun = range($oldestYear, $newestYear);

        $requestedYear = $request->tahun;
        $sosmed = Sosmed::with(['statistiks' => function ($query) use ($requestedYear) {
            $query->whereYear('periode', $requestedYear);
            $query->orderBy('periode', 'asc');
        }])->get();

        $stats = [];

        for ($i = 0; $i < 12; $i++) {
            $month = sprintf('%02d', $i + 1);
            $periode = $requestedYear . '-' . $month . '-01';
            $stats[$i]['periode'] = $periode;

            foreach ($sosmed as $sosmedItem) {
                $statBulanIni = Statistik::where(['periode' => $periode, 'sosmed_id' => $sosmedItem->id])->first();
                if (isset($statBulanIni)) {
                    $periodeBulanIni = $statBulanIni->periode;

                    $periodeBulanIniArray = explode('-', $periodeBulanIni);
                    $year = $periodeBulanIniArray[0];
                    $month = $periodeBulanIniArray[1];
                    if ($month == 1) {
                        $year = $year - 1;
                        $month = 12;
                    } else {
                        $month = $month - 1;
                    }

                    $periodeBulanLalu = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
                    $statBulanLalu = Statistik::where(['periode' => $periodeBulanLalu, 'sosmed_id' => $sosmedItem->id])->first();
                }

                $pengikutBulanIni = isset($statBulanIni) ? $statBulanIni->pengikut : 1;
                $pengikutBulanLalu = isset($statBulanLalu) ? $statBulanLalu->pengikut : 1;
                $jangkauanBulanIni = isset($statBulanIni) ? $statBulanIni->jangkauan : 1;
                $jangkauanBulanLalu = isset($statBulanLalu) ? $statBulanLalu->jangkauan : 1;
                $interaksiBulanIni = isset($statBulanIni) ? $statBulanIni->interaksi : 1;
                $interaksiBulanLalu = isset($statBulanLalu) ? $statBulanLalu->interaksi : 1;

                $stats[$i]['data'][$sosmedItem->sosmed] = [
                    'pengikutBulanIni' => $pengikutBulanIni,
                    'pengikutBulanLalu' => $pengikutBulanLalu,
                    // 'pengikutPersentase' => $statBulanLalu > 0 ? number_format((($pengikutBulanIni - $pengikutBulanLalu) / $pengikutBulanLalu) * 100, 2) : 100, // jika bulanLalu == 0 dan bulanIni > 0, maka 100. jika bulanLalu dan bulanIni == 0, maka 0. else number_format.....
                    'jangkauanBulanIni' => $jangkauanBulanIni,
                    'jangkauanBulanLalu' => $jangkauanBulanLalu,
                    // 'jangkauanPersentase' => $statBulanLalu > 0 ? number_format((($jangkauanBulanIni - $jangkauanBulanLalu) / $jangkauanBulanLalu) * 100, 2) : 100, // jika bulanLalu == 0 dan bulanIni > 0, maka 100. jika bulanLalu dan bulanIni == 0, maka 0. else number_format.....
                    'interaksiBulanIni' => $interaksiBulanIni,
                    'interaksiBulanLalu' => $interaksiBulanLalu,
                    // 'interaksiPersentase' => $statBulanLalu > 0 ? number_format((($interaksiBulanIni - $interaksiBulanLalu) / $interaksiBulanLalu) * 100, 2) : 100, // jika bulanLalu == 0 dan bulanIni > 0, maka 100. jika bulanLalu dan bulanIni == 0, maka 0. else number_format.....
                    'pengikutPersentase' => $pengikutBulanLalu > 0 ? number_format((($pengikutBulanIni - $pengikutBulanLalu) / $pengikutBulanLalu) * 100, 2) : ($pengikutBulanLalu == 0 && $pengikutBulanIni > 0 ? 100 : 0),
                    'jangkauanPersentase' => $jangkauanBulanLalu > 0 ? number_format((($jangkauanBulanIni - $jangkauanBulanLalu) / $jangkauanBulanLalu) * 100, 2) : ($jangkauanBulanLalu == 0 && $jangkauanBulanIni > 0 ? 100 : 0),
                    'interaksiPersentase' => $interaksiBulanLalu > 0 ? number_format((($interaksiBulanIni - $interaksiBulanLalu) / $interaksiBulanLalu) * 100, 2) : ($interaksiBulanLalu == 0 && $interaksiBulanIni > 0 ? 100 : 0),
                ];
            }
        }

        $pdf = Pdf::loadView('export.tabel', compact('stats'));

        return $pdf->stream();
    }
}
