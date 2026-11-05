<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request; use Symfony\Component\HttpFoundation\Response;
class EnsureApprovedAlumni { public function handle(Request $request, Closure $next): Response { $user=$request->user(); if (!$user || !$user->isAlumni() || !$user->isApproved() || !$user->hasVerifiedEmail()) abort(403,'Akun alumni belum diverifikasi dan disetujui.'); return $next($request); } }
