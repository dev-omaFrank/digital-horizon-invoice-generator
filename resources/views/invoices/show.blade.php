<x-app-layout>
    @php
        $isPdf = request()->query('download') ?? false;
    @endphp

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100">

        <div class="p-6 max-w-5xl mx-auto space-y-6 bg-white shadow rounded">

            @if($isPdf)
                {{-- PDF-friendly layout(pdf-version) --}}
                <!-- Header -->
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1 style="font-size: 24px; font-weight: bold;">Invoice {{ $invoice->invoice_number }}</h1>
                        <p style="font-size: 12px; color: #6B7280;">Issued {{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Status and Logo Badge -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin: 8px 0;">
                    <!-- Status Badge -->
                    <div style="font-weight: bold;">
                        STATUS: 
                        <span style="padding: 4px 8px; font-weight: bolder;
                            {{ $invoice->status === 'paid' ? 'background-color:#D1FAE5; color:#065F46;' : '' }}
                            {{ $invoice->status === 'draft' ? 'background-color:#F3F4F6; color:#374151;' : '' }}
                            {{ $invoice->status === 'overdue' ? 'background-color:#FEE2E2; color:#991B1B;' : '' }}
                            {{ !in_array($invoice->status, ['paid','draft','overdue']) ? 'background-color:#FEF3C7; color:#78350F;' : '' }}
                        ">
                            {{ Str::upper($invoice->status) }}
                        </span>
                    </div>

                    <!-- Business Logo -->
                    {{-- <div>
                        @if($invoice->business->business_logo)
                            <img src="{{ asset('storage/' . $invoice->business->business_logo) }}" 
                                alt="{{ $invoice->business->business_name }} logo" 
                                style="max-height: 60px; object-fit: contain; border-radius: 10px;">
                        @endif
                    </div> --}}
                </div>

                <!-- Business & Client Info -->
                <table style="width: 100%; margin-bottom: 16px;">
                    <tr>
                        <td style="vertical-align: top; padding: 12px; border:1px solid #ddd; border-radius:4px;">
                            <strong>From</strong><br>
                            {{$invoice->business->business_name}}<br>
                            {{ $invoice->business->business_email }}<br>
                            {{ $invoice->business->bankAccounts->account_name }} | {{ $invoice->business->bankAccounts->bank_name }} | {{ $invoice->business->bankAccounts->account_number }}
                        </td>
                        <td style="vertical-align: top; padding: 12px; border:1px solid #ddd; border-radius:4px;">
                            <strong>Bill To</strong><br>
                            {{ $invoice->client->client_name }}<br>
                            {{ $invoice->client->client_email }}
                        </td>
                    </tr>
                </table>

                <!-- Line Items Table -->
                <table style="width:100%; border-collapse: collapse; margin-bottom: 16px;">
                    <thead>
                        <tr>
                            <th style="border:1px solid #ddd; padding:8px; text-align:left;">Description</th>
                            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Qty</th>
                            <th style="border:1px solid #ddd; padding:8px; text-align:right;">Price</th>
                            <th style="border:1px solid #ddd; padding:8px; text-align:right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $item)
                            <tr>
                                <td style="border:1px solid #ddd; padding:8px;">{{ $item->description }}</td>
                                <td style="border:1px solid #ddd; padding:8px; text-align:center;">{{ $item->quantity }}</td>
                                <td style="border:1px solid #ddd; padding:8px; text-align:right;">{{ $invoice->currency }} {{ number_format($item->price,2) }}</td>
                                <td style="border:1px solid #ddd; padding:8px; text-align:right; font-weight:bold;">{{ $invoice->currency }} {{ number_format($item->total,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Totals -->
                <table style="width: 100%; margin-bottom: 16px;">
                    <tr>
                        <td style="width:66%;"></td>
                        <td style="width:34%; border:1px solid #ddd; padding:8px;">
                            <table style="width:100%; border-collapse: collapse;">
                                <tr>
                                    <td style="text-align:left;">Subtotal</td>
                                    <td style="text-align:right;">{{ $invoice->currency }} {{ number_format($invoice->subtotal,2) }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;">Tax</td>
                                    <td style="text-align:right;">{{ $invoice->currency }} {{ number_format($invoice->tax,2) }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;">Discount</td>
                                    <td style="text-align:right;">- {{ $invoice->currency }} {{ number_format($invoice->discount,2) }}</td>
                                </tr>
                                <tr>
                                    <td style="border-top:1px solid #ddd; font-weight:bold;">Total</td>
                                    <td style="border-top:1px solid #ddd; text-align:right; font-weight:bold; color: #2563EB;">{{ $invoice->currency }} {{ number_format($invoice->total,2) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Notes -->
                @if($invoice->notes)
                    <div style="margin-bottom:16px;">
                        <strong>Notes:</strong>
                        <p>{{ $invoice->notes }}</p>
                    </div>
                @endif

                <!-- Footer -->
                <div style="margin-top:32px; font-size:12px; color:#6B7280;">
                    <p>Please pay within 14 days. Contact {{ $invoice->business->business_email }} for questions.</p>
                    <em>Generate customized Invoices with Ledgerly. Click <a href="{{ url('/') }}">{{ url('/') }}</a> to get started.</em>
                </div>

            @else
                {{-- Original Tailwind-based responsive layout(web-version) --}}
                {{-- Paste your original Blade code here, unchanged --}}
                {{-- This preserves full web responsiveness --}}
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Invoice {{ $invoice->invoice_number }}</h1>
                        <p class="text-sm text-slate-500">Issued {{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}</p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('invoices.pdf', [$invoice->id, 'download' => 1]) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:opacity-90" style="background-color: blueviolet;color: white;">Download PDF</a>
                        <a href="{{ route('invoices.index') }}" class="px-4 py-2 border border-slate-200 rounded-lg hover:bg-slate-50" style="background-color: blueviolet;color: white;">Back</a>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin: 8px 0;">
                    <!-- Status Badge -->
                    <div style="font-weight: bold;">
                        STATUS: 
                        <span style="padding: 4px 8px; font-weight: bolder;
                            {{ $invoice->status === 'paid' ? 'background-color:#D1FAE5; color:#065F46;' : '' }}
                            {{ $invoice->status === 'draft' ? 'background-color:#F3F4F6; color:#374151;' : '' }}
                            {{ $invoice->status === 'overdue' ? 'background-color:#FEE2E2; color:#991B1B;' : '' }}
                            {{ !in_array($invoice->status, ['paid','draft','overdue']) ? 'background-color:#FEF3C7; color:#78350F;' : '' }}
                        ">
                            {{ Str::upper($invoice->status) }}
                        </span>
                    </div>

                    <!-- Business Logo -->
                    {{-- <div>
                        @if($invoice->business->business_logo)
                            <img src="{{ asset('storage/' . $invoice->business->business_logo) }}" 
                                alt="{{ $invoice->business->business_name }} logo" 
                                style="max-height: 60px; object-fit: contain;border-radius: 10px;">
                        @endif
                    </div> --}}
                </div>

                <!-- Business & Client Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 border rounded shadow-sm">
                        <h2 class="text-sm font-semibold text-slate-500 mb-2">From</h2>
                        <p class="font-bold text-slate-900">{{$invoice->business->business_name}}</p>
                        <p class="text-sm text-slate-600">{{ $invoice->business->business_email }}</p>
                        <span class="text-sm text-slate-600">{{ $invoice->business->bankAccounts->account_name }}</span> | <span class="text-sm text-slate-600">{{ $invoice->business->bankAccounts->bank_name }}</span> | <span class="text-sm text-slate-600">{{ $invoice->business->bankAccounts->account_number }}</span>
                        
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
                        <em>Generate customized Invoices with Ledgerly. Click <a href="{{ url('/') }}">here</a> to get started.</em>
                    </div>

                </footer>

            @endif

        </div>
    </div>
</x-app-layout>