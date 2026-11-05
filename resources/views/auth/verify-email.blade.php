@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
<div class="mx-auto max-w-lg rounded-2xl bg-white p-8 shadow-sm border border-slate-200">
    <div class="text-center">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 mb-4">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-slate-900">Verifikasi Email Anda</h1>
        <p class="mt-2 text-sm text-slate-600">
            Terima kasih telah mendaftar! Tautan verifikasi telah dikirim ke alamat email Anda: 
            <span class="font-semibold text-slate-800">{{ auth()->user()?->email }}</span>.
        </p>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-lg bg-green-50 p-3 text-sm text-green-700 border border-green-200 text-center">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full rounded-lg bg-blue-700 py-2.5 text-sm font-semibold text-white hover:bg-blue-800 transition">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm text-slate-500 hover:text-slate-800 underline">
                Keluar / Ganti Akun
            </button>
        </form>
    </div>

    @if (app()->environment('local'))
        <div class="mt-6 rounded-lg bg-slate-50 p-4 border border-slate-200 text-xs text-slate-600">
            <p class="font-semibold text-slate-700 mb-1">💡 Catatan Pengujian Lokal:</p>
            <p>Karena pengiriman email diatur ke driver <code class="bg-slate-200 px-1 py-0.5 rounded">log</code>, tautan verifikasi tersimpan di file: <code class="bg-slate-200 px-1 py-0.5 rounded">storage/logs/laravel.log</code>.</p>
        </div>
    @endif
</div>
@endsection
