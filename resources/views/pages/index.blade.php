@extends('layouts.landing')

@section('title', 'Digital Horizon Invoices - Simple Invoice Generator for Freelancers')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden section-spacing">
    <div class="container-max">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl sm:text-6xl font-bold tracking-tight text-slate-900 leading-tight">
                    Create professional invoices in 30 seconds
                </h1>
                <p class="mt-6 text-xl text-slate-600 leading-relaxed">
                    Get paid faster with Digital Horizon. The simplest invoice generator for freelancers and small businesses.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="/register" class="btn-primary text-center">Start Free</a>
                    <a href="/dashboard" class="btn-outline text-center">See Demo</a>
                </div>
                <p class="mt-6 text-sm text-slate-500">
                    No credit card required. Free forever plan available.
                </p>
            </div>

            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-primary/5 rounded-3xl blur-3xl"></div>
                <div class="card relative shadow-2xl">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-slate-900">Invoice INV-001</h3>
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full">Paid</span>
                        </div>
                        <div class="border-t border-slate-200 pt-4">
                            <div class="flex justify-between text-sm mb-3">
                                <span class="text-slate-600">John Doe</span>
                                <span class="font-semibold text-slate-900">NGN25,000.00</span>
                            </div>
                            <div class="flex justify-between text-sm mb-3">
                                <span class="text-slate-600">Social Media Marketing Services</span>
                                <span class="text-slate-900">NGN25,000.00</span>
                            </div>
                            <div class="border-t border-slate-200 pt-4 flex justify-between">
                                <span class="font-semibold text-slate-900">Total</span>
                                <span class="text-2xl font-bold text-primary">NGN25,00.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Proof -->
<!-- <section class="py-12 border-y border-slate-200">
    <div class="container-max">
        <p class="text-center text-sm font-semibold text-slate-600 mb-8">
            Trusted by thousands of freelancers and small businesses
        </p>
        <div class="flex flex-wrap justify-center items-center gap-8">
            @foreach(['Freelancers', 'Designers', 'Developers', 'Creators', 'Founders'] as $badge)
                <div class="px-4 py-2 rounded-full bg-slate-100 text-slate-700 text-sm font-medium">
                    {{ $badge }}
                </div>
            @endforeach
        </div>
    </div>
</section> -->

<!-- Features Section -->
<!-- <section id="features" class="section-spacing">
    <div class="container-max">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-4">
                Everything you need to invoice like a pro
            </h2>
            <p class="text-xl text-slate-600">
                Powerful features designed for freelancers and small business owners
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('components.feature-card', [
                'title' => 'Instant Invoice Creation',
                'description' => 'Create professional invoices in seconds, not hours. Simple, intuitive interface.',
                'icon' => '<svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>'
            ])

            @include('components.feature-card', [
                'title' => 'One-Click Sending',
                'description' => 'Send invoices directly to clients via email with a single click.',
                'icon' => '<svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12a6 6 0 100-12 6 6 0 000 12z" /></svg>'
            ])

            @include('components.feature-card', [
                'title' => 'Payment Tracking',
                'description' => 'Track invoice status in real-time. Know exactly what\'s paid and what\'s pending.',
                'icon' => '<svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.518l2.74-1.22m0 0l-5.94 7.08m5.94-7.08l1.088-1.088a2.25 2.25 0 00-3.182-3.182l-1.087 1.087m0 0l-45 45" /></svg>'
            ])

            @include('components.feature-card', [
                'title' => 'Online Payments',
                'description' => 'Accept payments directly through invoices. Get paid faster, automatically.',
                'icon' => '<svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008zm4.5-9h.008v.008H5.75v-.008zm0 2.25h.008v.008H5.75v-.008zm0 2.25h.008v.008H5.75v-.008zm0 2.25h.008v.008H5.75v-.008zm4.5-9h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008zm4.5-9h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008z" /></svg>'
            ])

            @include('components.feature-card', [
                'title' => 'Professional Templates',
                'description' => 'Beautiful, customizable invoice templates that reflect your brand.',
                'icon' => '<svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.566.034-1.08.16-1.539.34m-5.403 0v.118m0 0c-.566.034-1.076.16-1.539.34C3.653 4.22 3 5.25 3 6.108V19.5a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 19.5V6.108c0-.857-.653-1.889-1.432-2.25m-9.136 0c-.566.034-1.08.16-1.539.34m0 0a3 3 0 00-1.068-1.099c-.582-.325-1.243-.518-1.948-.518H6.75c-.563 0-1.08.16-1.539.34" /></svg>'
            ])

            @include('components.feature-card', [
                'title' => 'Client Management',
                'description' => 'Organize all your clients in one place. Save time on repetitive data entry.',
                'icon' => '<svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 001.591-.079 8.988 8.988 0 01-7.23 4.568 8.969 8.969 0 01-6.191-2.206A8.969 8.969 0 0121 12a8.97 8.97 0 01-7.23 8.128m0 0a9.364 9.364 0 01-1.584-.063 8.97 8.97 0 01-1.588-.15 8.987 8.987 0 00-7.231 4.569A8.969 8.969 0 0121 12Z" /></svg>'
            ])
        </div>
    </div>
</section> -->

<!-- How It Works -->
<!-- <section class="section-spacing bg-slate-50">
    <div class="container-max">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-4">
                Three simple steps
            </h2>
            <p class="text-xl text-slate-600">
                From invoice to payment in minutes
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['01', 'Create', 'Add your details, client info, and line items. Takes less than a minute.'],
                ['02', 'Send', 'Click send and your professional invoice lands in their inbox instantly.'],
                ['03', 'Get Paid', 'Track payments, send reminders, and get notified when they pay.']
            ] as $step)
                <div class="relative">
                    <div class="text-6xl font-bold text-primary/10 mb-4">{{ $step[0] }}</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ $step[1] }}</h3>
                    <p class="text-slate-600 text-lg">{{ $step[2] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section> -->

<!-- Pricing Section -->
<!-- <section id="pricing" class="section-spacing">
    <div class="container-max">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-4">
                Simple, transparent pricing
            </h2>
            <p class="text-xl text-slate-600">
                Start free. Upgrade as you grow.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl mx-auto">
            @include('components.pricing-card', [
                'name' => 'Free',
                'description' => 'Perfect for getting started',
                'price' => '0',
                'featured' => false,
                'features' => ['Up to 10 invoices/month', 'Basic templates', 'Email support', 'PDF export'],
                'cta' => 'Get Started'
            ])

            @include('components.pricing-card', [
                'name' => 'Pro',
                'description' => 'For growing businesses',
                'price' => '29',
                'featured' => true,
                'features' => ['Unlimited invoices', 'Premium templates', 'Payment tracking', 'Online payments', 'Priority support'],
                'cta' => 'Start Free Trial'
            ])
        </div>
    </div>
</section> -->

<!-- Testimonials -->
<!-- <section class="section-spacing bg-slate-50">
    <div class="container-max">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-4">
                Loved by freelancers
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['SC', 'Sarah Chen', 'Freelance Designer', 'Digital Horizon cut my invoicing time in half. I can focus on design instead of admin work.'],
                ['MR', 'Marcus Rodriguez', 'Solo Founder', 'The payment tracking feature alone is worth it. No more chasing clients for payment status.'],
                ['ET', 'Emma Thompson', 'Creative Director', 'Professional, simple, and actually enjoyable to use. Highly recommended for freelancers.']
            ] as $testimonial)
                <div class="card">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                            <span class="font-semibold text-primary">{{ $testimonial[0] }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">{{ $testimonial[1] }}</p>
                            <p class="text-sm text-slate-600">{{ $testimonial[2] }}</p>
                        </div>
                    </div>
                    <p class="text-slate-700 italic">"{{ $testimonial[3] }}"</p>
                </div>
            @endforeach
        </div>
    </div>
</section> -->

<!-- FAQ Section -->
<!-- <section id="faq" class="section-spacing">
    <div class="max-w-3xl mx-auto container-max">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-4">
                Frequently asked questions
            </h2>
        </div>

        <div class="space-y-4">
            @include('components.faq-item', [
                'question' => 'How long does it take to create an invoice?',
                'answer' => 'Most users create their first invoice in under 30 seconds. Our interface is designed for speed and simplicity.'
            ])

            @include('components.faq-item', [
                'question' => 'Can I customize invoice templates?',
                'answer' => 'Yes! You can customize colors, fonts, and add your logo. All templates are fully branded to your business.'
            ])

            @include('components.faq-item', [
                'question' => 'Do you offer payment processing?',
                'answer' => 'Yes, we integrate with Stripe and PayPal so clients can pay directly through the invoice.'
            ])

            @include('components.faq-item', [
                'question' => 'Is there a free plan?',
                'answer' => 'Absolutely. Start free with up to 10 invoices per month. Upgrade anytime as you grow.'
            ])

            @include('components.faq-item', [
                'question' => 'Can I export invoices as PDF?',
                'answer' => 'Yes, every invoice can be downloaded as PDF or sent directly via email.'
            ])
        </div>
    </div>
</section> -->

<!-- Final CTA -->
<!-- <section class="section-spacing bg-gradient-to-r from-primary/5 to-primary/10">
    <div class="max-w-4xl mx-auto container-max text-center">
        <h2 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-6">
            Ready to get paid faster?
        </h2>
        <p class="text-xl text-slate-600 mb-8">
            Join thousands of freelancers who've simplified their invoicing
        </p>
        <a href="/register" class="btn-primary inline-block">Start Free Today</a>
    </div>
</section> -->
@endsection