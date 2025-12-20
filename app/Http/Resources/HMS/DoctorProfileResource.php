<?php

namespace App\Http\Resources\HMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'gender' => $this->gender,
            'address' => $this->address,
            'description' => $this->description,
            'specialization' => $this->specialization,
            'qualification' => $this->qualification,
            'experienceYears' => $this->experience_years,
            'appointmentFees' => $this->appointment_fees,
            'isActive' => (bool) $this->is_active,

            'doctor' => [
                'id' => $this->doctorDetails?->id,
                'name' => $this->doctorDetails?->name,
                'email' => $this->doctorDetails?->email,
                'username' => $this->doctorDetails?->username,
            ],

            'department' => [
                'id' => $this->department?->id,
                'name' => $this->department?->department_name,
                'description' => $this->department?->description,
            ],

            'hospitalId' => $this->hospital_id,
            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),
        ];
    }
}
