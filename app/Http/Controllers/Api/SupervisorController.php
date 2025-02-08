<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use App\Helpers\Helpers;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    // إرجاع جميع المشرفين
    public function index()
    {
        $supervisors = Supervisor::with('user')->get(); // مع تحميل المستخدمين المرتبطين
        return Helpers::jsonResponse(true, $supervisors, 'Supervisors retrieved successfully');
    }

    // إنشاء مشرف جديد
    public function store(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // التأكد من وجود المستخدم
            'department' => 'nullable|string|max:255',
        ]);

        // إنشاء المشرف الجديد
        $supervisor = Supervisor::create($validated);

        // إرجاع استجابة JSON
        return Helpers::jsonResponse(true, $supervisor, 'Supervisor created successfully');
    }

    // إظهار تفاصيل مشرف معين
    public function show($id)
    {
        // البحث عن المشرف باستخدام الـ id
        $supervisor = Supervisor::with('user')->findOrFail($id);

        // إرجاع استجابة JSON
        return Helpers::jsonResponse(true, $supervisor, 'Supervisor details retrieved successfully');
    }

    // تحديث بيانات مشرف معين
    public function update(Request $request, $id)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'department' => 'nullable|string|max:255',
        ]);

        // البحث عن المشرف وتحديثه
        $supervisor = Supervisor::findOrFail($id);
        $supervisor->update($validated);

        // إرجاع استجابة JSON
        return Helpers::jsonResponse(true, $supervisor, 'Supervisor updated successfully');
    }

    // حذف مشرف معين
    public function destroy($id)
    {
        // البحث عن المشرف وحذفه
        $supervisor = Supervisor::findOrFail($id);
        $supervisor->delete();

        // إرجاع استجابة JSON
        return Helpers::jsonResponse(true, null, 'Supervisor deleted successfully');
    }
}
