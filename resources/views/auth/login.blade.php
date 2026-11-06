<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AUTH GATEWAY // CYBERNETIC LOGIN</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;500;600;700&family=Orbitron:wght@500;700;800;900&family=Rajdhani:wght@500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        orbitron: ['Orbitron', 'sans-serif'],
                        chakra: ['Chakra Petch', 'sans-serif'],
                        rajdhani: ['Rajdhani', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        cyber: {
                            cyan: '#00f0ff',
                            magenta: '#ff007f',
                            purple: '#7928ca',
                            yellow: '#fcee0a',
                            dark: '#05070e',
                            glass: 'rgba(11, 17, 33, 0.65)',
                            input: 'rgba(5, 9, 20, 0.75)'
                        }
                    },
                    boxShadow: {
                        'neon-cyan': '0 0 20px rgba(0, 240, 255, 0.45)',
                        'neon-pink': '0 0 20px rgba(255, 0, 127, 0.45)',
                        'glass-card': '0 8px 32px 0 rgba(0, 0, 0, 0.6), inset 0 0 0 1px rgba(255, 255, 255, 0.08)'
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Cyberpunk Custom Animation & Effects */
        body {
            background-color: #04060d;
            background-image: 
                radial-gradient(at 0% 0%, rgba(121, 40, 202, 0.25) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(0, 240, 255, 0.2) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(255, 0, 127, 0.22) 0px, transparent 60%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Perspective 3D Cyber Floor Grid */
        .cyber-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(to right, rgba(0, 240, 255, 0.07) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 240, 255, 0.07) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(ellipse 90% 80% at 50% 50%, black 30%, transparent 80%);
            pointer-events: none;
            z-index: 1;
        }

        /* Subtle scanlines overlay */
        .scanline {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%);
            background-size: 100% 4px;
            z-index: 20;
            pointer-events: none;
            opacity: 0.45;
        }

        /* Glowing Orbs Animation */
        @keyframes driftOrb1 {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.5; }
            50% { transform: translate(60px, 40px) scale(1.15); opacity: 0.8; }
        }
        @keyframes driftOrb2 {
            0%, 100% { transform: translate(0, 0) scale(1.1); opacity: 0.6; }
            50% { transform: translate(-50px, -30px) scale(0.95); opacity: 0.35; }
        }
        .orb-cyan {
            animation: driftOrb1 12s ease-in-out infinite;
        }
        .orb-magenta {
            animation: driftOrb2 15s ease-in-out infinite;
        }

        /* Cyberpunk Glitch & Neon Corner Brackets */
        .cyber-corner-tl {
            clip-path: polygon(0 0, 100% 0, 100% 2px, 2px 2px, 2px 100%, 0 100%);
        }
        .cyber-corner-br {
            clip-path: polygon(calc(100% - 2px) 0, 100% 0, 100% 100%, 0 100%, 0 calc(100% - 2px), calc(100% - 2px) calc(100% - 2px));
        }

        /* Cyber Cut Corner Button */
        .cyber-btn {
            clip-path: polygon(14px 0, 100% 0, 100% calc(100% - 14px), calc(100% - 14px) 100%, 0 100%, 0 14px);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .cyber-btn:hover {
            box-shadow: 0 0 25px rgba(0, 240, 255, 0.75), inset 0 0 15px rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* Input Cyber Glow */
        .cyber-input {
            transition: all 0.2s ease;
        }
        .cyber-input:focus {
            outline: none;
            border-color: #00f0ff;
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.35), inset 0 0 10px rgba(0, 240, 255, 0.1);
        }

        /* Cyber Tag / Tech Badge */
        .tech-badge {
            background: linear-gradient(90deg, rgba(0, 240, 255, 0.15), rgba(255, 0, 127, 0.15));
            border-left: 2px solid #00f0ff;
            border-right: 2px solid #ff007f;
        }

        /* Holographic pulse */
        @keyframes holoPulse {
            0%, 100% { border-color: rgba(0, 240, 255, 0.4); }
            50% { border-color: rgba(255, 0, 127, 0.6); }
        }
        .holo-border {
            animation: holoPulse 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="relative flex min-h-screen items-center justify-center p-4 font-chakra text-slate-200 antialiased selection:bg-cyan-500 selection:text-black">

    <!-- Scanline Filter -->
    <div class="scanline"></div>

    <!-- Perspective Grid Background -->
    <div class="cyber-grid"></div>

    <!-- Ambient Floating Neon Glow Orbs -->
    <div class="orb-cyan pointer-events-none fixed -top-24 -left-24 h-96 w-96 rounded-full bg-cyan-500/25 blur-3xl filter"></div>
    <div class="orb-magenta pointer-events-none fixed -bottom-28 -right-28 h-[28rem] w-[28rem] rounded-full bg-pink-600/25 blur-3xl filter"></div>
    <div class="pointer-events-none fixed top-1/2 left-1/2 h-80 w-80 -translate-x-1/2 -translate-y-1/2 rounded-full bg-purple-600/15 blur-3xl filter"></div>

    <!-- Top Floating Cyber HUD Nav -->
    <header class="fixed top-0 left-0 right-0 z-30 flex items-center justify-between border-b border-cyan-500/20 bg-slate-950/60 px-6 py-3 backdrop-blur-md">
        <a href="/" class="group flex items-center gap-3">
            <div class="relative flex h-8 w-8 items-center justify-center rounded border border-cyan-400 bg-cyan-950/60 text-cyan-400 shadow-[0_0_10px_rgba(0,240,255,0.4)]">
                <svg class="h-4 w-4 transition-transform group-hover:rotate-180 duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <span class="font-orbitron text-sm font-bold tracking-widest text-cyan-400 group-hover:text-cyan-300">F01 // ALUMNI</span>
                <span class="block text-[10px] font-mono tracking-tighter text-slate-400">NET.SYS_v3.52</span>
            </div>
        </a>

        <div class="flex items-center gap-4 text-xs font-mono">
            <div class="hidden items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-950/40 px-3 py-1 text-emerald-400 sm:flex">
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                </span>
                <span class="tracking-wider">SYSTEM_ONLINE</span>
            </div>
            <a href="/" class="text-slate-400 hover:text-cyan-400 transition-colors flex items-center gap-1">
                <span>&larr;</span> BERANDA
            </a>
        </div>
    </header>

    <!-- Main Container Card -->
    <main class="relative z-10 w-full max-w-md pt-14 pb-8">
        
        <!-- Outer Glowing Glass Card -->
        <div class="holo-border relative rounded-2xl border border-cyan-500/30 bg-cyber-glass p-7 sm:p-9 shadow-glass-card backdrop-blur-2xl">
            
            <!-- Tech HUD Corner Accents -->
            <div class="pointer-events-none absolute -top-1 -left-1 h-5 w-5 border-t-2 border-l-2 border-cyan-400"></div>
            <div class="pointer-events-none absolute -top-1 -right-1 h-5 w-5 border-t-2 border-r-2 border-pink-500"></div>
            <div class="pointer-events-none absolute -bottom-1 -left-1 h-5 w-5 border-b-2 border-l-2 border-pink-500"></div>
            <div class="pointer-events-none absolute -bottom-1 -right-1 h-5 w-5 border-b-2 border-r-2 border-cyan-400"></div>

            <!-- Card Header: Title & Holographic Identity -->
            <div class="mb-6 text-center">
                <!-- Glowing Icon -->
                <div class="relative mx-auto mb-4 flex h-16 w-16 items-center justify-center">
                    <div class="absolute inset-0 animate-spin rounded-full border-2 border-dashed border-cyan-500/40 duration-1000"></div>
                    <div class="absolute inset-1 rounded-full border border-pink-500/40"></div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-950 via-slate-900 to-pink-950 border border-cyan-400/50 shadow-[0_0_15px_rgba(0,240,255,0.4)]">
                        <svg class="h-6 w-6 text-cyan-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>

                <!-- Sub-badge -->
                <div class="inline-block px-3 py-0.5 rounded text-[11px] font-mono tracking-widest text-cyan-400 tech-badge uppercase mb-2">
                    // NEURAL_AUTH_GATEWAY
                </div>

                <h1 class="font-orbitron text-2xl sm:text-3xl font-extrabold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-white to-pink-500">
                    AKSES PORTAL
                </h1>
                <p class="mt-1 text-xs font-mono text-slate-400">
                    Otorisasi kredensial identitas alumni & administrator
                </p>
            </div>

            <!-- Flash Status Alert (e.g. Password Reset Success) -->
            @if(session('status'))
                <div class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-500/40 bg-emerald-950/60 p-3.5 text-xs text-emerald-300 shadow-[0_0_15px_rgba(16,185,129,0.25)]">
                    <svg class="h-4 w-4 flex-shrink-0 text-emerald-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <div class="font-mono font-bold tracking-wide text-emerald-400">[ STATUS // OK ]</div>
                        <div>{{ session('status') }}</div>
                    </div>
                </div>
            @endif

            <!-- Validation Error Alert -->
            @if($errors->any())
                <div class="mb-5 rounded-lg border border-red-500/50 bg-red-950/50 p-3.5 text-xs text-red-200 shadow-[0_0_15px_rgba(239,68,68,0.25)]">
                    <div class="flex items-center gap-2 font-mono font-bold tracking-wider text-red-400 mb-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        [ AUTH_BREACH // ERROR ]
                    </div>
                    <ul class="list-disc pl-5 space-y-0.5 text-slate-300">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
                @csrf

                <!-- Email Input Field -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="email" class="block font-mono text-xs tracking-wider text-cyan-400">
                            [01] USER IDENTIFIER (EMAIL)
                        </label>
                        <span class="text-[10px] font-mono text-slate-500">REQ.FIELD</span>
                    </div>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <svg class="h-4 w-4 text-cyan-400/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               required 
                               autocomplete="email"
                               value="{{ old('email') }}" 
                               placeholder="admin@example.test"
                               class="cyber-input w-full rounded-lg border border-cyan-500/30 bg-cyber-input py-2.5 pl-10 pr-4 text-sm font-rajdhani text-white placeholder-slate-500 focus:bg-slate-900/90 transition-all">
                    </div>
                </div>

                <!-- Password Input Field -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block font-mono text-xs tracking-wider text-pink-400">
                            [02] CIPHER KEY (PASSWORD)
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[11px] font-mono text-cyan-400/80 hover:text-cyan-300 hover:underline">
                                Lupa key?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <svg class="h-4 w-4 text-pink-400/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="••••••••••••"
                               class="cyber-input w-full rounded-lg border border-pink-500/30 bg-cyber-input py-2.5 pl-10 pr-10 text-sm font-rajdhani text-white placeholder-slate-500 focus:bg-slate-900/90 transition-all">
                        
                        <!-- Toggle Password Visibility -->
                        <button type="button" 
                                id="togglePasswordBtn"
                                onclick="togglePasswordVisibility()" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-pink-400 transition-colors"
                                title="Lihat / Sembunyikan Password">
                            <svg id="eyeIcon" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Telemetry -->
                <div class="flex items-center justify-between pt-1">
                    <label class="group flex cursor-pointer items-center gap-2 select-none">
                        <div class="relative flex items-center">
                            <input type="checkbox" 
                                   name="remember" 
                                   id="remember"
                                   class="peer h-4 w-4 appearance-none rounded border border-cyan-500/40 bg-slate-950/80 checked:bg-cyan-500 checked:border-cyan-300 focus:outline-none focus:ring-1 focus:ring-cyan-400/50 transition">
                            <svg class="pointer-events-none absolute h-3 w-3 text-slate-950 opacity-0 peer-checked:opacity-100 left-0.5 top-0.5 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs font-mono text-slate-400 group-hover:text-cyan-300 transition-colors">
                            RETAIN_SESSION
                        </span>
                    </label>

                    <span class="font-mono text-[10px] text-slate-500 uppercase tracking-widest">
                        SSL 256-BIT
                    </span>
                </div>

                <!-- Cyber Action Button -->
                <div class="pt-3">
                    <button type="submit" 
                            class="cyber-btn relative w-full overflow-hidden bg-gradient-to-r from-cyan-500 via-blue-600 to-pink-600 py-3.5 px-6 font-orbitron text-xs font-bold tracking-widest text-black shadow-neon-cyan active:scale-[0.99]">
                        <span class="relative z-10 flex items-center justify-center gap-2 text-white drop-shadow-[0_1px_2px_rgba(0,0,0,0.8)]">
                            <span>INITIALIZE AUTHENTICATION</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </button>
                </div>
            </form>

            <!-- Quick Auto-Fill Demo Helper (Convenience for testing) -->
            <div class="mt-5 border-t border-cyan-500/15 pt-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-mono text-slate-500">// QUICK LOAD:</span>
                    <button type="button" 
                            onclick="fillAdminCredentials()"
                            class="flex items-center gap-1.5 rounded border border-cyan-500/30 bg-cyan-950/40 px-2.5 py-1 text-[11px] font-mono text-cyan-300 hover:border-cyan-400 hover:bg-cyan-900/50 hover:shadow-[0_0_10px_rgba(0,240,255,0.3)] transition-all">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Auto-fill Admin Creds
                    </button>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="mt-6 border-t border-white/5 pt-4 text-center">
                <p class="text-xs font-rajdhani text-slate-400">
                    Belum memiliki identitas terdaftar? 
                    <a href="{{ route('register') }}" class="font-bold text-pink-400 hover:text-pink-300 hover:underline tracking-wide">
                        [ INISIALISASI AKUN BARU ]
                    </a>
                </p>
            </div>

            <!-- Telemetry Footer Bar -->
            <div class="mt-4 flex items-center justify-between border-t border-slate-800/80 pt-2 text-[9px] font-mono text-slate-500">
                <span>SEC_HASH: SHA-512</span>
                <span id="liveClock">UTC 00:00:00</span>
                <span>NODE: #77-ID</span>
            </div>

        </div>

        <!-- Ambient Cyber Subtext -->
        <div class="mt-3 text-center text-[10px] font-mono text-slate-600">
            F01 ALUMNI NETWORK &bull; CYBERNETIC MANAGEMENT PLATFORM
        </div>
    </main>

    <!-- JavaScript for Interactive Controls -->
    <script>
        // Toggle password visibility
        function togglePasswordVisibility() {
            const passInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                `;
            } else {
                passInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }

        // Fill admin credentials for fast testing
        function fillAdminCredentials() {
            const emailInput = document.getElementById('email');
            const passInput = document.getElementById('password');
            emailInput.value = 'admin@example.test';
            passInput.value = 'ChangeMe123!';
            
            // Visual indicator
            emailInput.classList.add('border-cyan-400');
            passInput.classList.add('border-pink-400');
            setTimeout(() => {
                emailInput.classList.remove('border-cyan-400');
                passInput.classList.remove('border-pink-400');
            }, 600);
        }

        // Realtime Clock in Cyber Bar
        function updateClock() {
            const now = new Date();
            const timeStr = now.toTimeString().split(' ')[0];
            const clockEl = document.getElementById('liveClock');
            if (clockEl) {
                clockEl.textContent = 'TIME: ' + timeStr;
            }
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>
