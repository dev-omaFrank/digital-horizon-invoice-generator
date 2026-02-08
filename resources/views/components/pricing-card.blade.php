<div class="card {{ $featured ? 'ring-2 ring-primary shadow-lg' : '' }} relative">
    @if($featured)
        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
            <span class="bg-primary text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</span>
        </div>
    @endif
    
    <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ $name }}</h3>
    <p class="text-slate-600 mb-6">{{ $description }}</p>
    
    <div class="mb-6">
        <span class="text-4xl font-bold text-slate-900">${{ $price }}</span>
        <span class="text-slate-600 ml-2">/month</span>
    </div>
    
    <ul class="space-y-4 mb-8">
        @foreach($features as $feature)
            <li class="flex items-center gap-3">
                <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-slate-700">{{ $feature }}</span>
            </li>
        @endforeach
    </ul>
    
    <a href="/register" class="block text-center {{ $featured ? 'btn-primary' : 'btn-outline' }} w-full">
        {{ $cta ?? 'Get Started' }}
    </a>
</div>
