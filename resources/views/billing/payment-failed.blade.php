<!-- Payment Failed Page - Copy and paste into your Blade file -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed - Digital Horizon Invoices</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
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

        @keyframes pulse-ring-red {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }
            100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        .pulse-ring-red {
            animation: pulse-ring-red 2s ease-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-red-50 to-orange-50">
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
            <!-- Error Icon -->
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="pulse-ring-red absolute inset-0 rounded-full bg-red-400/20"></div>
                    <div class="relative w-24 h-24 rounded-full bg-gradient-to-br from-red-400 to-red-500 flex items-center justify-center shake">
                        <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="text-center mb-8">
                <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-4">Payment Failed</h1>
                <p class="text-xl text-slate-600">We couldn't process your payment. Please try again.</p>
            </div>

            <!-- Error Details Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-slate-200 mb-8">
                <div class="space-y-6">
                    <!-- Error Info -->
                    <div class="border-b border-slate-200 pb-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">What Went Wrong?</h2>
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-sm text-red-900 font-medium mb-2">Error Code: {{ $error_code ?? 'PAYMENT_DECLINED' }}</p>
                            <p class="text-sm text-red-800">
                                {{ $error_message ?? 'Your payment method was declined. This could be due to insufficient funds, incorrect card details, or your bank declining the transaction.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Common Reasons -->
                    <div class="border-b border-slate-200 pb-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Common Reasons:</h2>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-700"><strong>Insufficient funds</strong> - Your account doesn't have enough balance</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-700"><strong>Incorrect card details</strong> - Check your card number, expiry, or CVV</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-700"><strong>Bank declined</strong> - Your bank or card issuer declined the transaction</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-700"><strong>Expired card</strong> - Your card has expired or is no longer valid</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-700"><strong>3D Secure failed</strong> - Additional verification was not completed</span>
                            </li>
                        </ul>
                    </div>

                    <!-- What to Do -->
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">What You Can Do:</h2>
                        <ol class="space-y-3">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm">1</span>
                                <span class="text-slate-700">Double-check your card details (number, expiry, CVV)</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm">2</span>
                                <span class="text-slate-700">Ensure your card has sufficient funds</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm">3</span>
                                <span class="text-slate-700">Contact your bank to verify the transaction isn't blocked</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm">4</span>
                                <span class="text-slate-700">Try a different payment method</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm">5</span>
                                <span class="text-slate-700">Contact our support team for assistance</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a 
                    href="{{ route('billing.upgrade') }}" 
                    class="py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200 text-center block"
                >
                    Try Again
                </a>
                <a 
                    href="{{ route('pages.dashboard') }}" 
                    class="py-3 px-6 border-2 border-slate-300 text-slate-900 font-semibold rounded-lg hover:bg-slate-50 transition-colors duration-200 text-center block"
                >
                    Back to Dashboard
                </a>
            </div>

            <!-- Alternative Payment Methods -->
            <div class="mt-8 p-6 bg-blue-50 rounded-lg border border-blue-200">
                <h3 class="text-sm font-semibold text-blue-900 mb-3">Other Payment Options:</h3>
                <p class="text-sm text-blue-800 mb-3">
                    If you're having trouble with your current payment method, you can try:
                </p>
                <ul class="space-y-2 text-sm text-blue-800">
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>A different credit or debit card</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>PayPal or Apple Pay</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Bank transfer or wire</span>
                    </li>
                </ul>
            </div>

            <!-- Support -->
            <div class="mt-8 text-center">
                <p class="text-slate-600 mb-3">Still having issues?</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:support@digitalhorizon.com" class="text-blue-600 hover:text-blue-700 font-medium">
                        Email Support
                    </a>
                    <span class="hidden sm:block text-slate-400">•</span>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">
                        Live Chat
                    </a>
                    <span class="hidden sm:block text-slate-400">•</span>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">
                        Help Center
                    </a>
                </div>
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
