@php
    $variants = [
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus-visible:outline-primary-600 shadow-sm',
        'secondary' => 'bg-white text-slate-900 ring-1 ring-inset ring-slate-300 hover:bg-slate-50 shadow-sm',
        'danger' => 'bg-rose-600 text-white hover:bg-rose-700 focus-visible:outline-rose-600 shadow-sm',
        'ghost' => 'text-slate-600 hover:bg-slate-50 hover:text-slate-900',
    ];
    
    $sizes = [
        'sm' => 'px-2.5 py-1.5 text-xs',
        'md' => 'px-3.5 py-2 text-sm',
        'lg' => 'px-4 py-2.5 text-base',
    ];
    
    $variantClass = $variants[$variant ?? 'primary'];
    $sizeClass = $sizes[$size ?? 'md'];
@endphp

<button type="{{ $type ?? 'button' }}" 
        {{ $attributes->merge(['class' => "inline-flex items-center justify-center gap-x-2 rounded-lg font-semibold transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 $variantClass $sizeClass"]) }}>
    @if(isset($icon))
        <svg class="-ml-0.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
        </svg>
    @endif
    {{ $slot }}
</button>
