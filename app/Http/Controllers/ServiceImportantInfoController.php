<?php

namespace App\Http\Controllers;

use App\Models\ServiceImportantInfo;
use Illuminate\Http\Request;

class ServiceImportantInfoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'important_info' => 'required|string',
        ]);

        $importantInfo = ServiceImportantInfo::create($validated);

        return response()->json(['message' => 'Important info added successfully', 'important_info' => $importantInfo]);
    }

    public function destroy(ServiceImportantInfo $serviceImportantInfo)
    {
        $serviceImportantInfo->delete();

        return response()->json(['message' => 'Important info deleted successfully']);
    }
}
