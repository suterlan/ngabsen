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
          <div>Ngabsen Dulu</div>        
        </div>
      </div>
    </div>
  </div>

  @if($errors->any())
    <x-alert class="bg-gradient-to-tr from-red-100 to-red-50  shadow-red-200 text-rose-700">
      <div>Pastikan Devices/Browser diberikan izin akses lokasi atau izin akses kamera!</div>
    </x-alert>
  @endif

  <div class="pt-2">
    @foreach ($attendances as $attendance)
    <a href="{{route('presensi.show', $attendance->id)}}">
    <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow rounded-md sm:rounded-lg mb-2">
      <div class="grid grid-cols-5 gap-3">
        <div class="flex-wrap col-span-2">
          <div class="font-semibold uppercase text-sm sm:text-md">{{$attendance->title}}</div>
          <p class="text-gray-400 text-sm overflow-hidden truncate">{{$attendance->description}}</p>
        </div>
        <div class="justify-self-end text-end">
          <div class="font-semibold text-sm sm:text-md">Masuk </div>
          <span class="text-blue-600 font-bold text-sm sm:text-md">{{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i') }}</span>
        </div>
        <div class="justify-self-end text-end">
          <div class="font-semibold text-sm sm:text-md">Pulang </div>
          <span class="text-red-600 font-bold text-sm sm:text-md">{{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i') }}</span>
        </div>
        <div class="justify-self-end self-center">
          {{-- <div class="text-blue-500">masuk</div> --}}
          <i class="fa-solid fa-long-arrow-right fa-lg"></i>
        </div>
      </div>
    </div>
    </a>
    @endforeach
  </div>
  
</x-app-layout>