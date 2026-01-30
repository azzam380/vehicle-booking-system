<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h2>
        <p class="text-sm text-gray-500">Silakan masuk ke akun Monitoring Kendaraan Anda</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" value="Email Perusahaan" class="font-semibold text-gray-700" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-200 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Kata Sandi" class="font-semibold text-gray-700" />
            <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-200 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:underline font-medium" href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            @endif
        </div>

        <div class="flex flex-col space-y-4">
            <x-primary-button class="w-full justify-center py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all font-bold">
                Masuk Sekarang
            </x-primary-button>
            
            <p class="text-center text-sm text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Daftar</a>
            </p>
        </div>
    </form>
</x-guest-layout>