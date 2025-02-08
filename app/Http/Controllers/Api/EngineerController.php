<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Engineer;
use Illuminate\Http\Request;
use App\Helpers\Helpers;

class EngineerController extends Controller
{
    // إظهار جميع المهندسين
    public function index()
    {
        $engineers = Engineer::all();
        return Helpers::jsonResponse(true, $engineers, 'Engineers retrieved successfully');
    }

    // إضافة مهندس جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // تأكد من أن ID المستخدم موجود في جدول المستخدمين
            'engineering_field' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
        ]);

        $engineer = Engineer::create($validated);

        return Helpers::jsonResponse(true, $engineer, 'Engineer created successfully', 201);
    }

    // تحديث مهندس
    public function update(Request $request, $id)
    {
        $engineer = Engineer::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'engineering_field' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
        ]);

        $engineer->update($validated);

        return Helpers::jsonResponse(true, $engineer, 'Engineer updated successfully');
    }

    // حذف مهندس
    public function destroy($id)
    {
        $engineer = Engineer::findOrFail($id);
        $engineer->delete();

        return Helpers::jsonResponse(true, null, 'Engineer deleted successfully');
    }
}
