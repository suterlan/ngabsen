<x-modal name="edit-role-{{$role->id}}" focusable>

  <header class="flex justify-end pt-2 pe-2">
    <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" x-on:click="$dispatch('close')">
      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
      </svg>
    </button>
  </header>

  <form action="{{route('roles.update', $role->id)}}" method="POST" class="p-6">
    @csrf
    @method('put')
  <div class="mt-6">
    <div>
      <x-input-label for="name" :value="__('Nama')" />
      <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $role->name)" required autofocus autocomplete="name" placeholder="Nama Role" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="mt-3 mb-1 font-medium">Izin Akses</div>
    <div class="flex-wrap h-40 overflow-auto border border-slate-300 rounded-md">
      <div class="p-3 space-y-2">
        @foreach ($permissions as $permission)
          <label for="permission[{{$permission->id}}]" class="inline-flex items-center">
            <input id="permission[{{$permission->id}}]" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-700 shadow-sm focus:ring-0 dark:focus:ring-indigo-700 dark:focus:ring-offset-gray-800" name="permissions[]" value="{{$permission->name}}" @checked($role->hasPermissionTo($permission->name))>
            <span class="ms-1 me-3 text-sm text-gray-600 dark:text-gray-400">{{ $permission->name }}</span>
          </label>
        @endforeach
      </div>
    </div>
    {{-- <div>
      <select x-cloak id="select{{$role->id}}" class="hidden">
        @foreach ($permissions as $permission)
          @if (!$role->hasPermissionTo($permission->name))
          <option value="{{$permission->name}}">{{$permission->name}}</option>
          @endif
        @endforeach
      </select>
      
      <div x-data="multiselect" x-init="loadOptions('select{{$role->id}}')" class="w-full flex flex-col items-center h-64 mx-auto">
        <input name="permission" type="hidden" x-bind:value="selectedValues()">

        <div class="inline-block relative w-full">
          <x-input-label class="mt-3" for="name" :value="__('Permission')" />
          <div class="flex flex-col items-center relative">
            <div x-on:click="open" class="w-full">
              <div class="mb-2 p-1 flex border border-gray-200 bg-white rounded">
                <div class="flex flex-auto flex-wrap">

                  <template x-for="(option,index) in selected" :key="options[option].value">
                    <div class="flex justify-center items-center m-1 font-medium py-1 px-1 rounded bg-gray-100 border">
                      <div class="text-xs font-normal leading-none max-w-full flex-initial" x-model="options[option]" x-text="options[option].text"></div>
                      <div class="flex flex-auto flex-row-reverse">
                        <div x-on:click.stop="remove(index,option)">
                          <svg class="fill-current h-4 w-4 text-red-700" role="button" viewBox="0 0 20 20">
                            <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0 c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183 l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15 C14.817,13.62,14.817,14.38,14.348,14.849z" />
                          </svg>     
                        </div>
                      </div>
                    </div>
                  </template>
                  
                  <div x-show="selected.length == 0" class="flex-1">
                    <input placeholder="Pilih permission" class="bg-transparent p-1 px-2 border-none appearance-none outline-none h-full w-full text-gray-800" x-bind:value="selectedValues()">
                  </div>
                </div>
                <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">
      
                  <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                    <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                      <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83 c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25 L17.418,6.109z" />
                    </svg>
                  </button>
                  <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                      <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83 c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z" />
                    </svg>
                  </button>

                </div>
              </div>
            </div>
            <div class="w-full px-4">
              <div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select" x-on:click.away="close">
                <div class="flex flex-col w-full overflow-y-auto h-36">
                  <template x-for="(option,index) in options" :key="option" class="overflow-auto">
                    <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-gray-100" @click="select(index,$event)">
                      <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                        <div class="w-full items-center flex justify-between">
                          <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                          <div x-show="option.selected">
                            <i class="fas fa-check text-green-600"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
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