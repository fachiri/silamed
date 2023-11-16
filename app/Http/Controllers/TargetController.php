<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTargetRequest;
use App\Http\Requests\UpdateTargetRequest;
use App\Models\Sosmed;
use App\Models\Target;

class TargetController extends Controller
{
    public function index()
    {
        $target = Target::orderBy('periode', 'asc')->get();

        return view('pages.target.index', compact('target'));
    }

    public function create()
    {
        $sosmed = Sosmed::all();

        return view('pages.target.create', compact('sosmed'));
    }

    public function store(StoreTargetRequest $request)
    {
        try {
            $data = $request->all();
            $data['periode'] = $data['tahun'] . '-' . $data['bulan'] . '-' . '01';

            $target = Target::where(['periode' => $data['periode'], 'sosmed_id' => $request->sosmed_id])->first();
            if ($target) {
                throw new \Error('Target ' . $target->sosmed->sosmed . ' untuk bulan <b>' . tanggalIndonesia($target->periode, 'bulan tahun') . '</b> sudah ada. Silahkan edit untuk melakukan perubahan.');
            }

            Target::create($data);

            return redirect()
                ->route('target.index')
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }

    public function show(Target $target)
    {
        return view('pages.target.show', compact('target'));
    }

    public function edit(Target $target)
    {
        return view('pages.target.edit', compact('target'));
    }

    public function update(UpdateTargetRequest $request, Target $target)
    {
        try {
            $target->pengikut = $request->pengikut;
            $target->jangkauan = $request->jangkauan;
            $target->interaksi = $request->interaksi;
            $target->update();

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

    public function destroy(Target $target)
    {
        try {
            $target->delete();
            
            return redirect()
                ->route('target.index')
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }
}
