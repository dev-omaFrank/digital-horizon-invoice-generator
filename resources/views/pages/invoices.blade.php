<x-app-layout>
    <x-auth-navbar />

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100">
        <x-mobile-toggle-button />
        <div class="flex-1 p-6 space-y-6">
            <div class="p-6 space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="relative max-w-sm w-full">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-slate-400"
                            fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                        </svg>
                        <input type="text" placeholder="Search invoices..."
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <a href="/invoices/create" class="btn-primary text-center">New Invoice</a>
                </div>

                <div class="card">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">All Invoices</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-slate-200">
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Invoice ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Client</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Amount</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Status</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-3 text-sm font-semibold text-primary">
                                            {{ $invoice->invoice_number }}</td>
                                        <td class="px-4 py-3 text-sm text-slate-900">{{ $invoice->client->client_name }}
                                        </td>
                                        <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $invoice->total }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-slate-600">{{ $invoice->issue_date }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold 
                                    @if ($invoice->status === 'Paid') bg-emerald-50 text-emerald-700
                                    @elseif($invoice->status === 'Sent') bg-amber-50 text-amber-700
                                    @else bg-red-50 text-red-700 @endif">
                                                {{ Illuminate\Support\Str::of($invoice->status)->upper() }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <x-invoice-actions :invoice="$invoice" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex items-center justify-between text-sm text-slate-600">
                        <p>
                            Showing {{ $invoices->firstItem() }}
                            to {{ $invoices->lastItem() }}
                            of {{ $invoices->total() }} results
                        </p>
                        <div class="flex gap-2">
                            <button
                                class="px-3 py-1 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">{{ $invoices->links() }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
