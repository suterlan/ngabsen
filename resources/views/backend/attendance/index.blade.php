<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-lg leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>
 
  <div class="py-8">
    <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow rounded-md sm:rounded-lg">
      <x-primary-link class="mb-6" :href="route('admin.attendance.create')"><i class="fa-solid fa-plus me-2"></i>{{ __('Tambah')}}</x-primary-link>
      <div class="grid grid-cols-1 mx-auto gap-2">

        <div class="relative flex-grow w-full md:w-80 flex-wrap items-stretch">
          <form action="{{route('admin.attendance.index')}}">
            @csrf
            <x-search-input name="search" type="text" :value="request('search')" />
            <x-search-button />
          </form>
        </div>

        <div class="flex-grow pb-4 overflow-auto">
          <table class="table w-full text-slate-500 dark:text-slate-400 border-separate space-y-6 text-sm border-spacing-x-0 border-spacing-y-4">
            <thead class="bg-slate-200 dark:bg-slate-500 dark:text-slate-300 text-slate-500">
              <tr>
                <th class="p-3 w-1/6 rounded-s-xl">Title</th>
                <th class="p-3 w-1/6 text-left">Waktu Masuk</th>
                <th class="p-3 w-1/6 text-left">Batas Masuk</th>
                <th class="p-3 w-1/6 text-left">Waktu Pulang</th>
                <th class="p-3 w-1/6 text-left">Batas Pulang</th>
                <th class="p-3 w-1/6 text-right rounded-e-xl">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($attendances as $attendance)
                <tr class="bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600">
                  <td class="p-3 rounded-s-xl">
                    <a href="{{ route('admin.attendance.edit', $attendance->id) }}">
                      <div class="flex">
                        <div class="p-1 rounded-md border border-slate-300">
                          <i class="fa-solid fa-qrcode fa-4x"></i>
                          {{-- <img class="rounded-md h-12 w-12 object-cover" src="https://images.unsplash.com/photo-1613588718956-c2e80305bf61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=634&q=80" alt="unsplash image"> --}}
                        </div>
                        <div class="mx-3">
                            <div class="font-semibold dark:text-slate-300 uppercase">{{$attendance->title}}</div>
                            <p class="text-gray-400 overflow-hidden truncate w-80">{{$attendance->description}}.</p>
                        </div>
                      </div>
                    </a>
                  </td>
                  <td class="p-3 font-semibold">{{$attendance->start_time}}</td>
                  <td class="p-3 font-semibold">{{$attendance->limit_start_time}}</td>
                  <td class="p-3 font-semibold">{{$attendance->end_time}}</td>
                  <td class="p-3 font-semibold">{{$attendance->limit_end_time}}</td>
                  <td class="p-3 rounded-e-xl text-right">
                    <div class="inline-flex">
                      <a href="{{ route('admin.attendance.edit', $attendance->id) }}" class="text-slate-400 hover:text-slate-500 text-[1rem] mr-3">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <form x-data @submit.prevent="if(confirm('Yakin mau menghapus?\nData mungkin akan terhapus selamanya!')) $el.submit()" action="{{route('admin.attendance.delete', $attendance->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-slate-400 hover:text-slate-500 text-[1rem] mr-3">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div>{{$attendances->links()}}</div>
      </div>
    </div>
  </div>
</x-app-layout>