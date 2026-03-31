<x-app-layout>
    <x-auth-navbar :userInitials="$userInitials"/>

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100">
        <x-mobile-toggle-button />
        <div class="flex-1 p-6 space-y-6">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="relative max-w-sm w-full">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-slate-400"
                         fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                    </svg>
                    <input type="text" placeholder="Search subscriptions..."
                           class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <button class="btn-primary" onclick="openModal()">Renew Subscription</button>
            </div>

            <!-- Subscriptions Table -->
            <div class="card">
                <h2 class="text-xl font-bold text-slate-900 mb-6">All Subscriptions</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Cardholder Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Start Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">End Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Next Billing</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subscriptions as $subscription)
                                <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3 text-sm text-slate-900">
                                        {{ $subscription->plan->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-900">
                                        {{ ucfirst($subscription->status) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-900">
                                        {{ $subscription->start_date ? $subscription->start_date->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-900">
                                        {{ $subscription->end_date ? $subscription->end_date->copy()->subDays(3)->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-900">
                                        {{ $subscription->next_billing_date ? $subscription->next_billing_date->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <button class="text-slate-400 hover:text-slate-600 transition-colors text-sm font-medium">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-500">
                                        No subscriptions found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $subscriptions->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>