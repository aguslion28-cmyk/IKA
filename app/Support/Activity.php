<?php
namespace App\Support;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
class Activity {
 public static function log(string $action, string $description, ?int $userId = null): void {
  $request = app(Request::class);
  ActivityLog::create(['user_id'=>$userId ?? auth()->id(),'action'=>$action,'description'=>$description,'ip_address'=>$request->ip(),'user_agent'=>substr((string)$request->userAgent(),0,500),'created_at'=>now()]);
 }
}
