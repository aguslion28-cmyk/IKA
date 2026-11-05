<?php
namespace Database\Seeders;
use App\Models\User; use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder { public function run(): void { User::firstOrCreate(['email'=>env('ADMIN_EMAIL','admin@example.test')],['name'=>env('ADMIN_NAME','Administrator'),'alumni_number'=>'ADMIN-001','password'=>env('ADMIN_PASSWORD','ChangeMe123!'),'role'=>'admin','account_status'=>'approved','email_verified_at'=>now()]); } }
