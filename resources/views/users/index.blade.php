<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl leading-tight">
          {{ __($title) }}
      </h2>
  </x-slot>
 
  <div class="py-12">
    <div class="max-w-7xl mx-auto space-y-4">
      <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow rounded-md sm:rounded-lg">
        <x-primary-link :href="route('users.create')" class="mb-6"><i class="fa-solid fa-user-plus me-2"></i>{{ __('Tambah')}}</x-primary-link>

        <div class="relative flex-grow w-full md:w-80 flex-wrap items-stretch mb-3">
          <form action="{{route('users')}}">
            @csrf
            <x-search-input :value="request('search')" />
            <x-search-button />
          </form>
        </div>

        <div class="container flex flex-col h-screen">
          <div class="flex pb-4 overflow-auto">
            <x-table>
              <x-slot name="thead">
                <x-table-th class="w-1/12 sticky top-0">No</x-table-th>    
                <x-table-th class="w-1/5 sticky top-0 bg-slate-100">Nama</x-table-th>    
                <x-table-th class="w-1/5 sticky top-0 bg-slate-100">Email</x-table-th>    
                <x-table-th class="w-1/5 sticky top-0 bg-slate-100">Role</x-table-th>    
                <x-table-th class="w-1/5 sticky top-0 bg-slate-100">Aksi</x-table-th>    
              </x-slot>
              <x-slot name="tbody">
                @foreach ($users as $user)
                  <tr class="hover:bg-slate-50 dark:hover:bg-slate-700">
                    <x-table-td class="text-center">{{$loop->iteration}}</x-table-td>
                    <x-table-td>{{$user->name}}</x-table-td>
                    <x-table-td>{{$user->email}}</x-table-td>
                    <x-table-td>
                      @foreach ($user->roles as $role)
                        <x-badge class="bg-blue-50 dark:bg-gray-700 text-blue-500 uppercase">{{$role->name}}</x-badge>
                      @endforeach
                    </x-table-td>
                    <x-table-td>
                      <div class="inline-block float-right md:hidden" x-data="{ aksi: false }">
                        <button x-on:click="aksi = ! aksi" type="button" class="flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" id="aksi-button" aria-expanded="true" aria-haspopup="true">
                            <span class="sr-only"></span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </button>
                        <div x-show="aksi" x-on:click.away="aksi = false" class="absolute z-50 right-5 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none" role="aksi" aria-orientation="vertical" aria-labelledby="aksi-button" tabindex="-1">
                            <div class="" role="none">
                                <a href="users/{{$user->id}}" class="text-gray-500 font-medium hover:text-gray-900 hover:bg-gray-50 block px-4 py-2 text-sm" role="aksiitem" tabindex="-1" id="aksi-item-0">
                                  Edit
                                </a>
                            </div>
                            <div class="" role="none">
                              <form x-data @submit.prevent="if(confirm('Yakin mau menghapus?\nData mungkin akan terhapus selamanya!')) $el.submit()" method="post" action="/imah/users/{{$user->id}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-gray-500 font-medium hover:text-gray-900 hover:bg-gray-50 block px-4 py-2 text-sm" role="aksiitem" tabindex="-1" id="aksi-item-0">
                                  Hapus
                                </button>
                              </form>
                            </div>
                        </div>
                      </div>
                      <div class="items-center justify-end hidden md:flex space-x-2">
                        <x-edit-button href="users/{{$user->id}}" />
                        <form x-data @submit.prevent="if(confirm('Yakin mau menghapus?\nData mungkin akan terhapus selamanya!')) $el.submit()" method="post" action="/imah/users/{{$user->id}}">
                          @csrf
                          @method('delete')
                          <x-delete-button x-data type="submit" />
                        </form>
                      </div>
                    </x-table-td>
                  </tr>
                @endforeach
              </x-slot>
            </x-table>
          </div>
          <div class="pt-3 w-full">
            {{$users->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>