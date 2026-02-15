<x-app-layout>
    <x-auth-navbar />

    <div x-data="appLayout()" class="flex min-h-screen bg-gray-100">
    <x-mobile-toggle-button />
        <div class="flex-1 p-6 space-y-6">

            <!-- Page Header -->
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-slate-900">Create Invoice</h1>
            </div>

            <form action="#" method="POST" class="space-y-6">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- LEFT SIDE -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Invoice Details -->
                        <div class="card p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-6">
                                Invoice Details
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div>
                                    <label class="input-label">Client</label>
                                    <select class="input-field">
                                        <option>Select a client</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="input-label">Invoice Number</label>
                                    <input type="text" class="input-field" value="INV-008">
                                </div>

                                <div>
                                    <label class="input-label">Invoice Date</label>
                                    <input type="date" class="input-field" value="{{ date('Y-m-d') }}">
                                </div>

                                <div>
                                    <label class="input-label">Due Date</label>
                                    <input type="date" class="input-field" value="{{ date('Y-m-d', strtotime('+14 days')) }}">
                                </div>

                            </div>
                        </div>

                        <!-- Line Items -->
                        <div class="card">

                            <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                                <h2 class="text-lg font-semibold text-slate-900">
                                    Line Items
                                </h2>

                                <button type="button"
                                        @click="addItem"
                                        class="btn-primary text-sm px-4 py-2">
                                    Add Item
                                </button>
                            </div>

                            <div class="p-6 overflow-x-auto">
                                <table class="min-w-full">

                                    <thead>
                                        <tr class="border-b border-slate-200 text-left text-xs font-semibold text-slate-500 uppercase">
                                            <th class="py-3 pr-4">Description</th>
                                            <th class="py-3 px-4 w-24">Qty</th>
                                            <th class="py-3 px-4 w-32">Price</th>
                                            <th class="py-3 px-4 w-32 text-right">Total</th>
                                            <th class="py-3 w-10"></th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-slate-100">
                                        <template x-for="(item, index) in items" :key="index">
                                            <tr>
                                                <td class="py-4 pr-4">
                                                    <input type="text"
                                                           x-model="item.description"
                                                           class="input-field"
                                                           placeholder="Item description">
                                                </td>

                                                <td class="py-4 px-4">
                                                    <input type="number"
                                                           x-model.number="item.quantity"
                                                           class="input-field text-center">
                                                </td>

                                                <td class="py-4 px-4">
                                                    <input type="number"
                                                           x-model.number="item.price"
                                                           class="input-field text-right">
                                                </td>

                                                <td class="py-4 px-4 text-right text-sm font-semibold text-slate-900"
                                                    x-text="formatCurrency(item.quantity * item.price)">
                                                </td>

                                                <td class="py-4 text-right">
                                                    <button type="button"
                                                            @click="removeItem(index)"
                                                            class="text-slate-400 hover:text-rose-600 transition-colors text-sm">
                                                        Remove
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT SIDE (Summary) -->
                    <div class="space-y-6">

                        <div class="card p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-6">
                                Summary
                            </h2>

                            <div class="space-y-4">

                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Subtotal</span>
                                    <span class="font-semibold text-slate-900"
                                          x-text="formatCurrency(getSubtotal())"></span>
                                </div>

                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">Tax (%)</span>
                                    <input type="number"
                                           x-model.number="taxRate"
                                           class="input-field w-20 text-right py-1">
                                </div>

                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">Discount ($)</span>
                                    <input type="number"
                                           x-model.number="discount"
                                           class="input-field w-24 text-right py-1">
                                </div>

                                <div class="pt-4 border-t border-slate-200 flex justify-between items-center">
                                    <span class="font-bold text-slate-900">Total</span>
                                    <span class="text-xl font-bold text-primary"
                                          x-text="formatCurrency(getTotal())"></span>
                                </div>

                            </div>

                            <div class="mt-8 space-y-3">
                                <button class="btn-primary w-full">
                                    Save Invoice
                                </button>

                                <button type="button"
                                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">
                                    Preview PDF
                                </button>
                            </div>
                        </div>

                        <div class="card p-6">
                            <h3 class="text-sm font-semibold text-slate-900 mb-4">
                                Notes & Terms
                            </h3>
                            <textarea class="input-field h-32"
                                      placeholder="Additional notes for the client..."></textarea>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>

    <script>
    function appLayout() {
        return {
            // Sidebar state
            sidebarOpen: false,

            // Invoice state
            items: [{ description: '', quantity: 1, price: 0 }],
            taxRate: 10,
            discount: 0,

            addItem() {
                this.items.push({ description: '', quantity: 1, price: 0 });
            },

            removeItem(index) {
                this.items.splice(index, 1);
            },

            getSubtotal() {
                return this.items.reduce((sum, item) => 
                    sum + (item.quantity * item.price), 0);
            },

            getTotal() {
                return this.getSubtotal() +
                       (this.getSubtotal() * (this.taxRate / 100)) -
                       this.discount;
            },

            formatCurrency(amount) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(amount);
            }
        }
    }
</script>


</x-app-layout>
