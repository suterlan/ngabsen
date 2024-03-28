<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-lg leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>

  <div class="py-6">
    <x-secondary-link href="/">
      <i class="fa-solid fa-arrow-left fa-lg me-1"></i>
      Kembali
    </x-secondary-link>
  
    <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 dark:text-slate-400 shadow rounded-md sm:rounded-lg">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <form action="{{route('admin.settings.store')}}" method="POST">
            @csrf
            {{-- setting slug --}}
          <div class="mb-3">
            <x-input-label for="setting_slug" :value="__('Slug')" /> 
            <x-text-input id="setting_slug" name="slug" type="text" class="block mt-1 w-full" value="{{$setting->slug ?? \Str::random(10)}}" readonly />
          </div>
          <!-- Lokasi Kantor -->
          <div class="mb-3">
            <x-input-label for="office_location" :value="__('Lokasi Kantor')" /> 
            <span class="text-sm">silahkan cari lokasi lewat map.
              {{-- <a href="" class="text-blue-500 hover:text-blue-600" x-data="" x-on:click.prevent="$dispatch('open-modal', 'cari-lokasi')">open <i class="fa-solid fa-map"></i></a> --}}
            </span>
            <x-text-input id="office_location" class="block mt-1 w-full" type="text" name="office_location" :value="old('office_location', $setting->office_location ?? '')" required autofocus autocomplete="office_location" placeholder="Lattitude, Longitude" />
            <x-input-error :messages="$errors->get('office_location')" class="mt-2" />
          </div>
          <!-- Radius -->
          <div class="mb-3">
            <x-input-label for="radius" :value="__('Radius Absensi (meter)')" />
            <x-text-input id="radius" class="block mt-1 w-full" type="number" name="radius" :value="old('radius', $setting->radius ?? '0')" min="0" required autofocus />
            <x-input-error :messages="$errors->get('radius')" class="mt-2" />
          </div>
          <div class="mb-3">
            <x-primary-button>Simpan</x-primary-button>
          </div>
          </form>
        </div>
        <div x-data="searchlocation" class="flex-grow rounded p-2">
          {{-- show map --}}
          <div id="mapsearch" class="z-0 h-60"></div>
    
          {{-- display lat, long --}}
          <div>
            <x-text-input id="latlong" name="latlong" type="text" class="mt-2 w-full" readonly placeholder="Lat, Lon"/>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- @include('backend.settings.partials.modal-map') --}}
</x-app-layout>