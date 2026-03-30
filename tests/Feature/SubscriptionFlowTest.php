<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SubscriptionFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_subscribe_and_make_payment()
    {
        // Step 1: Create a Plan
        $plan = Plan::create([
            'name' => 'Pro Plan',
            'amount' => 500000,
            'currency' => 'NGN',
            'interval' => 'monthly',
            'paystack_plan_code' => 'PLN_TEST_12345',
        ]);

        $this->assertDatabaseHas('plans', ['name' => 'Pro Plan']);

        // Step 2: Create a Customer
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('secret'),
            'paystack_customer_code' => 'CUS_TEST_12345',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);

        // Step 3: Create a Subscription
        $subscription = Subscription::create([
            'user_id' => $user->id,  // matches migration column
            'plan_id' => $plan->id,
            'status' => 'active',
            'start_date' => Carbon::now(),
            'next_billing_date' => Carbon::now()->addMonth(),
            'paystack_subscription_code' => 'SUB_TEST_12345',
            'paystack_email_token' => 'EMAIL_TOKEN_123',
        ]);

        $this->assertDatabaseHas('subscriptions', [
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'status' => 'active',
        ]);

        // Step 4: Simulate a Payment
        $payment = Payment::create([
            'user_id' => $user->id,  // matches migration column
            'subscription_id' => $subscription->id,
            'amount' => $plan->amount,
            'currency' => 'NGN',
            'status' => 'success',
            'paystack_reference' => 'REF_TEST_12345',
            'paystack_transaction_id' => 'TRX_TEST_12345',
            'paystack_event' => 'charge.success',
            'paid_at' => Carbon::now(),
        ]);

        $this->assertDatabaseHas('payments', [
            'subscription_id' => $subscription->id,
            'status' => 'success',
        ]);

        $subscription->refresh();

        // Step 5: Check Relationships
        $this->assertEquals($subscription->user->id, $user->id);
        $this->assertEquals($subscription->plan->id, $plan->id);
        $this->assertEquals($subscription->payment->first()->id, $payment->id);
    }
}