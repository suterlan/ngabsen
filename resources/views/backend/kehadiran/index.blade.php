<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-lg leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>
 
  <div class="py-8">
    <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow rounded-md sm:rounded-lg">
      <div class="grid grid-cols-1 mx-auto gap-2">

        {{-- <div class="relative flex-grow w-full md:w-80 flex-wrap items-stretch">
          <form action="{{route('admin.presences.index')}}">
            @csrf
            <x-search-input :value="request('search')" />
            <x-search-button />
          </form>
        </div> --}}

        <div class="flex-grow pb-4 overflow-auto">
          <div class="mt-4">Daftar Absensi</div>
          @if ($attendances->count() < 1)
          <div class="p-4 sm:p-6 bg-slate-50 hover:bg-slate-100 dark:bg-slate-600 dark:hover:bg-slate-700 shadow rounded-md sm:rounded-lg mb-2 mt-3">
            <div class="grid grid-cols-1">
              <div class="mt-3 mb-2 text-sm text-center">Tidak ada daftar absensi tersedia. Silahkan buat <span class="text-sky-500 cursor-pointer">Setting absensi</span></div>
            </div>
          </div>
          @else
            @foreach ($attendances as $attendance)
              <a href="{{route('admin.presences.show', $attendance->id)}}">
                <div class="p-4 sm:p-6 bg-slate-50 hover:bg-slate-100 dark:bg-slate-600 dark:hover:bg-slate-700 shadow rounded-md sm:rounded-lg mb-2 mt-3">
                  <div class="grid grid-cols-3 gap-3">
                    <div class="flex-wrap col-span-2">
                      <div class="font-semibold uppercase text-sm sm:text-md">{{$attendance->title}}</div>
                      <p class="text-gray-400 text-sm overflow-hidden truncate">{{$attendance->description}}</p>
                    </div>
                    {{-- <div class="justify-self-end text-end">
                      <div class="font-semibold text-sm sm:text-md">Masuk </div>
                      <span class="text-blue-600 dark:text-blue-300 font-bold text-sm sm:text-md">{{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i') }}</span>
                    </div>
                    <div class="justify-self-end text-end">
                      <div class="font-semibold text-sm sm:text-md">Pulang </div>
                      <span class="text-red-600 dark:text-red-300 font-bold text-sm sm:text-md">{{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i') }}</span>
                    </div> --}}
                    <div class="justify-self-end self-center">
                      {{-- <div class="text-blue-500">masuk</div> --}}
                      <i class="fa-solid fa-long-arrow-right fa-lg hover:text-sky-500"></i>
                    </div>
                  </div>
                </div>
              </a>
            @endforeach
          @endif
      </div>
    </div>
  </div>
</x-app-layout>