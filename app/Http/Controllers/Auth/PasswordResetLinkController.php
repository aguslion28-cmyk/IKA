<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
class PasswordResetLinkController extends Controller {
 public function create(): View { return view('auth.forgot-password'); }
 public function store(Request $request): RedirectResponse { $request->validate(['email'=>['required','email']]); $status=Password::sendResetLink($request->only('email')); return $status===Password::RESET_LINK_SENT ? back()->with('status','Jika email terdaftar, tautan reset password akan dikirim.') : back()->with('status','Jika email terdaftar, tautan reset password akan dikirim.'); }
}
