@if (isset($header))
  <nav class="z-10 py-4 sticky top-0 bg-white shadow-md dark:bg-slate-800 md:bg-white">
      <div class="container flex items-center justify-between h-full px-6 mx-auto text-indigo-600 dark:text-indigo-300">
         <a class="md:text-slate-700 dark:text-gray-200 text-sm uppercase hidden md:inline-block font-semibold" href="/">
            {{ $header }}
         </a>
         <div>
            <button @click="toggleSideMenu()" class="relative group md:hidden">
               <div class="relative flex items-center justify-center rounded-full w-[45px] h-[45px] transform transition-all bg-indigo-900 ring-0 ring-gray-400 hover:ring-8 group-focus:ring-4 ring-opacity-30 duration-200 shadow-md">
                  <div class="flex flex-col justify-between w-[15px] h-[15px] transform transition-all duration-300 origin-center" :class="open ? '-rotate-[45deg]' : '' ">
                     <div class="bg-white h-[2px] w-1/2 rounded transform transition-all duration-300 origin-right delay-75" :class="open ? '-rotate-90 h-[1px] -translate-y-[1px]' : '' "></div>
                     <div class="bg-white h-[1px] rounded"></div>
                     <div class="bg-white h-[2px] w-1/2 rounded self-end transform transition-all duration-300 origin-left delay-75" :class="open ? '-rotate-90 h-[1px] translate-y-[1px]' : ''"></div>
                  </div>
              </div>
            </button>
         </div>
         <ul class="flex flex-shrink-0 items-center space-x-6">
            <li class="flex">
               <x-theme-toggle/>
            </li>
            <li class="flex">
               <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                     <a class="md:text-amber-600 block cursor-pointer">
                        <i class="fa-solid fa-bell fa-shake"></i>
                     </a>	
                  </x-slot>
   
                  <x-slot name="content">
                     <x-dropdown-link >
                        {{ __('Update Success') }}
                     </x-dropdown-link>
                  </x-slot>
               </x-dropdown>	
            </li>
            <li class="hidden sm:flex">
               <x-dropdown align="left" width="48">
                  <x-slot name="trigger">
                     <button class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-50 focus:outline-none transition ease-in-out duration-150">
                           <div>{{ Auth::user()->email }}</div>
   
                           <div class="ms-1">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                 <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                              </svg>
                           </div>
                     </button>
                  </x-slot>
   
                  <x-slot name="content">
                     <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                     </x-dropdown-link>
   
                     <!-- Authentication -->
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
   
                        <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                 this.closest('form').submit();">
                              {{ __('Log Out') }}
                        </x-dropdown-link>
                     </form>
                  </x-slot>
               </x-dropdown>
            </li>
         </ul>
      </div>
  </nav>
@endif