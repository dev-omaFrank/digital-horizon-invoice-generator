<style>
    input,
    textarea {
        margin-top: 5px;
        height: 2rem;
        border: 1.5px solid gray;
    }

    textarea {
        height: 50px;
    }
</style>
<!-- Overlay -->
<div id="clientModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <!-- Modal Card -->
    <div class="bg-white w-full max-w-xl rounded-xl shadow-xl p-6 mx-4 relative">

        <!-- Close Button -->
        <button onclick="closeModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            ✕
        </button>

        <h2 class="text-xl font-semibold mb-6" style="padding-top: 20px;">
            Add New Client
        </h2>

        <form method="POST" action="/client/create-client" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Company Name
                </label>
                <input type="text"
                    name="clientName"
                    placeholder="e.g. Acme Corp"
                    class="mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                @error('clientName')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Contact Email
                </label>
                <input type="email"
                    name="clientEmail"
                    placeholder="billing@company.com"
                    class="mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                @error('clientEmail')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Phone
                    </label>
                    <input type="text"
                        name="clientPhoneNo"
                        placeholder="+1(555) 666 7777"
                        class="mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @error('clientPhoneNo')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Address
                </label>
                <textarea name="clientAddress"
                    rows="3"
                    placeholder="123 Creative Lane, Suite 100
San Francisco, CA 9410"
                    class="mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>

                @error('clientAddress')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button"
                    onclick="closeModal()"
                    class="px-4 py-2 rounded-lg border text-gray-700 hover:bg-gray-50">
                    Cancel
                </button>

                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" style="background-color:#2462ea;">
                    Create Client
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('clientModal').classList.remove('hidden');
        document.getElementById('clientModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('clientModal').classList.add('hidden');
        document.getElementById('clientModal').classList.remove('flex');
    }
</script>