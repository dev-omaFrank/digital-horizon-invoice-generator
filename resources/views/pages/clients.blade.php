<x-app-layout>
    <x-auth-navbar />

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100">
        <x-mobile-toggle-button />
        <div class="flex-1 p-6 space-y-6">
            <div class="p-6 space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="relative max-w-sm w-full">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                        </svg>
                        <input type="text" placeholder="Search clients..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <button class="btn-primary" onclick="openModal()">Add Client</button>
                </div>

                <div class="card">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">All Clients</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-slate-200">
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Client Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Total Invoices</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Total Billed</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach([
                                ['Acme Corp', 'billing@acme.com', 12, '$15,400.00'],
                                ['Global Tech', 'finance@globaltech.io', 8, '$8,200.00'],
                                ['Stellar Design', 'hello@stellar.design', 5, '$4,150.00'],
                                ['Urban Apps', 'accounts@urbanapps.com', 15, '$22,300.00'],
                                ['Nexus Ltd', 'nexus@example.com', 3, '$2,800.00']
                                ] as $client)
                                <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-sm">
                                                {{ substr($client[0], 0, 1) }}
                                            </div>
                                            <p class="text-sm font-semibold text-slate-900">{{ $client[0] }}</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-600">{{ $client[1] }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-900">{{ $client[2] }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $client[3] }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <button class="text-slate-400 hover:text-slate-600 transition-colors text-sm font-medium">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('popups.add-client')
</x-app-layout>