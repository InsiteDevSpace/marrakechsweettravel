<?php

namespace App\Http\Controllers;

use App\Models\ServiceHighlight;
use Illuminate\Http\Request;

class ServiceHighlightController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'highlight' => 'required|string',
        ]);

        $highlight = ServiceHighlight::create($validated);

        return response()->json(['message' => 'Highlight added successfully', 'highlight' => $highlight]);
    }

    public function destroy(ServiceHighlight $serviceHighlight)
    {
        $serviceHighlight->delete();

        return response()->json(['message' => 'Highlight deleted successfully']);
    }
}
