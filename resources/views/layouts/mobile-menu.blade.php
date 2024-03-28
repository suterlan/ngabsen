<div
  class="z-20 sticky md:hidden p-2 grid grid-cols-5 items-center justify-between bg-white dark:bg-slate-800 shadow-3xl text-gray-400">
  <div class="flex flex-col items-center transition ease-in duration-200 hover:text-gray-600 dark:hover:text-white cursor-pointer {{request()->routeIs('dashboard') ? 'text-gray-600 dark:text-indigo-400' : ''}}">
    <a href="/">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
        <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
        <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
      </svg>
    </a>
    <span class="text-xs">Home</span>        
  </div>
  <div class="flex flex-col items-center transition ease-in duration-200 hover:text-gray-600 dark:hover:text-white cursor-pointer {{request()->routeIs('history') ? 'text-gray-600 dark:text-indigo-400' : ''}}">
    <a href="{{route('history')}}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
      </svg>
    </a>
    <span class="text-xs">Riwayat</span>
  </div>
  <div class="flex flex-col items-center hover:text-gray-600 dark:hover:text-white">
    <a href="{{route('presensi.index')}}">
      <div
        class="bottom-2 -mt-6 shadow-2xl text-center flex items-center justify-center rounded-full text-2xl bg-indigo-200 dark:bg-white w-12 h-12 text-indigo-700 hover:ring-4 ring-indigo-300 ring-opacity-50 transition ease-in duration-300 {{request()->routeIs('presensi.index') ? 'ring-4 ring-indigo-700' : ''}}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 hover:w-10 hover:h-10 duration-300 delay-100">
          <path d="M6 3a3 3 0 0 0-3 3v1.5a.75.75 0 0 0 1.5 0V6A1.5 1.5 0 0 1 6 4.5h1.5a.75.75 0 0 0 0-1.5H6ZM16.5 3a.75.75 0 0 0 0 1.5H18A1.5 1.5 0 0 1 19.5 6v1.5a.75.75 0 0 0 1.5 0V6a3 3 0 0 0-3-3h-1.5ZM12 8.25a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5ZM4.5 16.5a.75.75 0 0 0-1.5 0V18a3 3 0 0 0 3 3h1.5a.75.75 0 0 0 0-1.5H6A1.5 1.5 0 0 1 4.5 18v-1.5ZM21 16.5a.75.75 0 0 0-1.5 0V18a1.5 1.5 0 0 1-1.5 1.5h-1.5a.75.75 0 0 0 0 1.5H18a3 3 0 0 0 3-3v-1.5Z" />
        </svg>        
      </div>
    </a>
  </div>
  <div class="flex flex-col items-center transition ease-in duration-200 hover:text-gray-600 dark:hover:text-white cursor-pointer {{ request()->routeIs('izin') ? 'text-gray-600 dark:text-indigo-400' : '' }}">
    <a href="{{route('izin')}}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
      </svg>
    </a>
    <span class="text-xs">Izin</span>    
  </div>
  <div class="flex flex-col items-center transition ease-in duration-200 hover:text-gray-600 dark:hover:text-white cursor-pointer {{ request()->routeIs('profile.edit') ? 'text-gray-600 dark:text-indigo-400' : '' }}">
    <a href="{{route('profile.edit')}}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
      </svg>
    </a>
    <span class="text-xs">Profile</span>  
  </div>
</div>