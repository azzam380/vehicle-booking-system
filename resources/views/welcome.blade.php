<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MiningFleet - Fleet Management System</title>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .grid-bg {
                background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
                background-size: 30px 30px;
            }
        </style>
    </head>
    <body class="antialiased bg-white text-slate-900 overflow-x-hidden">
        
        <div class="fixed inset-0 grid-bg -z-10 opacity-60"></div>

        <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
                <x-application-logo />
                <div class="flex items-center space-x-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-slate-900 transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <main class="relative pt-20 pb-32">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <div class="inline-flex items-center space-x-2 px-4 py-2 bg-indigo-50 border border-indigo-100 rounded-full text-indigo-700 text-xs font-bold uppercase tracking-widest mb-10 animate-fade-in">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span>Mining Corp Fleet System v1.0</span>
                </div>
                
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-slate-900 tracking-tight mb-8 leading-[1.1]">
                    Monitoring Armada <br> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Lebih Cepat & Akurat.</span>
                </h1>
                
                <p class="text-lg md:text-xl text-slate-500 max-w-3xl mx-auto mb-12 leading-relaxed font-medium">
                    Optimalkan mobilitas operasional perusahaan tambang Anda. <br class="hidden md:block">
                    Satu dashboard untuk mengelola pemesanan, konsumsi BBM, hingga persetujuan berjenjang.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('login') }}" class="group w-full sm:w-auto px-10 py-5 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-2xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center">
                        Mulai Monitoring
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    <a href="#features" class="w-full sm:w-auto px-10 py-5 bg-white text-slate-900 border border-slate-200 rounded-2xl font-bold text-lg hover:bg-slate-50 hover:border-slate-300 transition-all duration-300">
                        Pelajari Fitur
                    </a>
                </div>
            </div>
        </main>

        <section id="features" class="py-24 bg-white/50 backdrop-blur-sm relative border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="group bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                        <div class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.040L3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622l-1.618-3.016z"></path></svg>
                        </div>
                        <h3 class="font-bold text-2xl mb-4 text-slate-900 tracking-tight">Multilevel Approval</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Sistem persetujuan 2 level (Manager & Kepala Cabang) untuk keamanan dan akuntabilitas armada.</p>
                    </div>

                    <div class="group bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                        <div class="w-14 h-14 bg-indigo-50 text-indigo-500 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-2xl mb-4 text-slate-900 tracking-tight">Real-time Analytics</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Grafik interaktif yang menyajikan data pemakaian kendaraan secara visual untuk pengambilan keputusan.</p>
                    </div>

                    <div class="group bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                        <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-2xl mb-4 text-slate-900 tracking-tight">Laporan Excel</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Unduh riwayat pemesanan secara periodik ke dalam format Excel untuk audit dan pembukuan.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-12 border-t border-slate-100 bg-white">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 text-slate-400 text-sm">
                <p>&copy; 2026 MiningFleet System. All rights reserved.</p>
                <div class="flex space-x-6 font-semibold">
                    <span>Software Development </span>
                </div>
            </div>
        </footer>

    </body>
</html>