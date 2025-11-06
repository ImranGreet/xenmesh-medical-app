<?php 
namespace App\Repositories;

use App\Models\HMS\Appointment;
use Illuminate\Http\Request;

class AppoinmentRepository {

    public function retrieveAppoinment(Request $request){
         $appoinment = Appointment::paginate($request->get('per_page',20));
         return $appoinment;
    }

    public function retrieveAppoinmentsByDoctor($doctor_id){

        $appoinments = Appointment::with(['doctor','patient','addedBy'])->where("appointed_doctor_id", $doctor_id)->get();
        return $appoinments;
    }

    public function filterAppoinments(Request $request){
         

            $query = Appointment::query()->with(['patient', 'doctor.doctorDetails', 'addedBy']);


            if ($request->has('doctor_id')) {
                $query->where('appointed_doctor_id', $request->doctor_id);
            }

            if ($request->has('status')) {
                $statuses = explode(',', $request->status);
                $query->whereIn('status', $statuses);
            }

            if ($request->has('patient_id')) {
                $query->where('patient_id', $request->patient_id);
            }

            if ($request->has('room_number')) {
                $query->where('room_number', $request->room_number);
            }

            if ($request->has('start_date') && $request->has('end_date')) {
                $query->whereBetween('appointment_date', [$request->start_date, $request->end_date]);
            } 
            if ($request->has('date')) {
                $query->where('appointment_date', $request->date);
            }

            if($request->has('creatorId')){
                $query->where('added_by_id',$request->creatorId);
            }

            // Optional: order by date/time
            $appointments = $query->orderBy('appointment_date', 'asc')
                ->orderBy('appointment_time', 'asc')
                ->get();

            return $appointments;
        
    }

}