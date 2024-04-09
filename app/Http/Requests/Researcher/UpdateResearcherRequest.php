<?php

namespace App\Http\Requests\Researcher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateResearcherRequest extends FormRequest
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
             'researcherID' => 'required|unique:researcher,researcherID,' . $this->route('researcherID') . ',researcherID',
             'collegeID' => 'required|exists:college,collegeID',
             'researcherName' => 'required|string',
             'email' => 'required|email|string',
             'contactNum' => 'required|string',
         ];
     }
}
