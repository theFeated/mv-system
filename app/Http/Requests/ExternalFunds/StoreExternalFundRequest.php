<?php

namespace App\Http\Requests\ExternalFunds;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreExternalFundRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'researchID' => 'required',
            'agencyID' => 'required',
            'total_budget' => 'required',
            'budget_utilized' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value > request()->input('total_budget')) {
                        $fail('The budget utilized cannot be greater than the total budget.');
                    }
                },
            ],
            'purpose' => 'required',
        ];
    }
}
