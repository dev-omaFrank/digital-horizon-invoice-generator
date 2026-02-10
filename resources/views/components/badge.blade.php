@php
    $colors = [
        'success' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
        'warning' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
        'danger' => 'bg-rose-50 text-rose-700 ring-rose-600/20',
        'info' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
        'neutral' => 'bg-slate-50 text-slate-700 ring-slate-600/20',
    ];
    $colorClass = $colors[$type ?? 'neutral'];
@endphp

<span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $colorClass }}">
    {{ $slot }}
</span>
