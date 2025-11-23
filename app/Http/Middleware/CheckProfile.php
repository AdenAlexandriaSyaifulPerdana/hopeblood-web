<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfile
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {

            $user = Auth::user();

            $biodataIncomplete = (
                empty($user->name) ||
                empty($user->usia) ||
                empty($user->alamat) ||
                empty($user->golongan_darah)
            );

            // Jangan redirect kalau lagi isi biodata
            if ($biodataIncomplete && !$request->routeIs('complete.profile')) {
                return redirect()->route('complete.profile');
            }
        }

        return $next($request);
    }
}
