<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory; use Illuminate\Support\Str;
class UserFactory extends Factory { public function definition(): array { return ['name'=>fake()->name(),'alumni_number'=>Str::upper(Str::random(10)),'email'=>fake()->unique()->safeEmail(),'email_verified_at'=>now(),'password'=>'StrongPass123','role'=>'alumni','account_status'=>'approved','remember_token'=>Str::random(10)]; } }
