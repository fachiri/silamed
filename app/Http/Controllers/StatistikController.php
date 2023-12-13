<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatistikRequest;
use App\Http\Requests\UpdateStatistikRequest;
use App\Models\Sosmed;
use App\Models\Statistik;
use App\Models\Target;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        $data = Sosmed::where('sosmed', $request->sosmed)
            ->with(['statistiks' => function ($query) {
                $query->orderBy('periode', 'asc');
            }])
            ->first();


        return view('pages.statistik.index', compact('data'));
    }

    public function create(Request $request)
    {
        $data = Sosmed::where('sosmed', $request->sosmed)->first();

        return view('pages.statistik.create', compact('data'));
    }

    public function store(StoreStatistikRequest $request)
    {
        try {
            $data = $request->all();
            $data['periode'] = $data['tahun'] . '-' . $data['bulan'] . '-' . '01';

            $stat = Statistik::where(['periode' => $data['periode'], 'sosmed_id' => $request->sosmed_id])->first();
            if ($stat) {
                throw new \Error('Statistik ' . $stat->sosmed->sosmed . ' untuk bulan <b>' . tanggalIndonesia($stat->periode, 'bulan tahun') . '</b> sudah ada. Silahkan edit untuk melakukan perubahan.');
            }

            Statistik::create($data);

            return redirect()
                ->route('statistik.index', ['sosmed' => strtolower($data['sosmed'])])
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }

    public function show(Statistik $statistik)
    {
        $statBulanIni = $statistik;
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

        $sosmed = Sosmed::where('id', $statBulanIni->sosmed_id)->first();
        $statBulanLalu = Statistik::where(['periode' => $periodeBulanLalu, 'sosmed_id' => $sosmed->id])->first();

        if (!isset($statBulanLalu)) {
            return redirect()
                ->back()
                ->withErrors(['message' => ['Data bulan sebelumnya tidak ditemukan.']]);
        }

        $persentase = (object) [
            'pengikut' => number_format((($statBulanIni->pengikut - $statBulanLalu->pengikut) / $statBulanLalu->pengikut) * 100, 2),
            'jangkauan' => number_format((($statBulanIni->jangkauan - $statBulanLalu->jangkauan) / $statBulanLalu->jangkauan) * 100, 2),
            'interaksi' => number_format((($statBulanIni->interaksi - $statBulanLalu->interaksi) / $statBulanLalu->interaksi) * 100, 2),
        ];

        $target = Target::where(['periode' => $periodeBulanIni, 'sosmed_id' => $sosmed->id])->first();

        return view('pages.statistik.show', compact('statBulanIni', 'statBulanLalu', 'persentase', 'target'));
    }

    public function edit(Statistik $statistik)
    {
        $statBulanIni = $statistik;

        return view('pages.statistik.edit', compact('statBulanIni'));
    }

    public function update(UpdateStatistikRequest $request, Statistik $statistik)
    {
        try {
            $statistik->pengikut = $request->pengikut;
            $statistik->jangkauan = $request->jangkauan;
            $statistik->interaksi = $request->interaksi;

            $statistik->update();

            return redirect()
                ->back()
                ->with('success', 'Data berhasil diupdate!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }

    public function destroy(Statistik $statistik)
    {
        try {
            $statistik->delete();

            return redirect()
                ->route('statistik.index', ['sosmed' => $statistik->sosmed->sosmed])
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }

    public function evaluasi(Request $request, $uuid)
    {
        try {
            $statistik = Statistik::where('uuid', $uuid)->first();

            if(!$statistik) {
                throw new \Error('Statistik tidak ditemukan!');
            }

            $statistik->evaluasi = $request->evaluasi;
            $statistik->update();

            return redirect()
                ->back()
                ->with('success', 'Data evaluasi berhasil dibuat!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }
}
