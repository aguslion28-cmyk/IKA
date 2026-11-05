<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller; use App\Http\Requests\RegisterAlumniRequest; use App\Models\User; use App\Support\Activity; use Illuminate\Auth\Events\Registered; use Illuminate\Http\RedirectResponse; use Illuminate\View\View;
class RegisteredUserController extends Controller {
 public function create(): View { return view('auth.register'); }
 public function store(RegisterAlumniRequest $request): RedirectResponse { $user=User::create([...$request->validated(),'role'=>'alumni','account_status'=>'pending']); event(new Registered($user)); Activity::log('register','Pendaftaran alumni baru',$user->id); auth()->login($user); return redirect()->route('verification.notice')->with('status','Registrasi berhasil. Silakan verifikasi email.'); }
}
