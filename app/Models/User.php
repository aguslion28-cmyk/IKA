<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable implements MustVerifyEmail {
 use HasFactory, Notifiable;
 protected $fillable = ['name','alumni_number','email','password','role','account_status'];
 protected $hidden = ['password','remember_token'];
 protected function casts(): array { return ['email_verified_at'=>'datetime','password'=>'hashed']; }
 public function isAdmin(): bool { return $this->role === 'admin'; }
 public function isAlumni(): bool { return $this->role === 'alumni'; }
 public function isApproved(): bool { return $this->account_status === 'approved'; }
 public function activityLogs() { return $this->hasMany(ActivityLog::class); }
}
