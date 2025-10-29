<?php

namespace App\Http\Controllers\HMS;

use App\Http\Controllers\Controller;
use App\Models\HMS\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Retrieve all departments.
     */
    public function retrieveDepartments()
    {
        $departments = Department::all();

        return response()->json([
            'status' => true,
            'message' => 'Departments retrieved successfully.',
            'departments' => $departments,
        ], 200);
    }

    /**
     * Add a new department.
     */
    public function addNewDepartment(Request $request)
    {

        $validated = $request->validate([
            'department' => 'required|string|max:100|unique:departments,department',
            'description' => 'nullable|string|max:255',
            'hospital_id' => 'required|exists:hospital_infos,id',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            // ✅ Step 2: Create a new department
            $department = Department::create([
                'department' => $validated['department'],
                'description' => $validated['description'] ?? null,
                'hospital_id' => $validated['hospital_id'],
                'is_active' => $validated['is_active'] ?? true,
            ]);

            // ✅ Step 3: Return success response
            return response()->json([
                'status' => true,
                'message' => 'Department added successfully.',
                'department' => $department,
            ], 201);
        } catch (\Exception $e) {
            // ✅ Step 4: Handle unexpected errors
            return response()->json([
                'status' => false,
                'message' => 'Failed to add department.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing department.
     */
    public function updateDepartment(Request $request, $id)
    {
        $validated = $request->validate([
            'department' => 'required|string|max:100|unique:departments,department,' . $id,
            'description' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            $department = Department::findOrFail($id);
            $department->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Department updated successfully.',
                'department' => $department,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update department.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a department.
     */
    public function deleteDepartment($id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->delete();

            return response()->json([
                'status' => true,
                'message' => 'Department deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete department.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
