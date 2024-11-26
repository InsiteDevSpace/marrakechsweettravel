<?php

namespace App\Http\Controllers;

use App\Models\ServiceInclusion;
use Illuminate\Http\Request;

class ServiceInclusionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'inclusion' => 'required|string',
        ]);

        $inclusion = ServiceInclusion::create($validated);

        return response()->json(['message' => 'Inclusion added successfully', 'inclusion' => $inclusion]);
    }

    public function destroy(ServiceInclusion $serviceInclusion)
    {
        $serviceInclusion->delete();

        return response()->json(['message' => 'Inclusion deleted successfully']);
    }
}
