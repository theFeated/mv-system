<?php

namespace App\Http\Requests\Research;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreResearchRequest extends FormRequest
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
            'researchID' => 'required|unique:research,researchID',
            'collegeID' => 'required|exists:college,collegeID', 
            'researcherID' => 'required|exists:researcher,researcherID',
            'agencyID' => 'nullable|exists:agency,agencyID',
            'status' => 'required|string', 
            'researchTitle' => 'required|string',
            'researchType' => 'required|string', 
            'year' => 'required|date_format:Y',
            'startDate' => 'required|date', 
            'endDate' => 'nullable|date|after_or_equal:startDate',
            'link_1' => 'nullable|url',
            'link_2' => 'nullable|url', 
            'link_3' => 'nullable|url', 
            'extension' => 'nullable|string', 
            'internalFund' => 'nullable|boolean', 
        ];
    }
    
}
