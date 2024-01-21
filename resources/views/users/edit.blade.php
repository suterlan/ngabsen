<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white dark:text-gray-200 leading-tight">
          {{ $title }}
      </h2>
  </x-slot>

  @if (session('status') === 'user-updated')
		<x-alert class="bg-teal-500">
			<b class="capitalize">Sukses! </b> Informasi user telah diperbarui.
		</x-alert>
  @endif

    <div class="py-12">
        <x-secondary-link :href="route('users')">
            <i class="fa-solid fa-arrow-left fa-lg me-2"></i>
            Kembali
        </x-secondary-link>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('users.partials.update-user-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('users.partials.update-pass-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
