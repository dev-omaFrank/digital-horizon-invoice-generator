<div class="stat-card">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm text-slate-600 mb-2">{{ $label }}</p>
            <p class="text-3xl font-bold text-slate-900">{{ $value }}</p>
            {{-- @if($change)
                <p class="text-sm mt-2 {{ $change > 0 ? 'text-emerald-600' : 'text-red-600' }}">
                    {{ $change > 0 ? '+' : '' }}{{ $change }}% vs last month
                </p>
            @endif --}}
        </div>
        @if($icon)
            <div class="h-12 w-12 rounded-lg {{ $iconBg }} flex items-center justify-center">
                {!! $icon !!}
            </div>
        @endif
    </div>
</div>
