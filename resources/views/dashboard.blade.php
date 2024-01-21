<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold md:text-xl md:text-slate-700 dark:text-gray-200 leading-tight">
            {{ __($title) }}
        </h2>
    </x-slot>
    
    <x-slot:stats>
        <div class="relative bg-gradient-to-t from-blue-600 to-indigo-600 md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full">
                <div>
                    <div class="flex flex-wrap">
                        <x-card-stats>
                            <x-slot name="title">
                                Users
                            </x-slot>
                            <x-slot name="count">
                                100
                            </x-slot>
                            <x-slot name="icon">
                                <i class="far fa-chart-bar"></i>
                            </x-slot>
                            <x-slot name="ket">
                                <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 3.48%
                                </span>
                                <span class="whitespace-nowrap">
                                    Since last month
                                </span>
                            </x-slot>
                        </x-card-stats>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:stats>

</x-app-layout>
