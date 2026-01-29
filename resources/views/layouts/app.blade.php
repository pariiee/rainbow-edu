<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rainbow Edu') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-rainbow-bg text-slate-700 overflow-x-hidden">
    
    <div class="fixed inset-0 -z-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-rainbow-blue/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-rainbow-yellow/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-20 w-96 h-96 bg-rainbow-red/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <div class="min-h-screen flex flex-col">
        <nav x-data="{ open: false }" class="sticky top-4 z-50 mx-4 mb-8">
            <div class="bg-white/70 backdrop-blur-lg border border-white/50 rounded-2xl shadow-lg px-6 py-4 flex justify-between items-center">
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group transition-transform hover:scale-105">
                    <div class="bg-rainbow-blue text-white p-2 rounded-xl shadow-md group-hover:rotate-12 transition-transform duration-300">
                        <i class="fas fa-rainbow fa-lg"></i>
                    </div>
                    <span class="font-display font-bold text-xl text-rainbow-blue tracking-wide">Rainbow<span class="text-rainbow-yellow">Edu</span></span>
                </a>

                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="font-bold text-slate-600 hover:text-rainbow-blue transition-colors">Dashboard</a>
                    
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 font-bold text-slate-500 hover:text-rainbow-blue transition-colors">
                            <span>Halo, {{ Auth::user()->name }}! 👋</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-2 border border-slate-100" style="display: none;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-bold">
                                    <i class="fas fa-power-off mr-2"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <button @click="open = !open" class="md:hidden text-slate-500 focus:outline-none">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>
            
            <div x-show="open" class="md:hidden bg-white/90 backdrop-blur-md rounded-2xl mt-2 p-4 shadow-lg border border-white">
                <a href="{{ route('dashboard') }}" class="block py-2 font-bold text-slate-600">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 text-red-500 font-bold">Keluar</button>
                </form>
            </div>
        </nav>

        <main class="container mx-auto px-4 pb-12 flex-grow">
            {{ $slot }}
        </main>
        
        <footer class="text-center py-6 text-slate-400 text-sm font-display">
            <p>Dibuat dengan ❤️ untuk anak-anak Indonesia</p>
        </footer>
    </div>
</body>
</html>