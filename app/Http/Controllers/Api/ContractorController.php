<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Helpers\Helpers;

class CountryController extends Controller
{
    // إظهار جميع الدول
    public function index()
    {
        $countries = Country::all();
        return Helpers::jsonResponse(true, $countries, 'Countries retrieved successfully');
    }

    // إضافة دولة جديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capital' => 'nullable|string|max:255',
        ]);

        $country = Country::create($validated);

        return Helpers::jsonResponse(true, $country, 'Country created successfully', 201);
    }

    // تحديث دولة
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capital' => 'nullable|string|max:255',
        ]);

        $country->update($validated);

        return Helpers::jsonResponse(true, $country, 'Country updated successfully');
    }

    // حذف دولة
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return Helpers::jsonResponse(true, null, 'Country deleted successfully');
    }
}
