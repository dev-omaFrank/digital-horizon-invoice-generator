<x-layout.app>
    <x-slot:title>Invoice INV-001</x-slot:title>

    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Actions -->
        <div class="flex items-center justify-between">
            <a href="#" class="text-sm font-medium text-slate-500 hover:text-slate-700 flex items-center gap-2">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Invoices
            </a>
            <div class="flex items-center gap-3">
                <x-components.button variant="secondary" icon="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231a1.125 1.125 0 01-1.12-1.227L6.34 18m11.318-4.171a3 3 0 000-5.658L12 5.25 6.342 8.171a3 3 0 000 5.658m11.318 0c.096.066.19.132.283.2">Print</x-components.button>
                <x-components.button icon="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3">Download PDF</x-components.button>
            </div>
        </div>

        <!-- Invoice Preview -->
        <div class="card p-12">
            <div class="flex justify-between items-start">
                <div>
                    <div class="h-12 w-12 rounded-xl bg-primary-600 flex items-center justify-center mb-4">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Digital Horizon</h2>
                    <p class="text-slate-500 text-sm">123 Creative Lane, Suite 100<br>San Francisco, CA 94103</p>
                </div>
                <div class="text-right">
                    <h1 class="text-4xl font-bold text-slate-900 uppercase tracking-tight">Invoice</h1>
                    <p class="text-slate-500 mt-1">#INV-001</p>
                    <div class="mt-4">
                        <x-components.badge type="success">Paid</x-components.badge>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-12 mt-12">
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Bill To</h3>
                    <p class="text-lg font-bold text-slate-900">Acme Corporation</p>
                    <p class="text-slate-500 text-sm">456 Enterprise Way<br>New York, NY 10001<br>contact@acme.com</p>
                </div>
                <div class="text-right">
                    <div class="space-y-2">
                        <div class="flex justify-end gap-4">
                            <span class="text-slate-500 text-sm">Invoice Date:</span>
                            <span class="text-slate-900 font-medium text-sm">Oct 24, 2023</span>
                        </div>
                        <div class="flex justify-end gap-4">
                            <span class="text-slate-500 text-sm">Due Date:</span>
                            <span class="text-slate-900 font-medium text-sm">Nov 07, 2023</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead>
                        <tr>
                            <th class="py-3.5 text-left text-sm font-bold text-slate-900">Description</th>
                            <th class="py-3.5 text-center text-sm font-bold text-slate-900">Qty</th>
                            <th class="py-3.5 text-right text-sm font-bold text-slate-900">Price</th>
                            <th class="py-3.5 text-right text-sm font-bold text-slate-900">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="py-4 text-sm text-slate-900">
                                <p class="font-medium">Brand Identity Design</p>
                                <p class="text-slate-500 text-xs">Complete rebranding including logo, typography, and color palette.</p>
                            </td>
                            <td class="py-4 text-center text-sm text-slate-500">1</td>
                            <td class="py-4 text-right text-sm text-slate-500">$1,500.00</td>
                            <td class="py-4 text-right text-sm font-medium text-slate-900">$1,500.00</td>
                        </tr>
                        <tr>
                            <td class="py-4 text-sm text-slate-900">
                                <p class="font-medium">Website Development</p>
                                <p class="text-slate-500 text-xs">Custom React-based landing page with CMS integration.</p>
                            </td>
                            <td class="py-4 text-center text-sm text-slate-500">1</td>
                            <td class="py-4 text-right text-sm text-slate-500">$1,000.00</td>
                            <td class="py-4 text-right text-sm font-medium text-slate-900">$1,000.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex justify-end">
                <div class="w-64 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Subtotal</span>
                        <span class="text-slate-900 font-medium">$2,500.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Tax (0%)</span>
                        <span class="text-slate-900 font-medium">$0.00</span>
                    </div>
                    <div class="pt-3 border-t border-slate-200 flex justify-between items-center">
                        <span class="text-base font-bold text-slate-900">Total</span>
                        <span class="text-2xl font-bold text-primary-600">$2,500.00</span>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-12 border-t border-slate-100">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Notes</h4>
                <p class="text-sm text-slate-500">Thank you for your business. Please make payment within 15 days of receiving this invoice.</p>
            </div>
        </div>
    </div>
</x-layout.app>
