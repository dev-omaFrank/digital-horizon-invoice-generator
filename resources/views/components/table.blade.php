<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                @foreach($headers as $header)
                <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    {{ $header }}
                </th>
                @endforeach
                @if(isset($actions))
                <th scope="col" class="relative px-6 py-3.5">
                    <span class="sr-only">Actions</span>
                </th>
                @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            {{ $slot }}
        </tbody>
    </table>
</div>
