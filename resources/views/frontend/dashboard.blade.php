<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold md:text-lg md:text-slate-700 dark:text-gray-200 leading-tight">
			{{ __($title) }}
		</h2>
	</x-slot>
	
	<x-slot:stats>
		<div class="relative bg-gradient-to-t from-blue-600 to-indigo-600 pb-32 pt-6 rounded-b-[64px] lg:rounded-b-[100px]">
			<div class="px-4 md:px-10 mx-auto w-full">
				<i class="fa-solid fa-id-badge fa-2xl text-indigo-100 align-baseline"></i>
				<span class="text-white font-semibold text-lg">{{ auth()->user()->name }}</span>
				<div class="flex text-sm text-white/60">{{ auth()->user()->email }}</div>
			</div>
		</div>
	</x-slot:stats>
	
	<div class="relative md:px-10 -mt-24">
		<div class="text-white font-bold">Presensi bulan ini</div>
		<div class="flex bg-white py-4 px-5 rounded-lg shadow dark:bg-slate-800 text-gray-500 items-center justify-between space-x-2">
			<div
				class="flex flex-col items-center justify-center w-20 h-20 bg-blue-200 rounded-2xl text-blue-700 shadow cursor-pointer mb-2 p-1 transition ease-in duration-300">
				<i class="fa-solid fa-clipboard-user mt-2"></i>
				<p class="text-sm my-1">Hadir</p>
				<p class="text-sm -mb-6 bg-white p-1.5 rounded-full shadow drop-shadow-md font-semibold hover:animate-pulse">{{$jmlHadir ? $jmlHadir : 0}}</p>
			</div>
			<div
				class="flex flex-col items-center justify-center w-20 h-20 bg-amber-200 rounded-2xl text-amber-700 shadow cursor-pointer mb-2 p-1 transition ease-in duration-300">
				<i class="fa-solid fa-notes-medical mt-2"></i>
				<p class="text-sm my-1">Sakit</p>
				<p class="text-sm -mb-6 bg-white p-1.5 rounded-full shadow drop-shadow-md font-semibold hover:animate-pulse">{{$jmlSakit ? $jmlSakit : 0}}</p>
			</div>
			<div
				class="flex flex-col items-center justify-center w-20 h-20 bg-emerald-200 rounded-2xl text-emerald-700 shadow cursor-pointer mb-2 p-1 transition ease-in duration-300">
				<i class="fa-solid fa-file-contract mt-2"></i>
				<p class="text-sm my-1">Izin</p>
				<p class="text-sm -mb-6 bg-white p-1.5 rounded-full shadow drop-shadow-md font-semibold hover:animate-pulse">{{$jmlIzin ? $jmlIzin : 0}}</p>
			</div>
			{{-- <div
				class="flex flex-col items-center justify-center w-20 h-20 bg-red-200 rounded-2xl text-rose-700 shadow cursor-pointer mb-2 p-1 transition ease-in duration-300">
				<i class="fa-solid fa-file-circle-xmark mt-2"></i>
				<p class="text-sm my-1">Telat</p>
				<p class="text-sm -mb-6 bg-white p-1.5 rounded-full shadow drop-shadow-md font-semibold hover:animate-pulse">{{$jmlTelat ? $jmlTelat : 0}}</p>
			</div> --}}
		</div>
	</div>

	<div class="p-2 sm:p-6 mt-4 dark:text-slate-400">
		<!-- Timeline -->
		<ul class="flex flex-col text-left space-y-1.5">
			<div class="flex mb-4 justify-between font-semibold items-end">Riwayat 7 Hari Terakhir <a href="{{route('history')}}" class="text-sm font-normal hover:text-indigo-500">Lihat Semua <i class="fa-solid fa-arrow-right-long"></i></a></div>
			@foreach ($periodDate as $date)
				@php
					$history = $histories->where('presence_date', $date)->first();
				@endphp
				<li class="relative flex gap-x-2 pb-4 overflow-hidden">
					<div class="mt-0.5 relative h-full">
						<div class="absolute top-7 bottom-0 left-2.5 w-px h-96 -ml-px border-r border-dashed border-gray-400 dark:border-gray-500"></div>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-green-300">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
							</svg>              
					</div>
					<div class="flex py-1.5 px-3.5 w-full rounded-2xl text-xs font-medium text-gray-600 dark:text-gray-400 bg-white border border-gray-200 shadow-sm dark:bg-slate-800 dark:border-gray-700 justify-between">

					@if (!$history)

						<div class="grid">
							<span class="font-semibold text-gray-800 dark:text-gray-200">{{\Carbon\Carbon::parse($date)->translatedFormat('d-m-Y')}}</span>
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
		</ul>
	</div>
</x-app-layout>
