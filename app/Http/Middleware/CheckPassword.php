<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class CheckPassword
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user->username === $user->password || Hash::check($user->username, $user->password)) {
            return redirect()
                ->route('setting.index')
                ->withErrors(['message' => 'Untuk alasan keamanan, silahkan ganti password anda.']);
        }

        return $next($request);
    }
}
