<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GuestHouse Booking') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                @if(isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>

            <!-- Footer -->
            <footer class="bg-gray-800 text-white py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">GuestHouse Booking</h3>
                            <p class="text-gray-400 text-sm">Temukan dan pesan guest house terbaik untuk perjalanan Anda. Kenyamanan dan kepuasan Anda adalah prioritas kami.</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                            <ul class="text-gray-400 text-sm space-y-2">
                                <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                                <li><a href="{{ route('guest-houses.index') }}" class="hover:text-white">Guest Houses</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                            <p class="text-gray-400 text-sm">Email: info@guesthouse.com</p>
                            <p class="text-gray-400 text-sm">Telepon: +62 123 4567 890</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                        &copy; {{ date('Y') }} GuestHouse Booking. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
