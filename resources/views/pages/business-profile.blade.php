<x-app-layout>
    <x-auth-navbar :userInitials="$userInitials"/>

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
                        <input type="text" placeholder="Search businesss..."
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <button class="btn-primary" onclick="openModal()">Create New Business</button>
                </div>

                <div class="card">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">All Businesses</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-slate-200">
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Business Name
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Total Invoices
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Total businesss
                                    </th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($businesses->isEmpty())
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">
                                            No Businesses found.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($businesses as $business)
                                        <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">

                                            <!-- business Name -->
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-sm">
                                                        {{ $business->business_name ? substr($business->business_name, 0, 1) : '-' }}
                                                    </div>
                                                    <p class="text-sm font-semibold text-slate-900">
                                                        {{ $business->business_name ?? '---' }}
                                                    </p>
                                                </div>
                                            </td>

                                            <!-- Email -->
                                            <td class="px-4 py-3 text-sm text-slate-600">
                                                {{ $business->business_email ?? '---' }}
                                            </td>

                                            <!-- Total Invoices (placeholder if not implemented yet) -->
                                            <td class="px-4 py-3 text-sm text-slate-900">
                                                {{ $business->invoices_count ?? '---' }}
                                            </td>

                                            <!-- Total Billed (placeholder if not implemented yet) -->
                                           <td class="px-4 py-3 text-sm font-semibold text-slate-900">
                                                {{ $business->invoices->first()->currency ?? '---' }}
                                                {{ number_format($business->invoices_sum_total ?? 0, 2) }}
                                            </td>


                                            <!-- Actions -->
                                            <td class="px-4 py-3 text-right">
                                                <button
                                                    class="text-slate-400 hover:text-slate-600 transition-colors text-sm font-medium">
                                                    Edit
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                        <div class="mt-6">
                            {{ $businesses->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('popups.add-business') --}}
</x-app-layout>
