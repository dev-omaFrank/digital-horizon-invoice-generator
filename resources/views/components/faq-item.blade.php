<div class="card cursor-pointer hover:shadow-md transition-shadow" x-data="{ open: false }">
    <button @click="open = !open" class="w-full flex items-center justify-between text-left">
        <h3 class="text-lg font-semibold text-slate-900">{{ $question }}</h3>
        <svg :class="{ 'rotate-180': open }" class="h-5 w-5 text-slate-600 flex-shrink-0 ml-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>
    <div x-show="open" class="mt-4 pt-4 border-t border-slate-200">
        <p class="text-slate-600">{{ $answer }}</p>
    </div>
</div>
