<?php

namespace App\Http\Requests\Research;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

class UpdateResearchRequest extends FormRequest
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
            'collegeID' => 'required|exists:college,id', 
            'researcherID' => 'required|exists:researcher,id',
            'agencyID' => 'nullable|exists:agency,id',
            'status' => 'required|string', 
            'researchTitle' => 'required|string',
            'researchType' => 'required|string', 
            'startDate' => 'required|date', 
            'endDate' => 'nullable|date|after_or_equal:startDate',
            'link_1' => 'nullable|string',
            'link_2' => 'nullable|string', 
            'link_3' => 'nullable|string', 
            'extension' => 'nullable|string', 
            'internalFund' => 'nullable|boolean', 
        ];
    }
}
