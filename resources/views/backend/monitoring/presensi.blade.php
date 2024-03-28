<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-lg leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>

  <div class="py-8">
    <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow rounded-md sm:rounded-lg">
      <div class="grid grid-cols-1 mx-auto gap-4">

        <x-alert class="bg-sky-100 text-sky-500">Halaman otomatis merefresh setiap 10 detik!</x-alert>

        <div class="relative flex-grow w-full md:w-80 flex-wrap items-stretch mb-3">
          <form action="{{route('admin.monitoring-presensi')}}">
            @csrf
            <x-search-input name="search" type="text" :value="request('search')" />
            <x-search-button />
          </form>
        </div>

        <div class="flex-grow pb-4 overflow-auto">
          <x-table>
            <x-slot name="thead">
              <x-table-th rowspan="2" class="w-1/12 sticky top-0 bg-slate-100 border dark:border-slate-700">No</x-table-th>    
              <x-table-th rowspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700">Tanggal</x-table-th>       
              <x-table-th rowspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700">Nama</x-table-th>       
              <x-table-th rowspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700">Jabatan</x-table-th>       
              <x-table-th colspan="2" class="w-1/8 sticky top-0 bg-slate-100 border dark:border-slate-700 text-center">Presensi</x-table-th>       
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
              @foreach ($presensis as $presensi)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700">
                  <x-table-td>{{$loop->iteration}}</x-table-td>
                  <x-table-td class="whitespace-nowrap">
                    <p>{{\Carbon\Carbon::parse($presensi->presence_date)->translatedFormat('d-m-Y')}}</p>
                    <small class="text-gray-400">{{ $presensi->attendance->title }}</small>
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
                  <x-table-td class="text-end text-red-500">
                    {{-- @if ($presensi->entry_time > '08:00')
                      @php
                        $jamMasuk = \Carbon\Carbon::createFromFormat('H:i:s', '08:00:00');
                        $telat = $jamMasuk->diffInMinutes($presensi->entry_time);
                      @endphp
                      {{ \Carbon\CarbonInterval::minutes($telat)->cascade()->forHumans(); }}
                    @endif --}}
                    {{ \Carbon\Carbon::parse($presensi->created_at)->diffForHumans() }}
                  </x-table-td>
                </tr>
              @endforeach
            </x-slot>
          </x-table>
        </div>
        {{$presensis->links()}}
      </div>
    </div>
  </div>
  @push('scripts')
      <script type="module">
        setTimeout(() => {
            window.location.reload();
            console.log("refresh each 1 second.");
          }, 10000);
      </script>
  @endpush
</x-app-layout>