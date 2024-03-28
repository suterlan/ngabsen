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
          <a href="{{route('presensi.index')}}" class="hover:text-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
          </a>
          <div>Ngabsen Dulu</div>        
        </div>
      </div>
    </div>
  </div>

  @if($errors->any())
    <x-alert class="bg-gradient-to-tr from-red-100 to-red-50  shadow-red-200 text-rose-700">
      <div>Pastikan Devices/Browser diberikan izin akses lokasi atau izin akses kamera!</div>
    </x-alert>
  @endif

  <div class="pt-2">
    <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow rounded-md sm:rounded-lg">
      @if ($attendance->data->is_start || $attendance->data->is_end) 
          <div class="grid grid-cols-1 lg:grid-cols-2 mx-auto gap-4">

            <form action="{{ route('presensi.store') }}" method="POST">
              @csrf
              {{-- start kamera webcam --}}
              <div x-data="camera" x-init="startCamera()" class="flex-grow pb-4 overflow-auto">
                <video id="webcam" autoplay playsinline height="480" class="w-full rounded-md"></video>
                <canvas id="canvas" class="w-full" hidden></canvas>

                {{-- input lokasi --}}
                <input name="location" type="hidden" id="location">
                <textarea x-text="textPicture" name="picture" id="picture" cols="30" rows="10" hidden></textarea>

                {{-- untuk mengirim data attendance id ke request --}}
                <input type="hidden" name="attendance_id" value="{{$attendance->id}}">

                <div class="grid grid-cols-1 gap-3 mt-2 justify-between">

                  @if ($holiday)
                    <div class="flex w-full bg-green-100 rounded-lg p-4 mt-3 text-sm text-green-700" role="alert">
                      <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                      <div>
                          <span class="font-medium">Hari ini!</span> hari libur.
                      </div>
                    </div>
                  @else
                    {{-- jika user saat ini tidak mengajukan izin --}}
                    @if (!$data['is_there_permission'])
                      {{-- jika belum absen dan absen masuk sudah dimulai --}}
                      @if ($attendance->data->is_start && !$data['is_has_enter_today'])
                        <button @click="takePicture()" type="submit" class="flex place-content-center bg-indigo-600 hover:bg-indigo-700 ring-indigo-400 ring-1 hover:ring-4 hover:ring-opacity-30 transition duration-300 px-3 py-2 rounded-md shadow-lg text-white" title="Absen Masuk">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2">
                            <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                            <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                          </svg>                  
                          Masuk
                        </button>
                        <a href="{{route('izin.create')}}" class="flex place-content-center bg-green-600 hover:bg-green-700 ring-green-400 ring-1 hover:ring-4 hover:ring-opacity-30 transition duration-300 px-3 py-2 rounded-md shadow-lg text-white" title="Izin">                
                        Izin
                        </a>
                      @endif
                      @if ($data['is_has_enter_today'])
                        <div class="flex w-full bg-green-100 rounded-lg p-4 text-sm text-green-700" role="alert">
                          <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                          <div>
                            @if ($data['is_has_enter_today'] && !$data['is_not_out_yet'])
                              <span class="font-medium">Selamat</span>! absen hari ini selesai.
                            @else
                              <span class="font-medium">Berhasil</span>! anda sudah absen masuk.
                            @endif
                          </div>
                        </div>
                      @endif

                      {{-- jika absen pulang sudah dimulai, dan user sudah absen masuk tetapi belum absen pulang --}}
                      @if ($attendance->data->is_end && $data['is_has_enter_today'] && $data['is_not_out_yet'])
                        <button @click="takePicture()" type="submit" class="flex place-self-center bg-rose-600 hover:bg-rose-700 ring-rose-400 ring-1 hover:ring-4 hover:ring-opacity-30 transition duration-300 px-3 py-2 rounded-md shadow-lg text-white" title="Absen Pulang">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2">
                            <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                            <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                          </svg>                  
                          Pulang            
                        </button>
                      @endif

                      {{-- jika sudah absen masuk dan belum saatnya absen pulang --}}
                      @if ($data['is_has_enter_today'] && !$attendance->data->is_end)
                        <div class="flex w-full bg-red-100 rounded-lg p-4 text-sm text-red-700" role="alert">
                          <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                          <div>
                            <span class="font-medium">Tunggu</span>! belum saatnya absen pulang.
                          </div>
                        </div>
                      @endif
                      
                    @endif
                    
                    @if($data['is_there_permission'] && !$data['is_permission_accepted'])
                      <div class="flex w-full bg-green-100 rounded-lg p-4 mt-3 text-sm text-green-700" role="alert">
                        <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div>
                            <span class="font-medium"></span> Pengajuan izin sedang diproses!.
                        </div>
                      </div>
                    @endif
                    @if($data['is_there_permission'] && $data['is_permission_accepted'])
                      <div class="flex w-full bg-green-100 rounded-lg p-4 mt-3 text-sm text-green-700" role="alert">
                        <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div>
                            <span class="font-medium">Berhasil!</span> pengajuan izin telah diterima.
                        </div>
                      </div>
                    @endif

                  @endif

                </div>
                {{-- <x-primary-button class="w-full justify-center mt-3">Absen</x-primary-button> --}}
              </div>
            </form>

            <div x-data="location" class="flex-grow pb-4">
              <div id="map" class="z-0 h-44 lg:h-60 xl:h-96"></div>
            </div>
          </div>
      @else
        <div class="text-red-600">Belum saatnya melakukan absen!</div>
      @endif

      @if ($data['is_has_enter_today'] && !$data['is_not_out_yet'])
        <div class="text-emerald-600"> Selamat, Absen hari ini selesai!</div>
      @endif
      
    </div>
  </div>
  
</x-app-layout>