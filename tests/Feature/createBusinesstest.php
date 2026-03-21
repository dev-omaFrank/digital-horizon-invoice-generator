<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBusinessTest extends TestCase
{
    use RefreshDatabase;

    public function test_business_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/business/create-business-profile', [
            'businessName' => 'Test Biz',
            'businessEmail' => 'test@example.com',
            'businessPhoneNo' => '1234567890',
            'businessAddress' => 'Test Address',
            'currency' => 'NGN',
            'bank_name' => 'Test Bank',
            'account_name' => 'John Doe',
            'account_number' => '12345678',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('businesses', [
            'business_name' => 'Test Biz',
        ]);
    }

    public function test_validation_fails_when_fields_are_missing()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/business/create-business-profile', []);

        $response->assertSessionHasErrors([
            'businessName',
            'businessEmail',
        ]);
    }

    public function test_old_input_is_retained()
    {
        $user = User::factory()->create();

        $response = $this->from('/form-page')
            ->actingAs($user)
            ->post('/business/create-business-profile', [
                'businessName' => '',
                'businessEmail' => 'test@example.com',
            ]);

        $response->assertSessionHasInput('businessEmail');
    }
}

?>