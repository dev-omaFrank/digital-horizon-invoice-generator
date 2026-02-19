<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //confirm validation with auth
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'businessName' => [
                'required',
                'string',
                'max:255',
            ],

            'businessLogo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120', // 5MB
            ],

            'businessAddress' => [
                'required',
                'string',
                'max:500',
            ],

            'businessEmail' => [
                'required',
                'email:rfc',
                'max:255',
                'unique:businesses,business_email,NULL,id,user_id,' . auth()->id(),
            ],

            'businessPhoneNo' => [
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
            'businessName.required' => 'Business name is required.',
            'businessEmail.email' => 'Please enter a valid email address.',
            'businessPhoneNo.regex' => 'Phone number can only contain numbers and + ( ) - characters.',
            'businessAddress.required' => 'Business address is required.',
            'businessEmail.unique' => 'This email is already registered with another business.'
        ];
    }
}
