<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-lg leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>

  <div class="pt-2">
    <div class="p-3 sm:p-6 bg-white dark:bg-gray-800 text-slate-600 dark:text-slate-400 shadow rounded-md sm:rounded-lg">
      <div class="grid grid-cols-1 mx-auto gap-6">
        <div class="flex justify-between items-center">
          <a href="/" class="hover:text-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
          </a>
          <div>Riwayat Presensi</div>        
        </div>
      </div>
    </div>
  </div>

  <div class="pt-2">
    <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow rounded-md sm:rounded-lg">
      <form action="{{route('history')}}">
        <div class="mb-3">
          <select name="filter_tahun" class="w-full py-1 text-slate-600 dark:text-slate-400 relative bg-white dark:bg-slate-900 rounded text-sm border border-slate-300 outline-none focus:outline-none focus:ring-0" required>
            <option value="">-Pilih Tahun-</option>
            @php
              $currentYear = date('Y');
              $subYear = $currentYear - 3;
            @endphp
            @for ($currentYear; $currentYear > $subYear; $currentYear--)
              <option value="{{$currentYear}}" @selected(request('filter_tahun') == $currentYear)>{{$currentYear}}</option>
            @endfor
          </select>
        </div>
        <div class="mb-3">
          <select name="filter_bulan" class="w-full py-1 text-slate-600 dark:text-slate-400 relative bg-white dark:bg-slate-900 rounded text-sm border border-slate-300 outline-none focus:outline-none focus:ring-0" required>
            <option value="">-Pilih Bulan-</option>
            @php
              $month = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            @endphp
            @for ($i=1; $i <= 12; $i++)
              <option value="{{$i}}" @selected(request('filter_bulan') == $i)>{{$month[$i]}}</option>
            @endfor
          </select>
        </div>
        <x-primary-button><i class="fa-solid fa-search mr-2"></i> Cari</x-primary-button>
      </form>
    </div>
    <div class="p-2 sm:p-6 mt-2 dark:text-slate-400">
      @if (blank($histories))
        <div class="text-center text-slate-400">Tidak ada riwayat absen</div>
      @endif
      <!-- Timeline -->
      <ul class="flex flex-col text-left space-y-1.5">
        @if (!request('filter_tahun') && !request('filter_bulan'))  
          <div class="flex mb-2 justify-between font-semibold items-end">Riwayat Absensi Bulan Ini</div>
          @foreach ($periodDate as $date)
            @php
              $history = $histories->where('presence_date', $date)->first();
            @endphp
            <div class="font-semibold text-sm text-gray-800 dark:text-gray-200">{{\Carbon\Carbon::parse($date)->translatedFormat('d F Y')}}</div>
            <li class="relative flex gap-x-3 pb-1 overflow-hidden">
              <div class="mt-0.5 relative h-full">
                <div class="absolute top-7 bottom-0 left-2.5 w-px h-96 -ml-px border-r border-dashed border-gray-400 dark:border-gray-500"></div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-green-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>              
              </div>
              <div class="flex py-1.5 px-3.5 w-full rounded-2xl text-xs font-medium text-gray-600 dark:text-gray-400 bg-white border border-gray-200 shadow-sm dark:bg-slate-800 dark:border-gray-700 justify-between">

              @if (!$history)

                <div class="grid">
                  {{-- <span class="font-semibold text-gray-800 dark:text-gray-200">{{\Carbon\Carbon::parse($date)->translatedFormat('d-m-Y')}}</span> --}}
                  <span class="text-[10px] sm:text-xs">	
                    @if($date == now()->toDateString())	
                      <span class="text-orange-600 dark:text-gray-400">belum absen!</span>
                    @else
                      <span class="text-rose-600 dark:text-gray-400">tidak hadir!</span>
                    @endif
                  </span>
                </div>

              @else

                <div class="grid">
                  <span class="font-semibold text-gray-800 dark:text-gray-200">{{\Carbon\Carbon::parse($history->presence_date)->translatedFormat('d-m-Y')}}</span>
                  <span class="text-[10px] sm:text-xs">	
                    @if ($history->is_izin)
                      <span class="text-emerald-600 dark:text-gray-400">Izin</span>
                    @else
                      <span class="dark:text-gray-400"><span class="text-sky-600"> Hadir</span> {{$history->attendance->title}}</span>
                    @endif
                  </span>
                </div>
                <span class="grid text-end">
                  <span class="text-blue-600 text-xs"> 
                    @if (!is_null($history->entry_time))
                      {{ $history->entry_time }}
                    @endif
                  </span>
                  <span class="text-orange-600 text-xs">
                    @if (!is_null($history->out_time))
                      {{ $history->out_time }}
                    @else
                      <span class="text-[10px] sm:text-xs">
                        belum absen pulang!
                      </span>
                    @endif
                  </span> 
                  <span class="text-sky-600 text-xs">
                    @if ($history->is_izin)
                      Izin
                    @endif
                  </span> 
                </span>

              @endif

              </div>
            </li>
          @endforeach   
        @else

        @foreach ($histories as $history)
          <div class="font-semibold text-sm text-gray-800 dark:text-gray-200">{{\Carbon\Carbon::parse($history->presence_date)->translatedFormat('d F Y')}}</div>
          <li class="relative flex gap-x-3 pb-1 overflow-hidden">
            <div class="mt-0.5 relative h-full">
              <div class="absolute top-7 bottom-0 left-2.5 w-px h-96 -ml-px border-r border-dashed border-gray-400 dark:border-gray-500"></div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-green-300">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>              
            </div>
            <div class="flex py-1.5 px-3.5 w-full rounded-2xl text-xs font-medium text-gray-600 dark:text-gray-400 bg-white border border-gray-200 shadow-sm dark:bg-slate-800 dark:border-gray-700 justify-between">
              <div class="grid">
                <span class="font-medium text-gray-800 dark:text-gray-400">Absen Masuk</span>
                <span class="font-medium text-gray-800 dark:text-gray-400">Absen Pulang</span>
              </div>
  
              <span class="grid text-end">
                <span class="text-blue-600 text-xs"> 
                  @if (!is_null($history->entry_time))
                    {{ $history->entry_time }}
                    {{-- <i class="fa-solid fa-check text-green-600"></i> --}}
                  @else
                    belum absen
                    {{-- <i class="fa-solid fa-times text-red-600"></i> --}}
                  @endif
                </span>
                <span class="text-rose-400 text-xs">
                  @if (!is_null($history->out_time))
                    {{ $history->out_time }}
                    {{-- <i class="fa-solid fa-check text-green-600"></i> --}}
                  @else
                    belum absen
                    {{-- <i class="fa-solid fa-times text-red-600"></i> --}}
                  @endif
                </span> 
              </span>
            </div>
          </li>
        @endforeach

        @endif
      </ul>
      <div class="pt-3">{{$histories->links()}}</div>
    </div>
  </div>

</x-app-layout>