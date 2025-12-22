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
            'doctor' => [
                'id' => $this->id,
                'name' => $this->doctorDetails?->name,
                'specialization' => $this->specialization,
                'qualification' => $this->qualification,
                'experienceYears' => $this->experience_years ?? 0,
            ],

            'schedules' => $this->schedules->map(function ($schedule) {
                return [
                    'day' => ucfirst($schedule->day),
                    'time' => [
                        'from' => substr($schedule->from_time, 0, 5),
                        'to' => substr($schedule->to_time, 0, 5),
                    ],
                    'isActive' => (bool) $schedule->status,
                ];
            })->values(),
        ];
    }
}
