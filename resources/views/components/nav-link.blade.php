@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-slate-100 text-indigo-600 dark:bg-slate-700 dark:bg-opacity-50 dark:text-slate-300 rounded-lg ps-4 text-xs uppercase py-2 font-bold block'
            : 'hover:bg-slate-100 hover:text-indigo-600 hover:rounded-lg rounded-lg ps-3 hover:ps-4 duration-200 text-xs dark:text-slate-200 dark:hover:bg-indigo-500 uppercase py-2 font-bold block';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
