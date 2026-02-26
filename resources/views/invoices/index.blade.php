{{-- <x-app-layout>
    <x-slot:title>Invoices</x-slot:title>

    @php
        $invoices = [
            ['id' => 'INV-001', 'client' => 'Acme Corp', 'amount' => '$2,500.00', 'date' => 'Oct 24, 2023', 'status' => 'Paid', 'statusType' => 'success'],
            ['id' => 'INV-002', 'client' => 'Global Tech', 'amount' => '$1,200.00', 'date' => 'Oct 22, 2023', 'status' => 'Pending', 'statusType' => 'warning'],
            ['id' => 'INV-003', 'client' => 'Stellar Design', 'amount' => '$850.00', 'date' => 'Oct 20, 2023', 'status' => 'Overdue', 'statusType' => 'danger'],
            ['id' => 'INV-004', 'client' => 'Urban Apps', 'amount' => '$3,100.00', 'date' => 'Oct 18, 2023', 'status' => 'Paid', 'statusType' => 'success'],
            ['id' => 'INV-005', 'client' => 'Nexus Ltd', 'amount' => '$1,500.00', 'date' => 'Oct 15, 2023', 'status' => 'Paid', 'statusType' => 'success'],
            ['id' => 'INV-006', 'client' => 'Cloud Nine', 'amount' => '$4,200.00', 'date' => 'Oct 12, 2023', 'status' => 'Pending', 'statusType' => 'warning'],
            ['id' => 'INV-007', 'client' => 'Pixel Perfect', 'amount' => '$950.00', 'date' => 'Oct 10, 2023', 'status' => 'Paid', 'statusType' => 'success'],
        ];
    @endphp

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                <input type="text" class="input-field pl-10" placeholder="Search invoices...">
            </div>
            <div class="flex items-center gap-3">
                <x-components.button variant="secondary" icon="M3 4.5h18m-18 5h18m-18 5h18m-18 5h18">Filters</x-components.button>
                <x-components.button icon="M12 4.5v15m7.5-7.5h-15">New Invoice</x-components.button>
            </div>
        </div>

        <!-- Invoices Table -->
        <div class="card">
            <x-components.table :headers="['Invoice ID', 'Client', 'Amount', 'Date', 'Status']">
                @foreach($invoices as $invoice)
                <tr class="hover:bg-slate-50 transition-colors cursor-pointer">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-600">{{ $invoice['id'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-medium">{{ $invoice['client'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $invoice['amount'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $invoice['date'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <x-components.badge :type="$invoice['statusType']">{{ $invoice['status'] }}</x-components.badge>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <button class="text-slate-400 hover:text-slate-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                            <button class="text-slate-400 hover:text-slate-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </x-components.table>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
                <div class="text-sm text-slate-500">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">7</span> of <span class="font-medium">24</span> results
                </div>
                <div class="flex gap-2">
                    <x-components.button variant="secondary" size="sm">Previous</x-components.button>
                    <x-components.button variant="secondary" size="sm">Next</x-components.button>
                </div>
            </div>
        </div>
    </div>
<x-app-layout> --}}
