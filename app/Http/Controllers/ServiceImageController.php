<?php

namespace App\Http\Controllers;

use App\Models\ServiceImage;
use Illuminate\Http\Request;

class ServiceImageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'image_path' => 'required|string',
        ]);

        $image = ServiceImage::create($validated);

        return response()->json(['message' => 'Image added successfully', 'image' => $image]);
    }

    public function destroy(ServiceImage $serviceImage)
    {
        $serviceImage->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
