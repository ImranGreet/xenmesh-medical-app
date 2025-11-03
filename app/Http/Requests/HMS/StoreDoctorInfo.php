<?php

namespace App\Http\Requests\HMS;

use App\Models\HMS\Doctor;
use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'doctor_id' => 'required|exists:users,id|unique:doctors,doctor_id',
            'department_id' => 'required|exists:departments,id',
            'specialization' => 'nullable|string|max:100',
            'qualification' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'gender' => 'required|string',
            'address' => 'nullable|string|max:255',

            'hospital_id' => 'required|exists:hospital_infos,id',
            'added_by_id' => 'required|exists:users,id',
            'is_active' => 'nullable|boolean',
        ];
    }

}
