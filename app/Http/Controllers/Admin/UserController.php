<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\User; use App\Support\Activity; use Illuminate\Http\Request; use Illuminate\Http\RedirectResponse; use Illuminate\View\View;
class UserController extends Controller {
 public function index(Request $request): View { $users=User::query()->when($request->q,fn($q,$v)=>$q->where(fn($x)=>$x->where('name','like',"%$v%")->orWhere('email','like',"%$v%")->orWhere('alumni_number','like',"%$v%")))->when($request->status,fn($q,$v)=>$q->where('account_status',$v))->when($request->role,fn($q,$v)=>$q->where('role',$v))->latest()->paginate(15)->withQueryString(); return view('admin.users.index',compact('users')); }
 public function update(Request $request, User $user): RedirectResponse { $data=$request->validate(['account_status'=>['required','in:pending,approved,rejected,disabled'],'role'=>['required','in:admin,alumni']]); if ($user->is($request->user()) && $data['role']!=='admin') return back()->withErrors('Anda tidak dapat menurunkan role akun sendiri.'); $user->update($data); Activity::log('user_update',"Perubahan akun {$user->email}: status {$data['account_status']}, role {$data['role']}"); return back()->with('status','Data pengguna berhasil diperbarui.'); }
}
