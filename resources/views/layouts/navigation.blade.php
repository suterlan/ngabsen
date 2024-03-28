<aside class="md:left-0 py-4 px-6 z-20 w-64 hidden overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0 shadow-xl">
	{{-- <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"> --}}
			<a class="md:block mr-0 text-left inline-block whitespace-nowrap text-lg text-indigo-700 uppercase font-bold py-1 px-0"
				href="/">
				{{config('app.name')}}
			</a>
		{{-- Include side menu --}}
		@include('layouts.menu')
	{{-- </div> --}}
</aside>
<!-- Mobile sidebar -->
<!-- Backdrop -->
<div
	x-show="open"
	x-transition:enter="transition ease-in-out duration-300"
	x-transition:enter-start="opacity-0"
	x-transition:enter-end="opacity-100"
	x-transition:leave="transition ease-in-out duration-300"
	x-transition:leave-start="opacity-100"
	x-transition:leave-end="opacity-0"
	class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
></div>
<aside
	class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 px-6 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
	x-show="open"
	x-transition:enter="transition ease-in-out duration-300"
	x-transition:enter-start="opacity-0 transform -translate-x-20"
	x-transition:enter-end="opacity-100"
	x-transition:leave="transition ease-in-out duration-300"
	x-transition:leave-start="opacity-100"
	x-transition:leave-end="opacity-0 transform -translate-x-20"
	@click.away="closeSideMenu()"
	@keydown.escape="closeSideMenu()"
>
		@include('layouts.menu')
</aside>
