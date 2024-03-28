<x-modal name="lihat-alasan-{{$izin->id}}" focusable>

  <header class="flex justify-between pt-2 pe-2">
    <div class="text-md ms-3 text-slate-500 uppercase">Alasan Izin</div>
    <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" x-on:click="$dispatch('close')">
      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
      </svg>
    </button>
  </header>

  <div class="p-6">
    <div class="mb-2">Atas Nama : <span class="font-semibold">{{$izin->user->name}}</span></div>
    <div>
      <textarea class="w-full h-32 mt-1 resize rounded-md text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-900 text-sm border border-slate-300 outline-none focus:outline-none focus:ring-0"  readonly>{{$izin->description}}</textarea>
    </div>
  </div>

</x-modal>