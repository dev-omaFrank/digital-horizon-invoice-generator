<x-app-layout>
    <x-auth-navbar />

    <div x-data="appLayout()" class="flex min-h-screen bg-gray-100">
    <x-mobile-toggle-button />
        <div class="flex-1 p-6 space-y-6">

            <!-- Page Header -->
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-slate-900">Create Invoice</h1>
            </div>

            <form action="{{ route('invoices.create') }}" method="post" class="space-y-6">
                @csrf
                {{-- GLOBAL ERROR BLOCK --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-300 rounded-lg">
                        <ul class="text-red-600 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                                    <label class="input-label">Send to: Client Name(Email)</label>
                                    <select name="client_id" class="input-field" required>
                                        <option value="">Select a client</option>
                                        @forelse($clients as $client)
                                            <option value="{{ $client->id }}">
                                                {{ $client->client_name }}({{ $client->client_email }})
                                            </option>
                                        @empty
                                            <option disabled>No clients available</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div>
                                    <label class="input-label">Sent by: Business Name(Email)</label>
                                    <select name="business_id" class="input-field" required>
                                        <option value="">Select your business</option>
                                        @forelse($businesses as $business)
                                            <option value="{{ $business->id }}">
                                                {{ $business->business_name }}({{ $business->business_email }})
                                            </option>
                                        @empty
                                            <option disabled>You have not created any businesses</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div>
                                    <label class="input-label">Invoice Number</label>
                                    <input type="text" name="invoice_number" class="input-field" value="INV-001" required>
                                </div>

                                <div>
                                    <label class="input-label">Invoice Date</label>
                                    <input type="date" name="issue_date" class="input-field" value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div>
                                    <label class="input-label">Due Date</label>
                                    <input type="date" name="due_date" class="input-field" value="{{ date('Y-m-d', strtotime('+14 days')) }}" required>
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
                                                        :name="`items[${index}][description]`"
                                                        x-model="item.description"
                                                        class="input-field"
                                                        placeholder="Item description"
                                                        required>
                                                </td>

                                                <td class="py-4 px-4">
                                                    <input type="number"
                                                        :name="`items[${index}][quantity]`"
                                                        x-model.number="item.quantity"
                                                        class="input-field text-center"
                                                        min="1"
                                                        required>
                                                </td>

                                                <td class="py-4 px-4">
                                                    <input type="number"
                                                        :name="`items[${index}][price]`"
                                                        x-model.number="item.price"
                                                        class="input-field text-right"
                                                        step="1"
                                                        min="0"
                                                        required>
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
                                        x-text="formatCurrency(getSubtotal())">NGN</span>
                                    <input type="hidden"
                                        name="subtotal"
                                        :value="getSubtotal().toFixed(2)">
                                </div>

                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">Tax (%)</span>
                                    <input type="number"
                                        name="tax"
                                        x-model.number="taxRate"
                                        class="input-field w-20 text-right py-1"
                                        step="0.01"
                                        min="0">
                                </div>

                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">Discount (NGN)</span>
                                    <input type="number"
                                        name="discount"
                                        x-model.number="discount"
                                        class="input-field w-24 text-right py-1"
                                        step="0.01"
                                        min="0">
                                </div>

                                <div class="pt-4 border-t border-slate-200 flex justify-between items-center">
                                    <span class="font-bold text-slate-900">Total</span>
                                    <span class="text-xl font-bold text-primary"
                                        x-text="formatCurrency(getTotal())"></span>
                                        <input type="hidden"
                                            name="total"
                                            :value="getTotal().toFixed(2)">
                                </div>

                            </div>

                            <div class="mt-8 space-y-3">
                                <button type="submit" class="btn-primary w-full">
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
                            <textarea name="notes" class="input-field h-32"
                                    placeholder="Additional notes for the client..."></textarea>
                        </div>

                    </div>

                </div>
                <input type="hidden" id="currency" name="currency" :value="currency" />
                <input type="hidden" id="status" name="status" value="draft" />
            </form>

        </div>
    </div>

    <script>
    function appLayout() {
        return {
            currency: 'NGN',

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
                    currency: this.currency
                }).format(amount);
            }
        }
    }
</script>


</x-app-layout>
