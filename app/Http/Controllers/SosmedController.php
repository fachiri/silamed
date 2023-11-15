<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSosmedRequest;
use App\Http\Requests\UpdateSosmedRequest;
use App\Models\Sosmed;

class SosmedController extends Controller
{
    public function index()
    {
        $sosmed = Sosmed::orderBy('created_at', 'asc')->get();

        return view('pages.sosmed.index', compact('sosmed'));
    }

    public function create()
    {
        return view('pages.sosmed.create');
    }

    public function store(StoreSosmedRequest $request)
    {
        try {
            Sosmed::create($request->only('sosmed', 'icon'));

            return redirect()
                ->route('sosmed.index')
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }

    public function show(Sosmed $sosmed)
    {
        return view('pages.sosmed.show', compact('sosmed'));
    }

    public function edit(Sosmed $sosmed)
    {
        return view('pages.sosmed.edit', compact('sosmed'));
    }

    public function update(UpdateSosmedRequest $request, Sosmed $sosmed)
    {
        try {
            $sosmed->sosmed = $request->sosmed;
            $sosmed->icon = $request->icon;
            $sosmed->update();

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

    public function destroy(Sosmed $sosmed)
    {
        try {
            $sosmed->delete();
            
            return redirect()
                ->route('sosmed.index')
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }
}
