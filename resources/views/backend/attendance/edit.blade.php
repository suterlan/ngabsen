<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-lg leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto space-y-1">
      
      <x-secondary-link :href="route('admin.attendance.index')">
        <i class="fa-solid fa-arrow-left fa-lg me-1"></i>
        Kembali
      </x-secondary-link>

      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-md sm:rounded-lg">
        <form method="POST" action="{{ route('admin.attendance.update', $attendance->id) }}">
          @csrf
          @method('put')
          <!-- Name -->
          <div class="mb-3">
              <x-input-label for="title" :value="__('Nama / Judul Absensi')" />
              <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $attendance->title)" required autofocus autocomplete="title" placeholder="Judul absensi" />
              <x-input-error :messages="$errors->get('title')" class="mt-2" />
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label class="text-sm font-semibold dark:text-slate-300" for="description">Keterangan</label>
            <textarea name="description" class="w-full h-20 mt-1 resize rounded-md text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-900 text-sm border border-slate-300 outline-none focus:outline-none focus:ring-0 placeholder:text-slate-300 dark:placeholder:text-gray-500" placeholder="Maksimal 500 kata..." maxlength="500" required>{{old('description', $attendance->description)}}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-1" />
          </div>

          {{-- Jabatan --}}
          <div class="mb-3">
            <div class="font-medium text-sm">Jabatan / Posisi Karyawan</div>
            <p class="text-xs text-slate-500 mb-2"> Untuk mengklasifikasikan karyawan yang akan menggunakan absensi ini</p>
            <div class="flex-wrap h-32 overflow-auto border border-slate-300 rounded-md">
              <div class="grid grid-cols-2 sm:grid-cols-4 p-3 gap-3">
                @foreach ($jabatans as $jabatan)
                  <label for="jabatan_id{{ $loop->index }}" class="inline-flex items-center">
                    <input id="jabatan_id{{ $loop->index }}" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-700 shadow-sm focus:ring-0 dark:focus:ring-indigo-700 dark:focus:ring-offset-gray-800 cursor-pointer" name="jabatan_ids[{{$jabatan->id}}]" value="{{$jabatan->id}}" @checked(
                      $attendance->jabatans()->wherePivot('jabatan_id', $jabatan->id)->exists()
                    )>
                    <span class="ms-1 me-3 text-sm text-gray-600 dark:text-gray-400">{{$jabatan->name}}</span>
                  </label>
                @endforeach
              </div>
            </div>
            <x-input-error :messages="$errors->get('jabatan_ids')" class="mt-2" />
          </div>

          {{-- Waktu Masuk --}}
          <span class="text-sm font-semibold uppercase"><i class="fa-solid fa-right-to-bracket text-green-500 mr-2"></i> Waktu Absen Masuk</span>
          <div class="grid grid-cols-2 gap-5 mb-3 mt-1">
            <div>
              <x-input-label for="start_time" :value="__('Jam Mulai')" />
              <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time" :value="\Carbon\Carbon::parse($attendance->start_time)->format('H:i')" required autofocus autocomplete="start_time" />
              <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
            </div>
            <div>
              <x-input-label for="limit_start_time" :value="__('Jam Berakhir')" />
              <x-text-input id="limit_start_time" class="block mt-1 w-full" type="time" name="limit_start_time" :value="\Carbon\Carbon::parse($attendance->limit_start_time)->format('H:i')" required autofocus autocomplete="limit_start_time" />
              <x-input-error :messages="$errors->get('limit_start_time')" class="mt-2" />
            </div>
          </div>

          {{-- Waktu Pulang --}}
          <span class="text-sm font-semibold uppercase"><i class="fa-solid fa-right-from-bracket text-red-500 mr-2"></i> Waktu Absen Pulang </span>
          <div class="grid grid-cols-2 gap-5 mb-3 mt-1">
            <div>
              <x-input-label for="end_time" :value="__('Jam Mulai')" />
              <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time" :value="\Carbon\Carbon::parse($attendance->end_time)->format('H:i')" required autofocus autocomplete="end_time" />
              <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
            </div>
            <div>
              <x-input-label for="limit_end_time" :value="__('Jam Berakhir')" />
              <x-text-input id="limit_end_time" class="block mt-1 w-full" type="time" name="limit_end_time" :value="\Carbon\Carbon::parse($attendance->limit_end_time)->format('H:i')" required autofocus autocomplete="limit_end_time" />
              <x-input-error :messages="$errors->get('limit_end_time')" class="mt-2" />
            </div>
          </div>

          {{-- QRCode --}}
          {{-- <div>
            <div class="font-medium text-sm">Fitur QRCode</div>
            <p class="text-xs text-slate-500 mb-2">Dengan mengaktifkan fitur QRCode, absensi bisa dilakukan dengan "<b>scan QRCode</b>" dan juga secara manual dengan "<b>tombol</b>". Secara default jika tidak diaktifkan yang akan digunakan adalah "<b>tombol</b>".</p>
            <label for="code" class="inline-flex items-center">
              <input type="hidden" name="oldCode" value="{{$attendance->code}}">
              <input id="code" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-700 shadow-sm focus:ring-0 dark:focus:ring-indigo-700 dark:focus:ring-offset-gray-800 cursor-pointer" name="code" @checked(!blank($attendance->code))>
              <span class="ms-2 me-3 text-sm text-gray-600 dark:text-gray-400">Aktifkan QRCode</span>
            </label>
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
          </div> --}}
  
          <div class="flex items-center justify-between mt-5">
            <x-primary-button>
              <i class="fa-solid fa-save me-2"></i>
              {{ __('Update') }}
            </x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>