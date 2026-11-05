@extends('layouts.app')

@section('title', 'Registrasi Alumni')

@section('content')
<div class="mx-auto max-w-lg rounded-2xl bg-white p-8 shadow-sm border border-slate-200">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-slate-900">Registrasi Alumni</h1>
        <p class="mt-1 text-sm text-slate-500">Daftarkan akun alumni Anda untuk mengakses portal alumni.</p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
            <input id="name" name="name" type="text" required value="{{ old('name') }}" placeholder="Contoh: Budi Santoso"
                class="mt-1 w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="alumni_number" class="block text-sm font-medium text-slate-700">Nomor Induk Alumni / NIM</label>
            <input id="alumni_number" name="alumni_number" type="text" required value="{{ old('alumni_number') }}" placeholder="Contoh: 2020101001"
                class="mt-1 w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('alumni_number') border-red-500 @enderror">
            @error('alumni_number')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
            <input id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="alumni@example.com"
                class="mt-1 w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('email') border-red-500 @enderror">
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
            <input id="password" name="password" type="password" required placeholder="Minimal 10 karakter"
                class="mt-1 w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('password') border-red-500 @enderror">
            <p class="mt-1 text-xs text-slate-500">Minimal 10 karakter dengan kombinasi huruf besar (A-Z), huruf kecil (a-z), dan angka (0-9).</p>
            @error('password')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="Ulangi password di atas"
                class="mt-1 w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full rounded-lg bg-blue-700 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 transition">
                Daftar Sebagai Alumni
            </button>
        </div>
    </form>

    <div class="mt-6 border-t border-slate-100 pt-4 text-center">
        <p class="text-sm text-slate-600">
            Sudah memiliki akun? 
            <a class="font-semibold text-blue-700 hover:underline" href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection
