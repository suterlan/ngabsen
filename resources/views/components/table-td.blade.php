<td {{ $attributes->merge([
        'class' => 'border-slate-300 dark:border-slate-700 px-3 py-2 text-slate-600 dark:text-slate-400'
    ]) }}>
    {{$slot}}
</td>