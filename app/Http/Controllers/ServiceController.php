<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\ServiceHighlight;
use App\Models\ServiceInclusion;
use App\Models\ServiceImportantInfo;
use Illuminate\Support\Str;


class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $services = Service::with(['images', 'highlights', 'inclusions', 'importantInfos'])->paginate(10);

        return view('services.index', compact('services'));
    }

    /**
     * Store a newly created service in storage.
     */
   
   public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:day_trip,activity,tour',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'min_age' => 'nullable|integer|min:0',
            'overview' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'map_lat' => 'nullable|string|max:255',
            'map_lng' => 'nullable|string|max:255',
            'discount' => 'nullable|numeric|min:0|max:100',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'highlight' => 'nullable|array',
            'highlight.*' => 'nullable|string|max:255',
            'highlight_detail' => 'nullable|array',
            'highlight_detail.*' => 'nullable|string|max:800',
            'inclusions' => 'nullable|array',
            'inclusions.*' => 'nullable|string|max:255',
            'important_info' => 'nullable|array',
            'important_info.*' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($request->title);

        // Create Service
        $service = Service::create($validated);

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/service_images'), $filename);
                $service->images()->create(['image_path' => "storage/service_images/{$filename}"]);
            }
        }

        // Save highlights
        if (!empty($validated['highlight'])) {
            foreach ($validated['highlight'] as $index => $highlightText) {
                $highlightDetail = $validated['highlight_detail'][$index] ?? null;
                $service->highlights()->create([
                    'text' => $highlightText,
                    'highlight_detail' => $highlightDetail,
                ]);
            }
        }

        // Save inclusions
        if (!empty($validated['inclusions'])) {
            foreach ($validated['inclusions'] as $text) {
                $service->inclusions()->create(['text' => $text]);
            }
        }

        // Save important info
        if (!empty($validated['important_info'])) {
            foreach ($validated['important_info'] as $text) {
                $service->importantInfos()->create(['text' => $text]);
            }
        }

        return redirect()->route('services.index')->with('success', __('messages.service_added'));
    }




    public function edit(Service $service)
    {
        // Load related data like highlights, inclusions, images, and importantInfos
        $service->load(['highlights', 'inclusions', 'importantInfos', 'images']);

        return view('services.edit', compact('service'));
    }




    /**
     * Show the specified service.
     */
    public function show($id)
    {
        $service = Service::with(['images', 'highlights', 'inclusions', 'importantInfos'])->find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        return response()->json([
            'id' => $service->id,
            'title' => $service->title,
            'type' => $service->type,
            'price' => $service->price,
            'duration' => $service->duration,
            'max_participants' => $service->max_participants,
            'min_age' => $service->min_age ?? 0, // Default to 0 if null
            'location' => $service->location,
            'map_lat' => $service->map_lat,
            'map_lng' => $service->map_lng,
            'overview' => $service->overview,
            'description' => $service->description,
            'highlights' => $service->highlights,
            'discount' => $service->discount,
            'inclusions' => $service->inclusions,
            'importantInfos' => $service->importantInfos,
            'images' => $service->images,
        ]);
    }







    public function showService($slug)
    {
        $service = Service::where('slug', $slug)
            ->with(['images', 'highlights', 'inclusions', 'importantInfos'])
            ->firstOrFail();

        return view('pages.service-detail', compact('service'));
    }




    /**
     * Update the specified service in storage.
     */


   public function update(Request $request, Service $service)
{
    // Validate the form data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|in:day_trip,activity,tour',
        'price' => 'required|numeric|min:0',
        'duration' => 'required|string|max:255',
        'max_participants' => 'nullable|integer|min:1',
        'min_age' => 'nullable|integer|min:0',
        'location' => 'nullable|string|max:255',
        'overview' => 'nullable|string',
        'description' => 'nullable|string',
        'discount' => 'nullable|numeric|min:0|max:100',
        'map_lat' => 'nullable|string|max:255',
        'map_lng' => 'nullable|string|max:255',
        'highlight' => 'nullable|array',
        'highlight.*' => 'nullable|string|max:255',
        'highlight_detail' => 'nullable|array',
        'highlight_detail.*' => 'nullable|string|max:500',
        'inclusions' => 'nullable|array',
        'inclusions.*' => 'nullable|string|max:255',
        'important_info' => 'nullable|array',
        'important_info.*' => 'nullable|string|max:255',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update the main service details
    $service->update([
        'title' => $validated['title'],
        'type' => $validated['type'],
        'price' => $validated['price'],
        'duration' => $validated['duration'],
        'max_participants' => $validated['max_participants'],
        'min_age' => $validated['min_age'],
        'location' => $validated['location'],
        'overview' => $validated['overview'],
        'description' => $validated['description'],
        'discount' => $validated['discount'],
        'map_lat' => $validated['map_lat'],
        'map_lng' => $validated['map_lng'],
    ]);

    // Update Highlights
    if (isset($validated['highlight'])) {
        $service->highlights()->delete(); // Clear existing highlights
        foreach ($validated['highlight'] as $index => $text) {
            $service->highlights()->create([
                'text' => $text,
                'highlight_detail' => $validated['highlight_detail'][$index] ?? null,
            ]);
        }
    }

    // Update Inclusions
    if (isset($validated['inclusions'])) {
        $service->inclusions()->delete(); // Clear existing inclusions
        foreach ($validated['inclusions'] as $text) {
            $service->inclusions()->create(['text' => $text]);
        }
    }

    // Update Important Infos
    if (isset($validated['important_info'])) {
        $service->importantInfos()->delete(); // Clear existing important info
        foreach ($validated['important_info'] as $text) {
            $service->importantInfos()->create(['text' => $text]);
        }
    }

    if ($request->hasFile('images')) {
        // Delete existing images and their files
        foreach ($service->images as $image) {
            $existingPath = public_path($image->image_path); // Resolve the current image path
            if (file_exists($existingPath)) {
                unlink($existingPath); // Delete the physical file
            }
            $image->delete(); // Delete the database record
        }

        // Upload and save new images
        foreach ($request->file('images') as $image) {
            $filename = uniqid() . '.' . $image->getClientOriginalExtension(); // Generate a unique filename
            $image->move(public_path('storage/service_images'), $filename); // Move to `public/storage/service_images`
            $service->images()->create(['image_path' => "storage/service_images/{$filename}"]); // Save the file path
        }
    }



    // Redirect back with success message
    return redirect()->route('services.index')->with('success', __('messages.service_updated'));
}



    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('success', __('messages.service_deleted'));
    }

    
}
