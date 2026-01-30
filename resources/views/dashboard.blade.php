<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Vehicle Monitoring System') }}
            </h2>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                    <span class="w-2 h-2 mr-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    Role: {{ ucfirst(auth()->user()->role) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl transition-all duration-300 hover:shadow-md">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="font-bold text-lg text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Analitik Penggunaan Kendaraan
                    </h3>
                </div>
                <div class="p-6 bg-white">
                    <div class="h-[350px] w-full">
                        <canvas id="usageChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                @if(auth()->user()->role == 'admin')
                <div class="lg:col-span-1 bg-white shadow-sm border border-gray-100 rounded-2xl sticky top-8">
                    <div class="p-6 border-b border-gray-50 bg-indigo-50/30">
                        <h3 class="font-bold text-lg text-gray-800">Pemesanan Baru</h3>
                        <p class="text-xs text-gray-500 mt-1">Input rincian kendaraan dan driver</p>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Kendaraan</label>
                                <select name="vehicle_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-sm" required>
                                    @foreach(\App\Models\Vehicle::all() as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->plate_number }})</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Driver</label>
                                <input type="text" name="driver_name" class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="Contoh: Budi Santoso" required>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Penyetuju 1</label>
                                <select name="approver_1_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-500 text-sm" required>
                                    @foreach(\App\Models\User::where('role', 'approver')->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Penyetuju 2</label>
                                <select name="approver_2_id" class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-500 text-sm" required>
                                    @foreach(\App\Models\User::where('role', 'approver')->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Pemakaian</label>
                                <input type="date" name="booking_date" class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-500 text-sm" required>
                            </div>

                            <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-xl font-bold text-sm shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all duration-200">
                                Kirim Permohonan
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                <div class="{{ auth()->user()->role == 'admin' ? 'lg:col-span-2' : 'lg:col-span-3' }} bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">Daftar Pemesanan</h3>
                            <p class="text-xs text-gray-500">Monitor status persetujuan berjenjang</p>
                        </div>
                        <a href="{{ route('bookings.export') }}" class="inline-flex items-center bg-emerald-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm hover:bg-emerald-600 transition-all duration-200 uppercase tracking-wider">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Export Excel
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50">
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Kendaraan</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Driver</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($bookings as $b)
                                <tr class="hover:bg-gray-50/80 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-800">{{ $b->vehicle->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-mono">{{ $b->vehicle->plate_number }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $b->driver_name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $badgeStyle = match($b->status) {
                                                'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                'level_1' => 'bg-sky-50 text-sky-700 border-sky-100',
                                                default => 'bg-amber-50 text-amber-700 border-amber-100',
                                            };
                                            $statusLabel = match($b->status) {
                                                'approved' => 'Selesai',
                                                'level_1' => 'Lvl 1 OK',
                                                default => 'Pending',
                                            };
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase border {{ $badgeStyle }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if((auth()->id() == $b->approver_1_id && $b->status == 'pending') || 
                                            (auth()->id() == $b->approver_2_id && $b->status == 'level_1'))
                                            <form action="{{ route('bookings.approve', $b->id) }}" method="POST">
                                                @csrf
                                                <button class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-indigo-700 shadow-sm transition-all">
                                                    Setujui
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-300 text-xs italic">Menunggu...</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                            <p class="text-gray-400 text-sm">Belum ada riwayat pemesanan.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('usageChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartData->pluck('name')) !!},
                    datasets: [{
                        label: 'Frekuensi Pemakaian',
                        data: {!! json_encode($chartData->pluck('bookings_count')) !!},
                        backgroundColor: 'rgba(79, 70, 229, 0.7)',
                        hoverBackgroundColor: 'rgba(79, 70, 229, 1)',
                        borderColor: 'rgb(79, 70, 229)',
                        borderWidth: 0,
                        borderRadius: 8,
                        barThickness: 30,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleFont: { size: 14, weight: 'bold' },
                            padding: 12,
                            cornerRadius: 10,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f3f4f6', drawBorder: false },
                            ticks: { font: { size: 11 }, color: '#9ca3af', stepSize: 1 }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { size: 11, weight: 'bold' }, color: '#4b5563' }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>