<x-modal name="create-jabatan" focusable>

  <header class="flex justify-between pt-2 pe-2">
    <div class="text-slate-600 uppercase text-md ps-2 font-semibold">Buat jabatan baru</div>
    <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" x-on:click="$dispatch('close')">
      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
      </svg>
    </button>
  </header>

  <form action="{{route('admin.jabatan.store')}}" method="POST" class="p-6">
    @csrf
  <div class="mt-4">
    <div>
      <x-input-label for="name" :value="__('Nama')" />
      <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" maxlength="64" required autofocus autocomplete="name" placeholder="Nama Jabatan" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
  </div>

  <footer class="mt-6">
    <div class="flex justify-between">
      <x-secondary-link @click="$dispatch('close')">
        {{ __('Tutup') }}
      </x-secondary-link>

      <x-primary-button>
        <i class="fas fa-save me-2"></i>
        {{ __('Simpan') }}
      </x-primary-button>
    </div>
  </footer>
  </form>

</x-modal>