<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class DataUserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with(['roles', 'permissions'])->where('id', '!=', 1)->get();

        $sortedData = $data->sort(function ($a, $b) {
            $aPermissions = $a->permissions->pluck('name')->filter(function ($permission) {
                return in_array($permission, ['Active', 'Inactive']);
            })->sort()->values()->implode(',');

            $bPermissions = $b->permissions->pluck('name')->filter(function ($permission) {
                return in_array($permission, ['Active', 'Inactive']);
            })->sort()->values()->implode(',');

            if ($aPermissions < $bPermissions) return -1;
            if ($aPermissions > $bPermissions) return 1;

            $aRoles = $a->roles->pluck('name')->sort()->values()->implode(',');
            $bRoles = $b->roles->pluck('name')->sort()->values()->implode(',');

            if ($aRoles < $bRoles) return -1;
            if ($aRoles > $bRoles) return 1;

            return 0;
        });

        $sortedData = $sortedData->values();

        return view('pages.user-management.index', [
            'title' => 'Data User Management',
            'menu' => 'Data User Management',
            'data' => $sortedData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = User::with(['roles', 'permissions'])->findOrFail($id);

            $currentPermissions = $data->getPermissionNames()->toArray();

            Log::info('Current Permissions: ', $currentPermissions);

            if (in_array('Active', $currentPermissions)) {
                $newPermissions = ['Inactive'];
            } else {
                $newPermissions = ['Active'];
            }

            $result = $data->syncPermissions($newPermissions);

            Log::info('Sync Result: ', $result);

            // Clear specific cache if needed
            Cache::forget('permissions_for_user_' . $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Data account successfully updated status.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating permissions: ', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update data account status.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(User $user)
    {
        $permissionName = 'Active';
        $status = '';

        if ($user->hasPermissionTo($permissionName)) {
            $user->syncPermissions('Inactive');
            $status = 'Inactive';
        } else {
            $user->syncPermissions([$permissionName]);
            $status = 'Active';
        }

        return response()->json([
            'status' => $status,
        ]);
    }

    public function updatePassword(Request $request, string $id)
    {
        try {
            $request->validate([
                'password_new' => 'nullable',
            ], $this->messageValidation());
            $user = User::findOrFail($id);

            $user->update([
                'password' => Hash::make('Banyuwangi@2024'),
            ]);

            return response()->json(['message' => 'Password updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while changing the password.'], 500);
        }
    }

    private function messageValidation()
    {
        $message = [
            'required' => ':attribute is required.',
            'string' => ':attribute must be a string.',
            'regex' => 'The format of :attribute is invalid.',
            'unique' => ':attribute has already been taken.',
            'min' => ':attribute must be at least :min characters.',
            'max' => ':attribute may not be greater than :max characters.',
            'exists' => 'The selected :attribute is invalid.',
            'password_new.required' => 'New Password is required.',
            'password_new.string' => 'New Password must be a string.',
            'password_new.min' => 'New Password must be at least 8 characters.',
            'password_new.regex' => 'New Password must contain at least one letter, one number, and one symbol.',
            'confirm_password.required' => 'Confirm Password is required.',
            'confirm_password.same' => 'Confirm Password must match the New Password.',
        ];

        return $message;
    }

    private function attributeValidation()
    {
        $customAttributes = [
            'name' => 'Name',
            'role' => 'Role',
            'email' => 'Email',
        ];

        return $customAttributes;
    }
}
