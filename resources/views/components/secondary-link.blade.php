<a {{ $attributes->merge(['class' => 'cursor-pointer inline-flex items-center px-2 py-2 border border-transparent rounded-md font-semibold text-xs text-slate-800 dark:text-white uppercase tracking-widest focus:outline-none focus:text-blue-800 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 hover:text-blue-700']) }}>
    {{ $slot }}
</a>