<div class="pt-2">
  <div 
  {{$attributes->merge([
    'class' => 'p-4 sm:p-5 shadow-sm rounded-md sm:rounded-lg'
  ])}}>
    <div class="grid grid-cols-1 mx-auto">
        {{$slot}}        
    </div>
  </div>
</div>