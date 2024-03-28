<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-lg leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>

  <div class="pt-2">
    <div class="p-3 sm:p-6 bg-white dark:bg-gray-800 text-slate-600 dark:text-slate-400 shadow rounded-md sm:rounded-lg">
      <div class="grid grid-cols-1 mx-auto gap-6">
        <div class="flex justify-between items-center">
          <a href="/" class="hover:text-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
          </a>
          <x-primary-link :href="route('izin.create')"><i class="fa-solid fa-plus mr-1"></i>Buat</x-primary-link>       
        </div>
      </div>
    </div>
    <div class="p-2 sm:p-6 dark:text-slate-400">
      <div class="flex mb-3">
        <p class="font-semibold text-sm text-slate-300">Riwayat izin minggu ini</p>
      </div>
      @if (blank($izinHistories))
        <div class="text-center text-slate-400">Tidak ada riwayat izin</div>
      @endif
      <!-- Timeline -->
      <ul class="flex flex-col text-left space-y-1.5">
        @foreach ($izinHistories as $izin)
          <div class="font-semibold text-sm text-gray-800 dark:text-gray-300">{{\Carbon\Carbon::parse($izin->permission_date)->translatedFormat('d F Y')}}</div>
          <li class="relative flex gap-x-3 pb-1 overflow-hidden">
            <div class="mt-0.5 relative h-full">
              <div class="absolute top-7 bottom-0 left-2.5 w-px h-96 -ml-px border-r border-dashed border-gray-400 dark:border-gray-500"></div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-green-300">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>              
            </div>
            <div class="flex py-1.5 px-3.5 w-full rounded-2xl text-xs font-medium bg-white border border-gray-200 shadow-sm dark:bg-slate-800 dark:border-gray-700 justify-between items-center">
              <div class="grid w-[50%] pe-2 sm:pe-3">
                <span class="font-medium text-gray-800 dark:text-gray-300 uppercase">{{$izin->title}}</span>
                <p class="font-medium text-slate-400 truncate">{{$izin->description}}</p>
              </div>
  
              <div class="grid ps-2 sm:ps-3 text-end">

                @switch($izin->is_accepted)
                  @case(1)
                    <x-badge-check>{{ __('Disetujui') }}</x-badge-check>
                    @break

                  @case(2)
                    <x-badge-x>{{ __('Ditolak') }}</x-badge-x>
                    @break
                
                  @default
                    <x-badge-loading>{{ __('Diproses') }}</x-badge-loading>
                @endswitch
                
              </div>
            </div>
          </li>
        @endforeach
      </ul>
      {{-- <div class="pt-3">{{$izinHistories->links()}}</div> --}}
    </div>
  </div>

</x-app-layout>