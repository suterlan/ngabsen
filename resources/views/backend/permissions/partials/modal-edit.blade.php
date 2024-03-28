<x-modal name="edit-permission-{{$permission->id}}" focusable>

  <header class="flex justify-between pt-2 pe-2">
    <div class="text-md ms-3 text-slate-500 uppercase">Edit Permission</div>
    <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" x-on:click="$dispatch('close')">
      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
      </svg>
    </button>
  </header>

  <form action="{{route('admin.permission.update', $permission->id)}}" method="POST" class="p-6">
    @csrf
    @method('put')
  <div class="mt-6">
    <div>
      <x-input-label for="name" :value="__('Nama')" />
      <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $permission->name)" required autofocus autocomplete="name" placeholder="Nama Role" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="mt-3 mb-1 font-medium">Role</div>
    <div class="flex-wrap h-40 overflow-auto border border-slate-300 rounded-md">
      <div class="grid grid-cols-2 sm:grid-cols-3 p-3 gap-3">
        @foreach ($roles as $role)
          <label for="role[{{$role->id}}]" class="inline-flex items-center">
            <input id="role[{{$role->id}}]" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-700 shadow-sm focus:ring-0 dark:focus:ring-indigo-700 dark:focus:ring-offset-gray-800 cursor-pointer" name="roles[]" value="{{$role->name}}" @checked($role->hasPermissionTo($permission->name))>
            <span class="ms-1 me-3 text-sm text-gray-600 dark:text-gray-400">{{ $role->name }}</span>
          </label>
        @endforeach
      </div>
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