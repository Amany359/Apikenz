<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Helpers\Helpers;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return Helpers::jsonResponse(true, $employees, 'Employees retrieved successfully');
    }

    public function store(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'job_title' => 'required|string|max:255',
        ]);

        // إنشاء السجل الجديد
        $employee = Employee::create($validated);

        // إرجاع استجابة JSON باستخدام الـ Helper
        return Helpers::jsonResponse(true, $employee, 'Employee created successfully');
    }

    public function show($id)
    {
        // البحث عن الموظف باستخدام الـ id
        $employee = Employee::findOrFail($id);

        // إرجاع استجابة JSON
        return Helpers::jsonResponse(true, $employee, 'Employee details retrieved successfully');
    }

    public function update(Request $request, $id)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
        ]);

        // البحث عن الموظف وتحديثه
        $employee = Employee::findOrFail($id);
        $employee->update($validated);

        // إرجاع استجابة JSON
        return Helpers::jsonResponse(true, $employee, 'Employee updated successfully');
    }

    public function destroy($id)
    {
        // البحث عن الموظف وحذفه
        $employee = Employee::findOrFail($id);
        $employee->delete();

        // إرجاع استجابة JSON
        return Helpers::jsonResponse(true, null, 'Employee deleted successfully');
    }
}
