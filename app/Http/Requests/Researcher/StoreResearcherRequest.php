<?php

namespace App\Http\Requests\Researcher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreResearcherRequest extends FormRequest
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
            'id' => 'required|unique:researcher,id',
            'collegeID' => 'required|exists:college,id',
            'researcherName' => 'required|string',
            'email' => 'required|email|string',
            'contactNum' => 'required|string',
        ];
    }
}
