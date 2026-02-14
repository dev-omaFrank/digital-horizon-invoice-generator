<x-app-layout>
    <x-auth-navbar />

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100">
        <x-mobile-toggle-button />
        <div class="flex-1 p-6 space-y-6">
            <div class="p-6 max-w-4xl space-y-8">
                <!-- Business Profile -->
                <form action="/business/create-business-profile" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <h2 class="text-xl font-bold text-slate-900 mb-2">Business Profile</h2>
                        <p class="text-sm text-slate-600 mb-6">This information will appear on your invoices.</p>

                        <div class="space-y-6">
                            <div class="flex items-center gap-6">
                                <div class="h-20 w-20 rounded-lg bg-slate-100 border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 cursor-pointer hover:bg-slate-50 transition-colors" id="imagePreview" src="">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span class="text-[10px] font-bold uppercase mt-1">Logo</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-900">Business Logo (Optional)</h4>
                                    <p class="text-xs text-slate-600 mt-1">PNG, JPG up to 2MB. Recommended size 400x400px.</p>
                                    <div class="mt-3 flex gap-2">
                                        <input type="file" accept="image/*" name="businessLogo" id="fileInput" class="text-xs px-3 py-1 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors font-medium">
                                        <button class="text-xs px-3 py-1 text-red-600 hover:bg-red-50 transition-colors font-medium" id="removeBtn">Remove</button>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-slate-900 mb-2">Business Name</label>
                                    <input type="text" name="businessName" placeholder="Digital Horizon" class="w-full px-2 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">

                                    @error('businessName')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-900 mb-2">Email Address</label>
                                    <input type="email" name="businessEmail" placeholder="alex@example.com" class="w-full px-2 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">

                                    @error('businessEmail')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-900 mb-2">Phone Number</label>
                                    <input type="tel" name="businessPhoneNo" placeholder="+1 (555) 000-0000" class="w-full px-2 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">

                                    @error('businessPhoneNo')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-slate-900 mb-2">Address</label>
                                    <textarea name="businessAddress" class="w-full px-2 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary h-24" placeholder="123 Creative Lane, Suite 100
San Francisco, CA 94103"></textarea>
                                @error('businessAddress')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-200 flex justify-end">
                            <button type="submit" class="btn-primary">Create Business Profile</button>
                        </div>
                    </div>
                </form>


                <!-- Invoicing Preferences -->
                <!-- <div class="card">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Invoicing Preferences</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Default Currency</label>
                            <select class="w-full px-2 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">
                                <option>USD ($)</option>
                                <option>EUR (€)</option>
                                <option>GBP (£)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Default Tax Rate (%)</label>
                            <input type="number" value="10" class="w-full px-2 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-900 mb-2">Bank Information (Displayed on Invoice)</label>
                            <textarea placeholder="Bank Name, Account Number, SWIFT/BIC..." class="w-full px-2 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary h-24"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-200 flex justify-end">
                        <button class="btn-primary">Save Preferences</button>
                    </div>
                </div> -->
            </div>

        </div>

    </div>

    <script>
        const preview = document.querySelector("#imagePreview");
        document.querySelector('#fileInput').addEventListener('change', (e) => {
            const file = e.target.files[0];
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];

            if (file) {
                const fileName = file.name;
                const fileExtension = fileName.split('.').pop().toLowerCase();

                if (allowedExtensions.includes(fileExtension)) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        // 1. Set the background image on the DIV
                        preview.style.backgroundImage = `url('${event.target.result}')`;
                        preview.style.backgroundSize = 'cover';
                        preview.style.backgroundPosition = 'center';

                        // 2. Hide the placeholder icon and text
                        preview.querySelectorAll('svg, span').forEach(el => el.style.display = 'none');

                        // 3. Optional: remove the dashed border
                        preview.style.borderStyle = 'solid';
                    };

                    reader.readAsDataURL(file);
                } else {
                    alert('Invalid file type');
                    e.target.value = "";
                }
            }
        });

        document.querySelector('#removeBtn').addEventListener('click', (e) => {
            e.preventDefault();
            preview.style.backgroundImage = ''
        })
    </script>
</x-app-layout>