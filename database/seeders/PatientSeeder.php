<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure hospital and user records exist before running this seeder
        $hospital = DB::table('hospital_infos')->first();
        $user = DB::table('users')->first();

        if (!$hospital || !$user) {
            echo "⚠️  Please seed 'users' and 'hospital_infos' tables first.\n";
            return;
        }

        $patients = [
            [
                'patient_name' => 'John Doe',
                'age' => 28,
                'sex' => 'male',
                'date_of_birth' => '1997-03-12',
                'blood_group' => 'A+',
                'is_admitted' => true,
                'phone_number' => '01710000001',
                'email' => 'john.doe@example.com',
                'address' => 'Dhaka, Bangladesh',
                'emergency_contact_phone' => '01710000002',
                'keep_records' => false,
                'allergies' => 'Peanuts',
                'chronic_diseases' => 'Asthma',
                'hospital_id' => $hospital->id,
                'added_by_id' => $user->id,
                'is_active' => true,
                'generated_patient_id' => 'PAT-' . strtoupper(Str::random(6)),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_name' => 'Maria Rahman',
                'age' => 35,
                'sex' => 'female',
                'date_of_birth' => '1990-05-20',
                'blood_group' => 'O+',
                'is_admitted' => false,
                'phone_number' => '01710000003',
                'email' => 'maria.rahman@example.com',
                'address' => 'Chittagong, Bangladesh',
                'emergency_contact_phone' => '01710000004',
                'keep_records' => false,
                'allergies' => 'None',
                'chronic_diseases' => 'Hypertension',
                'hospital_id' => $hospital->id,
                'added_by_id' => $user->id,
                'is_active' => true,
                'generated_patient_id' => 'PAT-' . strtoupper(Str::random(6)),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ... (previous 8 patients remain the same)
        ];

        // Add 110 more patients
        for ($i = 11; $i <= 120; $i++) {
            $age = rand(18, 80);
            $year = date('Y') - $age;
            $month = rand(1, 12);
            $day = rand(1, 28);
            $dateOfBirth = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-" . str_pad($day, 2, '0', STR_PAD_LEFT);

            $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
            $sex = rand(0, 1) ? 'male' : 'female';
            $isAdmitted = rand(0, 1);
            $keepRecords = rand(0, 1);

            $allergiesOptions = ['None', 'Peanuts', 'Dust', 'Pollen', 'Penicillin', 'Shellfish', 'Seafood', 'Milk', 'Eggs', 'Soy'];
            $chronicDiseasesOptions = ['None', 'Asthma', 'Diabetes', 'Hypertension', 'Heart Disease', 'Migraine', 'Arthritis', 'High Cholesterol', 'Thyroid Disorder', 'COPD'];

            $patients[] = [
                'patient_name' => $this->generateBangladeshiName($sex),
                'age' => $age,
                'sex' => $sex,
                'date_of_birth' => $dateOfBirth,
                'blood_group' => $bloodGroups[array_rand($bloodGroups)],
                'is_admitted' => $isAdmitted,
                'phone_number' => '0171' . str_pad($i + 100000, 8, '0', STR_PAD_LEFT),
                'email' => 'patient' . $i . '@example.com',
                'address' => $this->generateBangladeshiAddress(),
                'emergency_contact_phone' => '0171' . str_pad($i + 100001, 8, '0', STR_PAD_LEFT),
                'keep_records' => $keepRecords,
                'allergies' => $allergiesOptions[array_rand($allergiesOptions)],
                'chronic_diseases' => $chronicDiseasesOptions[array_rand($chronicDiseasesOptions)],
                'hospital_id' => $hospital->id,
                'added_by_id' => $user->id,
                'is_active' => true,
                'generated_patient_id' => 'PAT-' . strtoupper(Str::random(6)),
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now(),
            ];
        }

        DB::table('patients')->insert($patients);
    }

    /**
     * Generate Bangladeshi name based on gender
     */
    private function generateBangladeshiName(string $sex): string
    {
        $maleFirstNames = ['Mohammad', 'Abdul', 'Rahim', 'Karim', 'Jamal', 'Kamal', 'Shahid', 'Rafiq', 'Salam', 'Nur', 'Alam', 'Hasan', 'Hossain', 'Islam', 'Uddin', 'Ahmed', 'Rahman', 'Ali', 'Mia', 'Molla'];
        $femaleFirstNames = ['Fatema', 'Ayesha', 'Khaleda', 'Hasina', 'Jahanara', 'Sabina', 'Nargis', 'Sharmin', 'Taslima', 'Nusrat', 'Shirin', 'Rehana', 'Farida', 'Shahana', 'Rokeya', 'Sultana', 'Jahan', 'Begum', 'Khatun', 'Akter'];

        $lastNames = ['Ahmed', 'Rahman', 'Chowdhury', 'Khan', 'Hossain', 'Islam', 'Mia', 'Ali', 'Sarkar', 'Molla', 'Uddin', 'Sikder', 'Talukder', 'Mondol', 'Sarker', 'Biswas', 'Das', 'Roy', 'Datta', 'Guha'];

        $firstName = $sex === 'male'
            ? $maleFirstNames[array_rand($maleFirstNames)]
            : $femaleFirstNames[array_rand($femaleFirstNames)];

        $lastName = $lastNames[array_rand($lastNames)];

        return $firstName . ' ' . $lastName;
    }

    /**
     * Generate Bangladeshi address
     */
    private function generateBangladeshiAddress(): string
    {
        $cities = ['Dhaka', 'Chittagong', 'Sylhet', 'Rajshahi', 'Khulna', 'Barishal', 'Rangpur', 'Comilla', 'Gazipur', 'Mymensingh', 'Narayanganj', 'Bogra', 'Jessore', 'Cox\'s Bazar', 'Dinajpur', 'Tangail', 'Pabna', 'Kushtia', 'Noakhali', 'Faridpur'];
        $areas = ['Mohammadpur', 'Dhanmondi', 'Uttara', 'Gulshan', 'Banani', 'Mirpur', 'Motijheel', 'Shantinagar', 'Malibagh', 'Rampura', 'Badda', 'Khilgaon', 'Lalbagh', 'Old Town', 'New Market', 'Agargaon', 'Kafrul', 'Cantonment'];

        $city = $cities[array_rand($cities)];
        $area = $areas[array_rand($areas)];
        $houseNo = rand(1, 200);
        $roadNo = rand(1, 50);

        return "House #$houseNo, Road #$roadNo, $area, $city, Bangladesh";
    }
}
