<x-guest-layout>
  <div class="flex justify-between">
    <div class="relative h-10 w-10 border before:absolute before:-bottom-2 before:-right-2 before:h-4 before:w-4 before:border-b before:border-r before:transition-all before:duration-300 before:ease-in-out after:absolute after:-top-2 after:-left-2 after:h-4 after:w-4 after:border-t after:border-l after:transition-all after:duration-300 after:ease-in-out hover:before:h-[calc(100%+16px)] hover:before:w-[calc(100%+16px)] hover:after:h-[calc(100%+16px)] hover:after:w-[calc(100%+16px)]"></div>
    
    <div class="relative h-10 w-10 border before:absolute before:-bottom-2 before:-left-2 before:h-4 before:w-4 before:border-b before:border-l before:transition-all before:duration-300 before:ease-in-out after:absolute after:-top-2 after:-right-2 after:h-4 after:w-4 after:border-t after:border-r after:transition-all after:duration-300 after:ease-in-out hover:before:h-[calc(100%+16px)] hover:before:w-[calc(100%+16px)] hover:after:h-[calc(100%+16px)] hover:after:w-[calc(100%+16px)]"></div>
  </div>

  <p class="mt-3 text-center font-extrabold text-6xl sm:text-9xl bg-clip-text text-transparent bg-[linear-gradient(to_right,theme(colors.indigo.400),theme(colors.indigo.100),theme(colors.sky.400),theme(colors.fuchsia.400),theme(colors.sky.400),theme(colors.indigo.100),theme(colors.indigo.400))] bg-[length:200%_auto] animate-gradient">{{ $exception->getStatusCode() }}</p>
  <div class="text-center text-lg text-slate-600 sm:text-white font-light">{{ $exception->getMessage() }}</div>

  <div class="flex justify-center">
    <a href="/" class="btn group flex items-center bg-transparent p-2 text-xl font-thin tracking-widest text-white">
      <span class="relative pb-1 text-white after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-blue-500 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">Back</span>
    </a>
  </div>
</x-guest-layout>