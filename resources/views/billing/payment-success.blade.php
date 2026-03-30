<!-- Payment Success Page - Copy and paste into your Blade file -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Digital Horizon Invoices</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes checkmark {
            0% {
                stroke-dashoffset: 50;
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                stroke-dashoffset: 0;
                opacity: 1;
            }
        }

        .checkmark {
            animation: checkmark 0.6s ease-out 0.3s forwards;
            stroke-dasharray: 50;
            stroke-dashoffset: 50;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideUp 0.5s ease-out;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }
            100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        .pulse-ring {
            animation: pulse-ring 2s ease-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-50">
    <!-- Navigation -->
    <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-lg bg-blue-600 flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-slate-900">Digital Horizon</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-2xl animate-slide-up">
            <!-- Success Icon -->
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="pulse-ring absolute inset-0 rounded-full bg-green-400/20"></div>
                    <div class="relative w-24 h-24 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white checkmark" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            <div class="text-center mb-8">
                <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-4">Payment Successful!</h1>
                <p class="text-xl text-slate-600">Your upgrade to Pro has been confirmed</p>
            </div>

            <!-- Success Details Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-slate-200 mb-8">
                <div class="space-y-6">
                    <!-- Transaction Info -->
                    <div class="border-b border-slate-200 pb-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Transaction Details</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-slate-600 font-medium">Transaction ID</p>
                                <p class="text-lg font-mono font-semibold text-slate-900 mt-1">{{ $transaction_id ?? 'TXN-2024-001' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600 font-medium">Date & Time</p>
                                <p class="text-lg font-semibold text-slate-900 mt-1">{{ now()->format('M d, Y • H:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600 font-medium">Plan</p>
                                <p class="text-lg font-semibold text-slate-900 mt-1">Pro Plan</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600 font-medium">Amount</p>
                                <p class="text-lg font-semibold text-green-600 mt-1">$29.00/month</p>
                            </div>
                        </div>
                    </div>

                    <!-- What's Included -->
                    <div class="border-b border-slate-200 pb-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">You Now Have Access To:</h2>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-green-100">
                                        <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-slate-700">Unlimited invoices</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-green-100">
                                        <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-slate-700">20+ premium templates</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-green-100">
                                        <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-slate-700">Real-time payment tracking</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-green-100">
                                        <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-slate-700">Online payment acceptance</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-green-100">
                                        <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-slate-700">Priority 24/7 support</span>
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps -->
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">What's Next?</h2>
                        <ol class="space-y-3">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm">1</span>
                                <span class="text-slate-700">A confirmation email has been sent to <strong>{{ auth()->user()->email ?? 'your email' }}</strong></span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm">2</span>
                                <span class="text-slate-700">Your Pro features are now active in your account</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm">3</span>
                                <span class="text-slate-700">Start creating unlimited invoices and explore premium templates</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a 
                    href="{{ route('pages.dashboard') }}" 
                    class="py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200 text-center block"
                >
                    Go to Dashboard
                </a>
                <a 
                    href="{{ route('invoices.create') }}" 
                    class="py-3 px-6 border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition-colors duration-200 text-center block"
                >
                    Create Invoice
                </a>
            </div>

            <!-- Receipt Info -->
            <div class="mt-8 p-6 bg-slate-50 rounded-lg border border-slate-200">
                <p class="text-sm text-slate-600 mb-3">
                    <strong>Receipt & Invoice:</strong> A detailed receipt has been sent to your email. You can also download it from your account settings.
                </p>
                <p class="text-xs text-slate-500">
                    Your subscription will renew automatically on {{ now()->addMonth()->format('M d, Y') }}. You can cancel anytime from your billing settings.
                </p>
            </div>

            <!-- Support -->
            <div class="mt-8 text-center">
                <p class="text-slate-600 mb-2">Need help?</p>
                <a href="mailto:support@digitalhorizon.com" class="text-blue-600 hover:text-blue-700 font-medium">
                    Contact our support team
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <p class="text-sm text-slate-600">© 2024 Digital Horizon. All rights reserved.</p>
                <div class="flex gap-6 mt-4 sm:mt-0">
                    <a href="#" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Privacy</a>
                    <a href="#" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Terms</a>
                    <a href="#" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Support</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
