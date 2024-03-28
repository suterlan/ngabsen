{{-- <div class="md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-screen items-center flex-1 rounded mt-20"> --}}
  <ul class="md:flex-col md:min-w-full flex flex-col list-none pt-4 gap-1">
    <li class="items-center">
      <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        <i class="fa-solid fa-house fa-lg opacity-75 mr-2"></i>
          {{ __('Dashboard')}}
      </x-nav-link>
    </li>
  </ul>

  <div class="my-3">
    <span class="text-slate-400 font-light text-sm">Presensi</span>
    <hr class="md:min-w-full" />
  </div>

  <ul class="md:flex-col md:min-w-full flex flex-col list-none gap-1">
    <li class="items-center">
      <x-nav-link :href="route('presensi.index')" :active="request()->routeIs('presensi*')">
        <i class="fa-solid fa-file-circle-check fa-lg opacity-75 mr-2"></i>
          {{ __('Presensi')}}
      </x-nav-link>
    </li>
    <li class="items-center">
      <x-nav-link :href="route('history')" :active="request()->routeIs('history')">
        <i class="fa-solid fa-history fa-lg opacity-75 mr-2"></i>
          {{ __('Riwayat Presensi')}}
      </x-nav-link>
    </li>
    <li class="items-center">
      <x-nav-link :href="route('izin')" :active="request()->routeIs('izin')">
        <i class="fa-solid fa-file-contract fa-lg opacity-75 mr-2"></i>
          {{ __('Izin')}}
      </x-nav-link>
    </li>
  </ul>

  <div class="my-3">
    <span class="text-slate-400 font-light text-sm">Akun</span>
    <hr class="md:min-w-full" />
  </div>

  <ul class="md:flex-col md:min-w-full flex flex-col list-none gap-1">
    <li class="items-center">
      <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
        <i class="fa-solid fa-user fa-lg opacity-75 mr-2"></i>
          {{ __('Profile')}}
      </x-nav-link>
    </li>

    <li class="items-center">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full mt-6 py-3 px-6 bg-slate-200 hover:bg-slate-300 rounded-lg ps-3 duration-200 text-xs dark:text-slate-200 dark:hover:bg-indigo-500 uppercase font-bold">
          <i class="fa-solid fa-sign-out fa-lg opacity-75 mr-2"></i>
            Sign Out
        </button>
      </form>
    </li>

  </ul>
 
{{-- </div> --}}