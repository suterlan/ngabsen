<th {{ $attributes->merge([
        'class' => 'border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 bg-slate-100 dark:bg-slate-600 text-left'
    ]) }}>
    {{$slot}}
</th>