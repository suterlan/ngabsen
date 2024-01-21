{{-- <div class="md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-screen items-center flex-1 rounded mt-20"> --}}
  <ul class="md:flex-col md:min-w-full flex flex-col list-none pt-5 mt-5 gap-1">
    <li class="items-center">
      <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        <i class="fa-solid fa-house fa-lg opacity-75 mr-2"></i>
          {{ __('Dashboard')}}
      </x-nav-link>
    </li>
  </ul>
  <hr class="my-4 md:min-w-full" />
  <ul class="md:flex-col md:min-w-full flex flex-col list-none pt-1 gap-1">
    <li class="items-center">
      <x-nav-link :href="route('users')" :active="request()->routeIs('users*')">
          <i class="fa-solid fa-users-gear fa-lg opacity-75 mr-2"></i>
          {{ __('Users')}}
      </x-nav-link>
    </li>
    <li class="items-center">
      <x-nav-link :href="route('roles')" :active="request()->routeIs('roles*')">
        <i class="fa-solid fa-user-shield fa-lg opacity-75 mr-2"></i>
        {{ __('Roles')}}
      </x-nav-link>
    </li>
    <li class="items-center">
      <x-nav-link :href="route('permission')" :active="request()->routeIs('permission*')">
        <i class="fa-solid fa-file-shield fa-lg opacity-75 mr-2"></i>
        {{ __('Permission')}}
      </x-nav-link>
    </li>
  </ul>
{{-- </div> --}}