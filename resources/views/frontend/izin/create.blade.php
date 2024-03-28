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
          <a href="{{route('izin')}}" class="hover:text-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
          </a>
          <div>Izin</div>        
        </div>
      </div>
    </div>
    <div class="p-2 sm:p-6 dark:text-slate-400">
      <form action="{{route('izin.store')}}" method="POST">
        @csrf
        <div class="mb-2">
          <label class="text-sm dark:text-slate-300" for="permission_date">Tanggal</label>
          <input id="permission_date" name="permission_date" type="date" class="w-full mt-1 py-1 text-slate-600 dark:text-slate-400 relative bg-white dark:bg-slate-900 rounded text-sm border border-slate-300 outline-none focus:outline-none focus:ring-0" value="{{old('permission_date', date('Y-m-d'))}}" required />
          <x-input-error :messages="$errors->get('permission_date')" class="mt-1" />
        </div>
        <div class="mb-2">
          <label class="text-sm dark:text-slate-300" for="attendance_id">Absen</label>
          <select id="attendance_id" name="attendance_id" class="w-full py-1 mt-1 text-slate-600 dark:text-slate-400 relative bg-white dark:bg-slate-900 rounded text-sm border border-slate-300 outline-none focus:outline-none focus:ring-0" required>
            <option value="">-Pilih Absen-</option>
            @foreach ($attendances as $attendance)
              <option value="{{$attendance->id}}" @selected(old('attendance_id') == $attendance->id)>{{$attendance->title}}</option>
            @endforeach
          </select>
          <x-input-error :messages="$errors->get('title')" class="mt-1" />
        </div>
        <div class="mb-2">
          <label class="text-sm dark:text-slate-300" for="title">Keterangan</label>
          <select id="title" name="title" class="w-full py-1 mt-1 text-slate-600 dark:text-slate-400 relative bg-white dark:bg-slate-900 rounded text-sm border border-slate-300 outline-none focus:outline-none focus:ring-0" required>
            <option value="">-Pilih Keterangan-</option>
            <option value="Izin" @selected(old('title') == 'Izin')>Izin</option>
            <option value="Sakit" @selected(old('title') == 'Sakit')>Sakit</option>
          </select>
          <x-input-error :messages="$errors->get('title')" class="mt-1" />
        </div>
        <div class="mb-2">
          <label class="text-sm dark:text-slate-300" for="description">Alasan</label>
          <textarea id="description" name="description" class="w-full h-32 mt-1 resize rounded-md text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-900 text-sm border border-slate-300 outline-none focus:outline-none focus:ring-0 placeholder:text-slate-300 dark:placeholder:text-slate-400" placeholder="Alasan maksimal 250 kata..." maxlength="250" required>{{old('description')}}</textarea>
          <x-input-error :messages="$errors->get('description')" class="mt-1" />
        </div>
        {{-- Set Location From Map--}}
        <input name="location" type="hidden" id="location">
        <div class="mb-2">
          <x-primary-button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mr-1">
              <path d="M2.87 2.298a.75.75 0 0 0-.812 1.021L3.39 6.624a1 1 0 0 0 .928.626H8.25a.75.75 0 0 1 0 1.5H4.318a1 1 0 0 0-.927.626l-1.333 3.305a.75.75 0 0 0 .811 1.022 24.89 24.89 0 0 0 11.668-5.115.75.75 0 0 0 0-1.175A24.89 24.89 0 0 0 2.869 2.298Z" />
            </svg>
            {{-- <i class="fa-solid fa-paper-plane mr-1"></i> --}}
            Kirim
          </x-primary-button>
        </div>
      </form>

      <div x-data="location" class="flex-grow pb-4 pt-2">
        <div id="map" class="h-44 lg:h-60"></div>
      </div>
      
    </div>
  </div>

</x-app-layout>