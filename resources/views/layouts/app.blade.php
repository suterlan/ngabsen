<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="../../assets/img/favicon.ico" />

        <title>{{ config('app.name', 'WilujengNikah') }}</title>

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
                        <x-alert class="bg-teal-500">
                            <b class="capitalize">Sukses!</b>
                            <p>{{session('success')}}</p>
                        </x-alert>
                    @endif
                    @if (session('failed'))
                        <x-alert class="bg-red-500">
                            <b class="capitalize">Gagal!</b>
                            <p>{{session('failed')}}</p>
                        </x-alert>
                    @endif

                    <div class="px-4 md:px-10 mx-auto w-full">                        
                        
                        {{$slot}}  

                    </div>
                </main>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
