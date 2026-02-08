<x-app-layout>
    <!-- Navbar -->
    <x-auth-navbar/>
<div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100">
    <!-- Main Layout -->
    

        <!-- Mobile Toggle Button -->
        <x-mobile-toggle-button/>

        <!-- Main Content -->
        <div class="flex-1 p-6 space-y-6">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @include('components.stat-card', [
                    'label' => 'Total Revenue',
                    'value' => '$45,231.89',
                    'change' => 12.5,
                    'icon' => '<svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>',
                    'iconBg' => 'bg-emerald-50'
                ])
                @include('components.stat-card', [
                    'label' => 'Outstanding',
                    'value' => '$12,405.00',
                    'change' => -2.4,
                    'icon' => '<svg class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5-1.5a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>',
                    'iconBg' => 'bg-amber-50'
                ])
                @include('components.stat-card', [
                    'label' => 'Active Clients',
                    'value' => '24',
                    'change' => 5.1,
                    'icon' => '<svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 001.591-.079 8.988 8.988 0 01-7.23 4.568 8.969 8.969 0 01-6.191-2.206A8.969 8.969 0 0121 12a8.97 8.97 0 01-7.23 8.128m0 0a9.364 9.364 0 01-1.584-.063 8.97 8.97 0 01-1.588-.15 8.987 8.987 0 00-7.231 4.569A8.969 8.969 0 0121 12Z" />
                              </svg>',
                    'iconBg' => 'bg-blue-50'
                ])
                @include('components.stat-card', [
                    'label' => 'Avg. Payment Time',
                    'value' => '4.2 Days',
                    'change' => 8.2,
                    'icon' => '<svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 014.125 21v-6.75zm9-2.670c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V10.455zm9-1.275c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v12.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V9.18z" />
                              </svg>',
                    'iconBg' => 'bg-purple-50'
                ])
            </div>

            <!-- Recent Invoices Table -->
            <div class="card">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Recent Invoices</h2>
                    <a href="/invoices" class="text-primary hover:text-primary-dark transition-colors text-sm font-medium">View all</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Invoice ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Client</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach([
                            ['INV-001', 'Acme Corp', '$2,500.00', 'Oct 24, 2023', 'Paid', 'emerald'],
                            ['INV-002', 'Global Tech', '$1,200.00', 'Oct 22, 2023', 'Pending', 'amber'],
                            ['INV-003', 'Stellar Design', '$850.00', 'Oct 20, 2023', 'Overdue', 'red'],
                            ['INV-004', 'Urban Apps', '$3,100.00', 'Oct 18, 2023', 'Paid', 'emerald'],
                            ['INV-005', 'Nexus Ltd', '$1,500.00', 'Oct 15, 2023', 'Paid', 'emerald']
                            ] as $invoice)
                            <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3 text-sm font-semibold text-primary">{{ $invoice[0] }}</td>
                                <td class="px-4 py-3 text-sm text-slate-900">{{ $invoice[1] }}</td>
                                <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $invoice[2] }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $invoice[3] }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                    @if($invoice[4] === 'Paid') bg-blue-50 text-emerald-700
                                    @elseif($invoice[4] === 'Pending') bg-amber-50 text-amber-700
                                    @else bg-red-50 text-red-700
                                    @endif">
                                        {{ $invoice[4] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
