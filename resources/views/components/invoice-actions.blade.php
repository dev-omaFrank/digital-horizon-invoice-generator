<div class="flex gap-2">

    <!-- View Invoice -->
    <a href="{{ route('invoices.show', $invoice->id) }}" 
       class="text-slate-400 hover:text-slate-600 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
             fill="currentColor" viewBox="0 0 24 24">
            <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
            <path d="M12 22c5.51 0 10-4.49 10-10S17.51 2 12 2 2 6.49 2 12s4.49 10 10 10m0-18c4.41 0 8 3.59 8 8s-3.59 8-8 8-8-3.59-8-8 3.59-8 8-8"></path>
        </svg>
    </a>

    <!-- Dropdown / Options -->
    <div x-data="{ open: false }" class="relative inline-block">
        <button @click="open = !open" 
                class="text-slate-400 hover:text-slate-600 transition-colors">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5z
                         M12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5z
                         M12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
            </svg>
        </button>

        <div x-show="open" @click.away="open = false" x-transition
             class="absolute right-0 mt-2 w-44 bg-white border rounded shadow-lg z-50">

            <!-- Change Status -->
            <form method="POST" action="{{ route('invoices.update', $invoice->id) }}">
                 
                @csrf
                @method('PATCH')
                <select name="status" class="block w-full px-4 py-2 text-sm text-slate-700 border-b hover:bg-gray-50">
                    @foreach(['draft','sent','paid','partial','overdue','cancelled'] as $status)
                        <option value="{{ $status }}" {{ $invoice->status === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-gray-50">
                    Update Status
                </button>
            </form>

            <!-- Download PDF -->
            {{-- <a href="{{ route('invoices.pdf', $invoice->id) }}" 
               class="block px-4 py-2 text-sm text-slate-700 hover:bg-gray-100">
                Download PDF
            </a> --}}

        </div>
    </div>
</div>
