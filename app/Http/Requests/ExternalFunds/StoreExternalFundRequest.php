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
            'exFundID' => 'required',
            'researchID' => 'required',
            'agencyID' => 'required',
            'contribution' => 'required',
            'purpose' => 'required',
        ];
    }
}
