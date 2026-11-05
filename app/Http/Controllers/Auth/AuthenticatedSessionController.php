<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller; use App\Support\Activity; use Illuminate\Http\Request; use Illuminate\Support\Facades\Auth; use Illuminate\Validation\ValidationException; use Illuminate\View\View; use Illuminate\Http\RedirectResponse;
class AuthenticatedSessionController extends Controller {
 public function create(): View { return view('auth.login'); }
 public function store(Request $request): RedirectResponse { $credentials=$request->validate(['email'=>['required','email'],'password'=>['required','string']]); if (!Auth::attempt($credentials,$request->boolean('remember'))) throw ValidationException::withMessages(['email'=>'Email atau password tidak sesuai.']); $request->session()->regenerate(); $user=$request->user(); if ($user->account_status==='disabled') { Auth::logout(); $request->session()->invalidate(); $request->session()->regenerateToken(); return back()->withErrors(['email'=>'Akun dinonaktifkan.']); } Activity::log('login','Login berhasil',$user->id); return redirect()->intended($user->isAdmin()?route('admin.dashboard'):route('alumni.dashboard')); }
 public function destroy(Request $request): RedirectResponse { Activity::log('logout','Logout'); Auth::guard('web')->logout(); $request->session()->invalidate(); $request->session()->regenerateToken(); return redirect()->route('login'); }
}
