<?php
namespace Tests\Feature;
use App\Models\User; use Illuminate\Auth\Events\Registered; use Illuminate\Foundation\Testing\RefreshDatabase; use Illuminate\Support\Facades\Event; use Tests\TestCase;
class AuthenticationTest extends TestCase { use RefreshDatabase;
 public function test_alumni_can_register_and_is_pending(): void { $this->post('/register',['name'=>'Test Alumni','alumni_number'=>'A-100','email'=>'a@example.test','password'=>'StrongPass123','password_confirmation'=>'StrongPass123'])->assertRedirect(route('verification.notice')); $this->assertDatabaseHas('users',['email'=>'a@example.test','role'=>'alumni','account_status'=>'pending']); }
 public function test_admin_dashboard_requires_admin(): void { $u=User::factory()->create(['role'=>'alumni','account_status'=>'approved','email_verified_at'=>now()]); $this->actingAs($u)->get('/admin')->assertForbidden(); }
 public function test_pending_alumni_cannot_open_alumni_dashboard(): void { $u=User::factory()->create(['role'=>'alumni','account_status'=>'pending','email_verified_at'=>now()]); $this->actingAs($u)->get('/alumni')->assertForbidden(); }
}
