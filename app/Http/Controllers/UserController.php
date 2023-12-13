<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->get();

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            User::create($request->only('name', 'username', 'email'));

            return redirect()
                ->route('user.index')
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }

    public function show(User $user)
    {
        return view('pages.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->update();

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

    public function destroy(User $user)
    {
        try {
            $user->delete();
            
            return redirect()
                ->route('user.index')
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan saat mengedit data.', $th->getMessage()]]);
        }
    }
}
