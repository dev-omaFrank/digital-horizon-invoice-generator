<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust this based on your auth logic
        return true;
    }

    public function rules(): array
    {
        $invoiceId = $this->route('invoice'); // for update scenarios

        return [
            // Ownership
            'business_id' => ['required', 'integer', 'exists:businesses,id'],

            // Client
            'client_id' => ['required', 'integer', 'exists:client_profile,id'],

            // Invoice identity
            'invoice_number' => [
                'required',
                'string',
                'max:255',
                // unique per business
                Rule::unique('invoices')
                    ->where(function ($query) {
                        return $query->where('business_id', $this->business_id);
                    })
                    ->ignore($invoiceId),
            ],

            // Dates
            'issue_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:issue_date'],

            // Status
            'status' => ['required', Rule::in(['draft','sent','paid','partial','overdue','cancelled'])],

            // Monetary fields
            'subtotal' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'tax' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'discount' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'total' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],

            // Optional currency
            'currency' => ['nullable', 'string', 'size:3'],

            // Notes
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'invoice_number.unique' => 'This invoice number already exists for the selected business.',
            'due_date.after_or_equal' => 'The due date must be after or equal to the issue date.',
        ];
    }
}
