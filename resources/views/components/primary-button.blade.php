<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-3 py-1.5 bg-gradient-to-tr from-indigo-400 to-indigo-600 hover:from-indigo-500 hover:to-indigo-700 ring-indigo-400 ring-1 hover:ring-4 hover:ring-opacity-30 dark:bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-300 uppercase tracking-widest dark:hover:bg-indigo-800 focus:bg-indigo-700 dark:focus:bg-indigo-800 active:ring-4 active:ring-opacity-30 dark:active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition ease-in-out duration-500']) }}>
    {{ $slot }}
</button>
