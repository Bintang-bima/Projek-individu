<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request. Only users with the "admin" role may proceed.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isAdmin()) {
            // Lebih ramah daripada halaman error 403: kembali ke beranda + pesan.
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Akses ditolak. Halaman ini hanya untuk admin.'], 403);
            }

            return redirect()->route('home')->with('error', 'Akses ditolak. Halaman admin hanya untuk admin.');
        }

        return $next($request);
    }
}
