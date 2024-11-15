<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        return Alumni::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'graduation_year' => 'required|integer',
            'status' => 'required|string',
            'company_name' => 'nullable|string',
            'position' => 'nullable|string',
        ]);

        return Alumni::create($validated);
    }

    public function show($id)
    {
        return Alumni::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'phone' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'graduation_year' => 'sometimes|required|integer',
            'status' => 'sometimes|required|string',
            'company_name' => 'nullable|string',
            'position' => 'nullable|string',
        ]);

        $alumni->update($validated);

        return $alumni;
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->delete();

        return response()->noContent();
    }

    public function search($name)
    {
        return Alumni::where('name', 'like', "%$name%")->get();
    }

    public function freshGraduate()
    {
        return Alumni::where('status', 'fresh-graduate')->get();
    }

    public function employed()
    {
        return Alumni::where('status', 'employed')->get();
    }

    public function unemployed()
    {
        return Alumni::where('status', 'unemployed')->get();
    }
}