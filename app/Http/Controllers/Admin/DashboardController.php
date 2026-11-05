<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\User; use App\Models\ActivityLog; use Illuminate\View\View;
class DashboardController extends Controller { public function __invoke(): View { return view('admin.dashboard',['totalUsers'=>User::count(),'verified'=>User::whereNotNull('email_verified_at')->count(),'pending'=>User::where('account_status','pending')->count(),'disabled'=>User::where('account_status','disabled')->count(),'activities'=>ActivityLog::with('user')->latest('created_at')->take(10)->get()]); } }
