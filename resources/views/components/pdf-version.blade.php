   <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1 style="font-size: 24px; font-weight: bold;">Invoice {{ $invoice->invoice_number }}</h1>
                        <p style="font-size: 12px; color: #6B7280;">Issued {{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Status and Logo Badge -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin: 8px 0;">
                    <!-- Status Badge -->
                    <div style="font-weight: bold;">
                        STATUS: 
                        <span style="padding: 4px 8px; font-weight: bolder;
                            {{ $invoice->status === 'paid' ? 'background-color:#D1FAE5; color:#065F46;' : '' }}
                            {{ $invoice->status === 'draft' ? 'background-color:#F3F4F6; color:#374151;' : '' }}
                            {{ $invoice->status === 'overdue' ? 'background-color:#FEE2E2; color:#991B1B;' : '' }}
                            {{ !in_array($invoice->status, ['paid','draft','overdue']) ? 'background-color:#FEF3C7; color:#78350F;' : '' }}
                        ">
                            {{ Str::upper($invoice->status) }}
                        </span>
                    </div>

                    <!-- Business Logo -->
                    <div>
                        @if($invoice->business->business_logo)
                            <img src="{{ public_path($invoice->business->business_logo) }}" 
                                alt="{{ $invoice->business->business_name }}" 
                                style="max-height: 60px; object-fit: contain;">
                        @endif
                    </div>
                </div>

                <!-- Business & Client Info -->
                <table style="width: 100%; margin-bottom: 16px;">
                    <tr>
                        <td style="vertical-align: top; padding: 12px; border:1px solid #ddd; border-radius:4px;">
                            <strong>From</strong><br>
                            {{$invoice->business->business_name}}<br>
                            {{ $invoice->business->business_email }}<br>
                            {{ $invoice->business->bankAccounts->account_name }} | {{ $invoice->business->bankAccounts->bank_name }} | {{ $invoice->business->bankAccounts->account_number }}
                        </td>
                        <td style="vertical-align: top; padding: 12px; border:1px solid #ddd; border-radius:4px;">
                            <strong>Bill To</strong><br>
                            {{ $invoice->client->client_name }}<br>
                            {{ $invoice->client->client_email }}
                        </td>
                    </tr>
                </table>

                <!-- Line Items Table -->
                <table style="width:100%; border-collapse: collapse; margin-bottom: 16px;">
                    <thead>
                        <tr>
                            <th style="border:1px solid #ddd; padding:8px; text-align:left;">Description</th>
                            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Qty</th>
                            <th style="border:1px solid #ddd; padding:8px; text-align:right;">Price</th>
                            <th style="border:1px solid #ddd; padding:8px; text-align:right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $item)
                            <tr>
                                <td style="border:1px solid #ddd; padding:8px;">{{ $item->description }}</td>
                                <td style="border:1px solid #ddd; padding:8px; text-align:center;">{{ $item->quantity }}</td>
                                <td style="border:1px solid #ddd; padding:8px; text-align:right;">{{ $invoice->currency }} {{ number_format($item->price,2) }}</td>
                                <td style="border:1px solid #ddd; padding:8px; text-align:right; font-weight:bold;">{{ $invoice->currency }} {{ number_format($item->total,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Totals -->
                <table style="width: 100%; margin-bottom: 16px;">
                    <tr>
                        <td style="width:66%;"></td>
                        <td style="width:34%; border:1px solid #ddd; padding:8px;">
                            <table style="width:100%; border-collapse: collapse;">
                                <tr>
                                    <td style="text-align:left;">Subtotal</td>
                                    <td style="text-align:right;">{{ $invoice->currency }} {{ number_format($invoice->subtotal,2) }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;">Tax</td>
                                    <td style="text-align:right;">{{ $invoice->currency }} {{ number_format($invoice->tax,2) }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;">Discount</td>
                                    <td style="text-align:right;">- {{ $invoice->currency }} {{ number_format($invoice->discount,2) }}</td>
                                </tr>
                                <tr>
                                    <td style="border-top:1px solid #ddd; font-weight:bold;">Total</td>
                                    <td style="border-top:1px solid #ddd; text-align:right; font-weight:bold; color: #2563EB;">{{ $invoice->currency }} {{ number_format($invoice->total,2) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Notes -->
                @if($invoice->notes)
                    <div style="margin-bottom:16px;">
                        <strong>Notes:</strong>
                        <p>{{ $invoice->notes }}</p>
                    </div>
                @endif

                <!-- Footer -->
                <div style="margin-top:32px; font-size:12px; color:#6B7280;">
                    <p>Please pay within 14 days. Contact {{ $invoice->business->business_email }} for questions.</p>
                    <em>Generate customized Invoices with Ledgerly. Click <a href="{{ url('/') }}">{{ url('/') }}</a> to get started.</em>
                </div>