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
      <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-3 mb-5 border text-sm">
        <div class="col-span-2">
          <div class="uppercase font-semibold dark:text-slate-300">{{$attendance->title}}</div>
          <p class="text-slate-400">{{$attendance->description}}</p>
          
          <div class="mt-3 mb-1">Absensi untuk yang memiliki jabatan :</div>
          <div>
            @foreach ($attendance->jabatans as $jabatan)
              <x-badge class="bg-sky-100 text-sky-600">{{$jabatan->name}}</x-badge>
            @endforeach
          </div>
        </div>

        <div class="text-xs sm:text-sm">
          <div> 
            <span class="whitespace-nowrap">Jam Masuk</span> 
            <span class="font-semibold whitespace-nowrap">: {{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($attendance->limit_start_time)->format('H:i') }}</span>
          </div>
          <div>
            <span class="whitespace-nowrap">Jam Pulang</span> 
            <span class="font-semibold whitespace-nowrap">: {{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($attendance->limit_end_time)->format('H:i') }}</span>
            </div>
        </div>
      </div>
      <div class="grid grid-cols-1 mx-auto gap-4">

        <div class="flex-wrap sm:flex justify-center sm:justify-between sm:space-x-2">
          <div class="relative flex-grow w-full md:w-80 flex-wrap items-stretch mb-1 mt-2">
            <form action="{{route('admin.presences.show', $attendance->id)}}">
              @csrf
              <x-search-input name="search" type="text" :value="request('search')" />
              <x-search-button />
            </form>
          </div>
          <div class="relative flex-grow w-full md:w-80 flex-wrap items-stretch mb-1 mt-2">
            <form action="{{route('admin.presences.show', $attendance->id)}}">
              @csrf
              <x-search-input name="filter_by_date" type="date" :value="request('filter_by_date')" />
              <x-search-button />
            </form>
          </div>
        </div>

        <div class="flex-grow pb-4 overflow-auto">
          <x-table>
            <x-slot name="thead">
              <x-table-th rowspan="2" class="w-1/12 sticky top-0 bg-slate-100 border dark:border-slate-700">No</x-table-th>    
              <x-table-th rowspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700">Tanggal</x-table-th>       
              <x-table-th rowspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700">Nama</x-table-th>       
              <x-table-th rowspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700">Jabatan</x-table-th>       
              <x-table-th colspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700 text-center">Jam Absen</x-table-th>       
              <x-table-th colspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700 text-center">Foto</x-table-th>
              <x-table-th rowspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700 text-center">Keterangan</x-table-th>
              <tr>
                <x-table-th class="w-1/8 sticky top-0 bg-slate-100 text-center border dark:border-slate-700">Masuk</x-table-th>       
                <x-table-th class="w-1/8 sticky top-0 bg-slate-100 text-center border dark:border-slate-700">Pulang</x-table-th>       
                <x-table-th class="w-1/8 sticky top-0 bg-slate-100 text-center border dark:border-slate-700">Masuk</x-table-th>       
                <x-table-th class="w-1/8 sticky top-0 bg-slate-100 text-center border dark:border-slate-700">Pulang</x-table-th>       
              </tr>    
            </x-slot>
            <x-slot name="tbody">
              @foreach ($presences as $presensi)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700">
                  <x-table-td>{{$loop->iteration}}</x-table-td>
                  <x-table-td>
                    <p>{{\Carbon\Carbon::parse($presensi->presence_date)->translatedFormat('d-m-Y')}}</p>
                  </x-table-td>
                  <x-table-td>{{$presensi->user->name}}</x-table-td>
                  <x-table-td>{{$presensi->user->jabatan->name}}</x-table-td>
                  <x-table-td class="text-center">
                    @if (!blank($presensi->entry_time))
                      <x-badge-check>{{$presensi->entry_time}}</x-badge-check>  
                    @else
                      <x-badge-x>Belum</x-badge-x> 
                    @endif
                  </x-table-td>
                  <x-table-td class="text-center">
                    @if (!blank($presensi->out_time))
                      <x-badge-check>{{$presensi->out_time}}</x-badge-check>  
                    @else
                      <x-badge-x>Belum</x-badge-x>  
                    @endif
                  </x-table-td>
                  <x-table-td class="whitespace-nowrap">
                    <div class="flex items-center justify-center">
                      @if (!blank($presensi->entry_foto))
                        <img class="object-cover object-center hover:brightness-150 hover:contrast-75 w-8 h-8 hover:fixed hover:w-40 hover:h-40 hover:duration-500 hover:delay-200 border-2 border-white rounded-full dark:border-gray-700" src="{{asset('storage/'. $presensi->entry_foto)}}" alt="">
                      @else
                        <i class="fa-solid fa-image text-[32px]"></i>
                      @endif
                    </div>
                  </x-table-td>
                  <x-table-td class="whitespace-nowrap">
                    <div class="flex items-center justify-center">
                      @if (!blank($presensi->out_foto))
                        <img class="object-cover object-center hover:brightness-150 hover:contrast-75 w-8 h-8 hover:fixed hover:w-40 hover:h-40 hover:duration-500 hover:delay-200 border-2 border-white rounded-full dark:border-gray-700" src="{{asset('storage/'. $presensi->out_foto)}}" alt="">
                      @else
                        <i class="fa-solid fa-image text-[32px]"></i>
                      @endif
                    </div>
                  </x-table-td>
                  <x-table-td class="text-center">
                    {{-- {{ \Carbon\Carbon::parse($presensi->created_at)->diffForHumans() }} --}}
                    @if ($presensi->is_izin)
                      <div class="text-amber-500 bg-amber-50 dark:bg-transparent px-3 py-1 rounded-md">Izin</div>
                    @else
                      <div class="text-emerald-500 bg-emerald-50 dark:bg-transparent px-3 py-1 rounded-md">Hadir</div>
                    @endif
                  </x-table-td>
                </tr>
              @endforeach
            </x-slot>
          </x-table>
        </div>
        {{$presences->links()}}
      </div>
    </div>
  </div>
</x-app-layout>