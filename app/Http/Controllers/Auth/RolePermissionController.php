<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function addNewRole(Request $request)
    {
        try {
            $request->validate([
                'role_name' => 'required|string|max:255|unique:roles,name',
            ]);

            $role = Role::create(['name' => $request->role_name]);

            return response()->json([
                'message' => 'Role created successfully',
                'role' => $role,
            ], 201); // 201 status for created

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database error occurred',
                'error' => 'Role creation failed due to database constraint',
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create role',
                'error' => 'An unexpected error occurred',
            ], 500);
        }
    }


    public function addNewPermission(Request $request)
    {
        try {
            $request->validate([
                'permission_name' => 'required|string|max:255|unique:permissions,name',
            ]);

            $permission = Permission::create([
                'name' => $request->permission_name,
                'guard_name' => 'web' // or your specific guard
            ]);

            return response()->json([
                'message' => 'Permission created successfully',
                'permission' => $permission,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1] ?? null;

            if ($errorCode == 1062) {
                return response()->json([
                    'message' => 'Permission already exists',
                    'error' => 'A permission with this name already exists',
                ], 409);
            }

            return response()->json([
                'message' => 'Database error occurred',
                'error' => 'Permission creation failed due to database constraint',
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create permission',
                'error' => 'An unexpected error occurred',
            ], 500);
        }
    }

    public function editPermission(Request $request, $id)
    {
        try {
            $request->validate([
                'permission_name' => 'required|string|max:255|unique:permissions,name,' . $id,
                'guard_name' => 'sometimes|string|in:web,api',
                'description' => 'nullable|string|max:500',
            ]);

            $permission = Permission::findById($id);

            if (!$permission) {
                return response()->json([
                    'success' => false,
                    'message' => 'Permission not found',
                ], 404);
            }

            // Update permission fields
            $permission->name = $request->permission_name;

            if ($request->has('guard_name')) {
                $permission->guard_name = $request->guard_name;
            }

            if ($request->has('description')) {
                $permission->description = $request->description;
            }

            $permission->save();

            return response()->json([
                'success' => true,
                'message' => 'Permission updated successfully',
                'data' => [
                    'permission' => $permission
                ]
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database error occurred',
                'error' => 'Permission update failed',
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update permission',
                'error' => 'An unexpected error occurred',
            ], 500);
        }
    }

    public function removeRole(Role $role)
    {
        try {
            if ($role->users()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete role with assigned users',
                ], 422);
            }

            $role->delete();

            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete role',
            ], 500);
        }
    }

    public function removePermission($id)
    {
        try {
            $permission = Permission::findById($id);

            if (!$permission) {
                return response()->json([
                    'success' => false,
                    'message' => 'Permission not found',
                ], 404);
            }
            $permission->roles()->detach();
            $permission->delete();

            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete permission',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    

public function getAllRoles()
{
    try {
        $allPermissions = Permission::select('id', 'name')->get();

        $roles = Role::with('permissions')->get()->map(function ($role) use ($allPermissions) {

            $rolePermissionIds = $role->permissions->pluck('id');

            $permissions = $allPermissions->map(function ($permission) use ($rolePermissionIds) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'assigned' => $rolePermissionIds->contains($permission->id),
                ];
            });

            return [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $permissions,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'roles' => $roles
            ]
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch roles'
        ], 500);
    }
}


    public function getAllPermissions()
    {
        try {
            $permissions = Permission::all();

            return response()->json([
                'success' => true,
                'data' => ['permissions' => $permissions]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch permissions'
            ], 500);
        }
    }
}
