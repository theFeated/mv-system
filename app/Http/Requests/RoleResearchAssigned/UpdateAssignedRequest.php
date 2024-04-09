<?php

namespace App\Http\Requests\RoleResearchAssigned;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleResearchAssigned; 

class UpdateAssignedRequest extends FormRequest
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
            'roleID' => 'required',
            'researcherID' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $assignedID = $this->route('assignedID');
        $researchID = $this->route('researchID');

        $this->merge([
            'roleresearchassigned' => RoleResearchAssigned::where('assignedID', $assignedID)
                ->where('researchID', $researchID)
                ->firstOrFail(),
        ]);
    }
}
