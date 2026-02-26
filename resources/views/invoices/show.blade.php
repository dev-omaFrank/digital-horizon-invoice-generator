    <x-app-layout>
        {{-- <x-auth-navbar /> --}}

        <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100">
            {{-- <x-mobile-toggle-button /> --}}

        <div class="p-6 max-w-5xl mx-auto space-y-6 bg-white shadow rounded">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Invoice {{ $invoice->invoice_number }}</h1>
                <p class="text-sm text-slate-500">Issued {{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}</p>
            </div>

            <div class="flex gap-3">
                {{-- <a href="#" class="px-4 py-2 border border-slate-200 rounded-lg hover:bg-slate-50" style="background-color: blueviolet;color: white;">Edit</a> --}}
                <a href="{{ route('invoices.pdf', [$invoice->id, 'download' => 1]) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:opacity-90" style="background-color: blueviolet;color: white;">Download PDF</a>

                <a href="{{ route('invoices.index') }}" class="px-4 py-2 border border-slate-200 rounded-lg hover:bg-slate-50" style="background-color: blueviolet;color: white;">Back</a>
            </div>
        </div>

        <!-- Status Badge -->
        <div class="py-1 text-xl rounded-full">
            STATUS : 
            <span class="px-3 py-1 text-xl rounded-full
                    @if($invoice->status === 'paid') bg-green-100 text-green-700
                    @elseif($invoice->status === 'draft') bg-gray-100 text-gray-700
                    @elseif($invoice->status === 'overdue') bg-red-100 text-red-700
                    @else bg-yellow-100 text-yellow-700
                    @endif">
                    {{ ucfirst($invoice->status) }}
                </span>
        </div>

        <!-- Business & Client Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 border rounded shadow-sm">
                <h2 class="text-sm font-semibold text-slate-500 mb-2">From</h2>
                <p class="font-bold text-slate-900">{{$invoice->business->business_name}}</p>
                <p class="text-sm text-slate-600">{{ $invoice->business->business_email }}</p>
            </div>

            <div class="p-6 border rounded shadow-sm">
                <h2 class="text-sm font-semibold text-slate-500 mb-2">Bill To</h2>
                <p class="font-bold text-slate-900">{{ $invoice->client->client_name }}</p>
                <p class="text-sm text-slate-600">{{ $invoice->client->client_email }}</p>
            </div>
        </div>

        <!-- Line Items Table -->
        <div class="overflow-x-auto border rounded shadow-sm bg-white">
            <table class="min-w-full border-collapse">
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-semibold text-slate-500 uppercase">
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3 text-center">Qty</th>
                        <th class="px-6 py-3 text-right">Price</th>
                        <th class="px-6 py-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($invoice->items as $item)
                        <tr>
                            <td class="px-6 py-4">{{ $item->description }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 text-right">
                                {{ $invoice->currency }} {{ number_format($item->price, 2) }}
                            </td>
                            <td class="px-6 py-4 text-right font-semibold">
                                {{ $invoice->currency }} {{ number_format($item->total, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="flex justify-end">
            <div class="w-full md:w-1/3 space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Subtotal</span>
                    <span class="font-medium">{{ $invoice->currency }} {{ number_format($invoice->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Tax</span>
                    <span>{{ $invoice->currency }} {{ number_format($invoice->tax, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Discount</span>
                    <span>- {{ $invoice->currency }} {{ number_format($invoice->discount, 2) }}</span>
                </div>
                <div class="border-t pt-3 flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span class="text-blue-600">{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Notes -->
        @if($invoice->notes)
                <div class="card p-6">
                    <h3 class="font-semibold mb-2">Notes</h3>
                    <p class="text-slate-600 text-sm">
                        {{ $invoice->notes }}
                    </p>
                </div>
        @endif

        <footer>
        <div>
            <p class="text-slate-600 text-sm">
                Please pay within 14 days. Contact {{ $invoice->business->business_email }} for questions.
            </p>
        </div>
        <div>
            <em>Generate customized Invoices with Digital Horizon. Click <a href="{{ env('APP_URL') }}">here</a> to get started.</em>
        </div>

        </footer>

    </div>

        </div>
        
    </x-app-layout>
