<div {{ $attributes->merge(['class' => 'justify-center inline-block select-none whitespace-nowrap rounded-xl py-1.5 px-3 align-baseline text-xs font-bold leading-none']) }}>
    <div class="mt-px">
        {{$slot}}
    </div>
</div>