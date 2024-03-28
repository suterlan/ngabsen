<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="../../assets/img/favicon.ico" />

        <title>{{ config('app.name', 'Ngabsen') }}</title>

        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"
        />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-cloak x-data="{darkMode: $persist(false)}" :class="{'dark': darkMode === true }" class="text-slate-800 antialiased">
        <div id="root" class="flex h-screen bg-slate-50 dark:bg-slate-900" x-data="sidemenu">
            {{-- side nav --}}
            @include('layouts.navigation')
            {{-- end side nav --}}
            <div class="flex flex-col flex-1 w-full">
                <!-- Page Heading Navbar -->
                @include('layouts.navbar')
                <!-- End Page Heading Navbar -->

                <!-- Page Content -->
                <main class="h-full overflow-y-auto">
                    
                    {{$stats ?? ''}}

                    @if (session('success'))
                        <x-notification class="text-teal-600 bg-teal-200 dark:bg-teal-100 bg-opacity-80 backdrop-blur-sm">
                            <b class="capitalize">Sukses!</b>
                            <p>{{session('success')}}</p>
                        </x-notification>
                    @endif
                    @if (session('failed'))
                        <x-notification class="text-rose-600 bg-rose-200 bg-opacity-80 backdrop-blur-sm">
                            <b class="capitalize">Gagal!</b>
                            <p>{{session('failed')}}</p>
                        </x-notification>
                    @endif

                    <div class="px-4 md:px-8 mx-auto w-full">                        
                        
                        {{$slot}}  

                    </div>
                </main>
                {{-- End Page Content --}}

                {{-- Mobile Menu (Bottom Navbar) --}}
                @include('layouts.mobile-menu')
                {{-- End Mobile Menu (Bottom Navbar) --}}

            </div>
        </div>
        @stack('scripts')
    </body>
</html>
