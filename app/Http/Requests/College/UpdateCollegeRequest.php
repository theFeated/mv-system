<?php

namespace App\Http\Requests\College;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\College;
use Illuminate\Validation\Rule;

class UpdateCollegeRequest extends FormRequest
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
        $collegeID = $this->route('collegeID');
    
        return [
            'collegeName' => [
                'required',
                'string',
                Rule::unique('college')->ignore($collegeID, 'collegeID'),
            ],
            'collegeDean' => 'required|string',
        ];
    }
    
}
