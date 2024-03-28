<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-lg leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>

  <div class="py-8">
    <x-secondary-link :href="route('admin.presences.index')">
      <i class="fa-solid fa-arrow-left fa-lg me-1"></i>
      Kembali
    </x-secondary-link>

    @include('backend.kehadiran.partials.tabs')

    <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 dark:text-slate-400 shadow rounded-md sm:rounded-lg">
      <div class="grid grid-cols-1 gap-1 p-3 mb-5 border text-sm">
          <div class="uppercase font-semibold dark:text-slate-300">{{$attendance->title}}</div>
          <p class="text-slate-400">{{$attendance->description}}</p>
      </div>

      <div class="grid grid-cols-1 mx-auto gap-4">

        <div class="flex-wrap sm:flex justify-center sm:justify-between sm:space-x-2">
          <div class="relative flex-grow w-full md:w-80 flex-wrap items-stretch mb-1 mt-2">
            {{-- <form action="{{route('admin.presences.izin', $attendance->id)}}">
              @csrf
              <x-search-input name="search" type="text" :value="request('search')" />
              <x-search-button />
            </form> --}}
          </div>
          <div class="relative flex-grow w-full md:w-80 flex-wrap items-stretch mb-1 mt-2">
            <form action="{{route('admin.presences.izin', $attendance->id)}}">
              @csrf
              <x-search-input name="filter_by_date" type="date" :value="request('filter_by_date')" />
              <x-search-button />
            </form>
          </div>
        </div>

        <div class="flex-grow pb-4 overflow-auto">
          <div class="grid grid-cols-2 gap-2 text-sm border-b border-indigo-800 pb-1">
            <div>
              <div>Hari : <span class="font-semibold">
                {{ \Carbon\Carbon::parse($date)->dayName }}
                {{ \Carbon\Carbon::parse($date)->isCurrentDay() ? '(Hari ini)' : '' }}  
              </span></div>
              <div>Tanggal : <span class="font-semibold">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</span></div>
            </div>
            <div class="text-end self-end">Jumlah : <span class="font-semibold">{{$izins->count()}}</span></div>
          </div>
          <x-table>
            <x-slot name="thead">
              <x-table-th class="w-1/12 sticky top-0 bg-slate-100">No</x-table-th>
              <x-table-th class="w-1/7 sticky top-0 bg-slate-100">Nama</x-table-th>
              <x-table-th class="w-1/7 sticky top-0 bg-slate-100">Kontak</x-table-th>
              <x-table-th class="w-1/7 sticky top-0 bg-slate-100">Jabatan</x-table-th>
              <x-table-th class="w-1/7 sticky top-0 bg-slate-100">Keterangan</x-table-th>
              <x-table-th class="w-1/7 sticky top-0 bg-slate-100">Alasan</x-table-th>
              <x-table-th class="w-1/7 sticky top-0 bg-slate-100 text-end">Diterima</x-table-th>
            </x-slot>
            <x-slot name="tbody">
              @if ($izins->count() < 1)
                <tr>
                  <x-table-td colspan="7" class="text-center">Tidak ada data</x-table-td>
                </tr>
              @endif

              @foreach ($izins as $izin)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700">
                  <x-table-td>{{$loop->iteration}}</x-table-td>
                  <x-table-td>{{$izin->user->name}}</x-table-td>
                  <x-table-td>
                    <a href="mailto:{{ $izin->user->email }}" class="text-blue-600">{{ $izin->user->email }}</a>
                  </x-table-td>
                  <x-table-td>{{$izin->user->jabatan->name}}</x-table-td>
                  <x-table-td>{{$izin->title}}</x-table-td>
                  <x-table-td>
                    <a href="" class="text-slate-400 hover:text-slate-500 bg-yellow-300 px-2 py-1 rounded-lg" x-data="" x-on:click.prevent="$dispatch('open-modal', 'lihat-alasan-{{$izin->id}}')">Lihat</a> 
                    @include('backend.kehadiran.partials.modal-alasan')
                  </x-table-td>
                  <x-table-td class="text-end">
                    @if ($izin->is_accepted)
                      <x-badge-check>Diterima</x-badge-check>
                    @else
                      <form action="{{ route('admin.presences.acceptedizin', $attendance->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $izin->user->id }}">
                        <input type="hidden" name="permission_date" value="{{ $izin->permission_date }}">
                        <input type="hidden" name="location" value="{{ $izin->location }}">
                        <x-primary-button class="bg-gradient-to-tr from-indigo-400 to-indigo-600">Terima</x-primary-button>
                      </form>
                    @endif
                  </x-table-td>
                </tr>
              @endforeach
            </x-slot>
          </x-table>
        </div>

      </div>
    </div>
  </div>
</x-app-layout>