<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'clientName' => [
                'required',
                'string',
                'max:255',
            ],

            'clientAddress' => [
                'required',
                'string',
                'max:500',
            ],

            'clientEmail' => [
                'required',
                'email:rfc',
                'max:255',
                'unique:client_profile,client_email,NULL,id,user_id,' . auth()->id(),
            ],

            'clientPhoneNo' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s()]+$/',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'clientName.required' => 'client name is required.',
            'clientEmail.email' => 'Please enter a valid email address.',
            'clientPhoneNo.regex' => 'Phone number can only contain numbers and + ( ) - characters.',
            'clientAddress.required' => 'client address is required.',
            'clients_profile_email.unique' => 'This email is already registered with another client.'
        ];
    }
}
