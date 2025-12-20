<?php

namespace App\Http\Resources\HMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorScheduleResource extends JsonResource
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
            'day' => ucfirst($this->day ?? ''),

            'time' => [
                'from' => $this->from_time
                    ? substr($this->from_time, 0, 5)
                    : null,

                'to' => $this->to_time
                    ? substr($this->to_time, 0, 5)
                    : null,
            ],

            'isActive' => (bool) $this->is_active,

            'doctor' => [
                'id' => $this->doctor?->id,
                'name' => $this->doctor?->doctorDetails?->name,
                'specialization' => $this->doctor?->specialization,
                'qualification' => $this->doctor?->qualification,
                'experienceYears' => $this->doctor?->experience_years ?? 0,
            ],

            'createdAt' => optional($this->created_at)->toISOString(),
            'updatedAt' => optional($this->updated_at)->toISOString(),
        ];
    }
}
