<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Employee::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:employees,email',
            'address' => 'required|string|max:255',
        ]);
        $employee = Employee::create($request->all());
        return response()->json($employee,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        if(!$employee){
            return response()->json(['message' => 'Empleado no encontrado'],404);
        }
        return response()->json($employee,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|string|max:20',
            'email' => 'sometimes|email|unique:employees,email,' . $id,
            'address' => 'sometimes|string|max:255',
        ]);
        $employee->update($request->all());
        return response()->json($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        $employee->delete();
        return response()->json(['message' => 'Empleado eliminado'], 200);
    }
}
