<div class="feature-card">
    @if($icon)
        <div class="h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center mb-4">
            {!! $icon !!}
        </div>
    @endif
    <h3 class="text-lg font-semibold text-slate-900 mb-2">{{ $title }}</h3>
    <p class="text-slate-600">{{ $description }}</p>
</div>
