<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    // 1. Display all staff members
    public function index()
    {
        return response()->json(Staff::all());
    }

    // 2. Create a new staff member
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:staff,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'phone_number' => 'required|string|unique:staff,phone_number',
        ]);

        $staff = Staff::create($validated);

        return response()->json($staff, 201);
    }

    // 3. Display one staff member
    public function show(string $id)
    {
        return response()->json(Staff::findOrFail($id));
    }

    // 4. Update a staff member
    public function update(Request $request, string $id)
    {
        $staff = Staff::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('staff', 'email')->ignore($staff->id),
            ],
            'password' => 'sometimes|required|string|min:8',
            'role' => 'sometimes|required|string',
            'phone_number' => [
                'sometimes',
                'required',
                'string',
                Rule::unique('staff', 'phone_number')->ignore($staff->id),
            ],
        ]);

        $staff->update($validated);

        return response()->json($staff);
    }

    // 5. Delete a staff member
    public function destroy(string $id)
    {
        Staff::findOrFail($id)->delete();

        return response()->json(
            "Staff member deleted successfully."
        );
    }
}
