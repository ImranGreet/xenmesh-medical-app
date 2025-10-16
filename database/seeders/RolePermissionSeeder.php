<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions first
        $this->createPermissions();

        // Create roles and assign permissions
        $this->createRolesWithPermissions();

        $this->command->info('✅ Roles and Permissions seeded successfully!');
    }

    /**
     * Create all permissions
     */
    private function createPermissions(): void
    {
        $permissions = [
            // User Management
            'user.create',
            'user.read',
            'user.update',
            'user.delete',
            'user.export',

            // Role Management
            'role.create',
            'role.read',
            'role.update',
            'role.delete',
            'role.assign',

            // Permission Management
            'permission.create',
            'permission.read',
            'permission.update',
            'permission.delete',
            'permission.assign',

            // Hospital Management
            'hospital.create',
            'hospital.read',
            'hospital.update',
            'hospital.delete',
            'hospital.export',

            // Patient Management
            'patient.create',
            'patient.read',
            'patient.update',
            'patient.delete',
            'patient.export',

            // Doctor Management
            'doctor.create',
            'doctor.read',
            'doctor.update',
            'doctor.delete',

            // Receptionist Management
            'receptionist.create',
            'receptionist.read',
            'receptionist.update',
            'receptionist.delete',

            // Nurse Management
            'nurse.create',
            'nurse.read',
            'nurse.update',
            'nurse.delete',

            // Appointment Management
            'appointment.create',
            'appointment.read',
            'appointment.update',
            'appointment.delete',
            'appointment.cancel',

            // Medical Records
            'medical_record.create',
            'medical_record.read',
            'medical_record.update',
            'medical_record.delete',

            // Billing & Payments
            'billing.create',
            'billing.read',
            'billing.update',
            'billing.delete',
            'payment.process',

            // Pharmacy
            'pharmacy.manage',
            'medicine.dispense',
            'inventory.manage',

            // Laboratory
            'lab_test.create',
            'lab_test.read',
            'lab_test.update',
            'lab_test.delete',

            // Reports
            'report.generate',
            'report.read',
            'report.export',

            // Settings
            'settings.read',
            'settings.update',

            // Dashboard
            'dashboard.access',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $this->command->info('✅ Created ' . count($permissions) . ' permissions');
    }

    /**
     * Create roles and assign permissions
     */
    private function createRolesWithPermissions(): void
    {
        $roles = [
            'Super Admin' => Permission::all()->pluck('name')->toArray(), // All permissions

            'Admin' => [
                'user.read',
                'user.update',
                'role.read',
                'permission.read',
                'hospital.create',
                'hospital.read',
                'hospital.update',
                'hospital.delete',
                'patient.read',
                'patient.update',
                'patient.export',
                'doctor.create',
                'doctor.read',
                'doctor.update',
                'doctor.delete',
                'receptionist.create',
                'receptionist.read',
                'receptionist.update',
                'receptionist.delete',
                'nurse.create',
                'nurse.read',
                'nurse.update',
                'nurse.delete',
                'appointment.read',
                'appointment.update',
                'medical_record.read',
                'medical_record.update',
                'billing.read',
                'billing.update',
                'payment.process',
                'pharmacy.manage',
                'inventory.manage',
                'lab_test.read',
                'lab_test.update',
                'report.generate',
                'report.read',
                'report.export',
                'settings.read',
                'settings.update',
                'dashboard.access',
            ],

            'Doctor' => [
                'patient.read',
                'appointment.read',
                'appointment.update',
                'medical_record.create',
                'medical_record.read',
                'medical_record.update',
                'lab_test.create',
                'lab_test.read',
                'lab_test.update',
                'dashboard.access',
            ],

            'Receptionist' => [
                'patient.create',
                'patient.read',
                'patient.update',
                'appointment.create',
                'appointment.read',
                'appointment.update',
                'appointment.cancel',
                'billing.create',
                'billing.read',
                'dashboard.access',
            ],

            'Patient' => [
                'appointment.read',
                'medical_record.read',
                'billing.read',
                'dashboard.access',
            ],

            'Nurse' => [
                'patient.read',
                'appointment.read',
                'medical_record.read',
                'medical_record.update',
                'medicine.dispense',
                'dashboard.access',
            ],

            'Pharmacist' => [
                'pharmacy.manage',
                'medicine.dispense',
                'inventory.manage',
                'billing.read',
                'dashboard.access',
            ],

            'Lab Technician' => [
                'lab_test.create',
                'lab_test.read',
                'lab_test.update',
                'patient.read',
                'dashboard.access',
            ],

            'Accountant' => [
                'billing.create',
                'billing.read',
                'billing.update',
                'billing.delete',
                'payment.process',
                'report.generate',
                'report.read',
                'report.export',
                'dashboard.access',
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);

            $role->syncPermissions($permissions);

            $this->command->info("✅ Created role: {$roleName} with " . count($permissions) . " permissions");
        }

        $this->command->info('🎉 Successfully created ' . count($roles) . ' roles with assigned permissions');
    }
}
