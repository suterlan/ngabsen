<section>
  <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          {{ __('Informasi User') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          {{ __("Perbarui informasi akun user dan alamat email") }}
      </p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
      @csrf
  </form>

  <form method="post" action="{{ route('admin.users.update', $user->id) }}" class="mt-6 space-y-6">
      @csrf
      @method('patch')

      <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
      </div>

      <div>
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
          <x-input-error class="mt-2" :messages="$errors->get('email')" />

          @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
              <div>
                  <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                      {{ __('Alamat email belum diverifikasi.') }}

                      <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                          {{ __('Kirim ulang verifikasi email.') }}
                      </button>
                  </p>

                  @if (session('status') === 'verification-link-sent')
                      <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                          {{ __('Link verifikasi baru telah terkirim. Silahkan cek email anda.') }}
                      </p>
                  @endif
              </div>
          @endif
      </div>

      <div>
        <x-input-label for="jabatan_id" :value="__('Jabatan')" />
        <x-select-input id="jabatan_id" name="jabatan_id" class="mt-1 block w-full" autofocus required>
          @foreach ($jabatans as $jabatan =>$name)
            <option value="{{$jabatan}}" @selected($jabatan == $user->jabatan_id)>{{$name}}</option>
          @endforeach
        </x-select-input>
        <x-input-error class="mt-2" :messages="$errors->get('jabatan_id')" />
      </div>

      <div class="flex items-center gap-4">
          <x-primary-button>{{ __('Save') }}</x-primary-button>

          @if (session('status') === 'user-updated')
              <p
                  x-data="{ show: true }"
                  x-show="show"
                  x-transition
                  x-init="setTimeout(() => show = false, 2000)"
                  class="text-sm text-gray-600 dark:text-gray-400"
              >{{ __('Saved.') }}</p>
          @endif
      </div>
  </form>
</section>
