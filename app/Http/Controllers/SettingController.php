<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view("pages.pengaturan.index");
    }

    public function change_password(ChangePasswordRequest $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->firstOrFail();

            $user->password = Hash::make($request->new_password);
            $user->save();

            Session::flush();
            Auth::logout();

            return redirect()
                ->route('login')
                ->with('success', 'Password berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => ['Terjadi kesalahan!', $e->getMessage()]]);
        }
    }
}
