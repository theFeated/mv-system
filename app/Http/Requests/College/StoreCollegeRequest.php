<?php

namespace App\Http\Requests\College;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\College;

class StoreCollegeRequest extends FormRequest
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
            'collegeName' => 'required|string',
            'codePrefix' => 'required|string',
            'collegeDean' => 'required|string',
        ];
    }

    /**
     * Store the college data after validation.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCollege(): \Illuminate\Http\RedirectResponse
    {
        try {
            // Calculate the total number of colleges
            $totalColleges = College::count();
            
            // Increment the total number and format it as a three-digit string
            $collegeNumber = str_pad($totalColleges + 1, 3, '0', STR_PAD_LEFT);
            
            // Generate the new collegeID
            $newCollegeID = $this->input('codePrefix') . $collegeNumber;

            // Create the college
            College::create([
                'collegeID' => $newCollegeID,
                'collegeName' => $this->input('collegeName'),
                'collegeDean' => $this->input('collegeDean'),
            ]);

            return redirect()->route('college')->with('success', 'College added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add college: ' . $e->getMessage());
        }
    }
}
