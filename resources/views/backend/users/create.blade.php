<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-white dark:text-gray-200 leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>

  @if (session('success'))
		<x-alert class="bg-teal-500">
			<b class="capitalize">Sukses!</b>
      <p>{{session('success')}}</p>
		</x-alert>
  @endif

  <div class="py-8">
    <div class="max-w-7xl mx-auto space-y-4">
      <div class="p-4 sm:p-6 pt-8 bg-white dark:bg-gray-800 shadow rounded-md sm:rounded-lg">
        <form method="POST" action="{{ route('admin.users.store') }}">
          @csrf
  
          <!-- Name -->
          <div>
              <x-input-label for="name" :value="__('Name')" />
              <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap" />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>
  
          <!-- Email Address -->
          <div class="mt-4">
              <x-input-label for="email" :value="__('Email')" />
              <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Alamat email aktif" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          {{-- Jabatan --}}
          <div class="mt-4">
            <x-input-label for="jabatan_id" :value="__('Jabatan')" />
            <x-select-input id="jabatan_id" name="jabatan_id" class="mt-1 block w-full" autofocus required>
              <option value="">--Pilih Jabatan--</option>
              @foreach ($jabatans as $jabatan => $name)
                <option value="{{$jabatan}}">{{$name}}</option>
              @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('jabatan_id')" />
          </div>

          {{-- Role --}}
          <div class="mt-4 mb-1 font-medium">Role</div>
          <div class="flex-wrap h-40 overflow-auto border border-slate-300 rounded-md">
            <div class="p-3 space-y-2">
              @foreach ($roles as $role)
                <label for="role[{{$role->id}}]" class="inline-flex items-center">
                  <input id="role[{{$role->id}}]" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-700 shadow-sm focus:ring-0 dark:focus:ring-indigo-700 dark:focus:ring-offset-gray-800 cursor-pointer" name="roles[]" value="{{$role->name}}">
                  <span class="ms-1 me-3 text-sm text-gray-600 dark:text-gray-400">{{ $role->name }}</span>
                </label>
              @endforeach
            </div>
          </div>
  
          <!-- Password -->
          <div class="mt-4">
              <x-input-label for="password" :value="__('Password')" />
  
              <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
  
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>
  
          <!-- Confirm Password -->
          <div class="mt-4">
              <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
  
              <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
  
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
          </div>
  
          <div class="flex items-center justify-between mt-4">
            <x-secondary-link :href="route('admin.users')">
              <i class="fa-solid fa-arrow-left fa-lg me-2"></i>
              Kembali
            </x-secondary-link>

            <x-primary-button class="ms-4">
              <i class="fa-solid fa-save me-2"></i>
              {{ __('Simpan') }}
            </x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>