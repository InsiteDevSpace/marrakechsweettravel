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
        // Validate the incoming request data
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
            'inclusions' => 'nullable|array',
            'inclusions.*' => 'nullable|string|max:255',
            'important_info' => 'nullable|array',
            'important_info.*' => 'nullable|string|max:255',
        ]);

          // Add slug generation
        $validated['slug'] = Str::slug($request->title);

        try {
            // Create the service
            $service = Service::create($validated);

            
           if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        // Generate a unique filename
                        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                        // Save the file in the correct storage directory
                        $image->move(storage_path('app/public/service_images'), $filename);

                        // Save the image path to the database
                        $service->images()->create([
                            'image_path' => 'storage/service_images/' . $filename, // Use the public-accessible path
                        ]);
                    } else {
                        return back()->withErrors(['error' => 'Invalid file uploaded.']);
                    }
                }
            }


            // Save highlights
            if (!empty($validated['highlight'])) {
                foreach ($validated['highlight'] as $highlightText) {
                    if (!empty($highlightText)) {
                        $service->highlights()->create(['text' => $highlightText]);
                    }
                }
            }

            // Save inclusions
            if (!empty($validated['inclusions'])) {
                foreach ($validated['inclusions'] as $inclusionText) {
                    if (!empty($inclusionText)) {
                        $service->inclusions()->create(['text' => $inclusionText]);
                    }
                }
            }

            // Save important info
            if (!empty($validated['important_info'])) {
                foreach ($validated['important_info'] as $infoText) {
                    if (!empty($infoText)) {
                        $service->importantInfos()->create(['text' => $infoText]);
                    }
                }
            }

            return redirect()->route('services.index')->with('success', __('messages.service_added'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => __('messages.service_not_added')]);
        }
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

        // Flatten the response to include all service fields and relationships
        return response()->json([
            'id' => $service->id,
            'title' => $service->title,
            'type' => $service->type,
            'price' => $service->price,
            'duration' => $service->duration,
            'max_participants' => $service->max_participants,
            'location' => $service->location,
            'description' => $service->description,
            'highlights' => $service->highlights,
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
            'inclusions' => 'nullable|array',
            'inclusions.*' => 'nullable|string|max:255',
            'important_info' => 'nullable|array',
            'important_info.*' => 'nullable|string|max:255',
        ]);

      

        // Update service details
        $service->update($validated);

        // Update images
        if ($request->hasFile('images')) {
            ServiceImage::where('service_id', $service->id)->delete();
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/service_images');
                ServiceImage::create([
                    'service_id' => $service->id,
                    'image_path' => $path,
                ]);
            }
        }

        // Update highlights
        if (!empty($validated['highlight'])) {
            ServiceHighlight::where('service_id', $service->id)->delete();
            foreach ($validated['highlight'] as $highlightText) {
                if ($highlightText) {
                    ServiceHighlight::create([
                        'service_id' => $service->id,
                        'text' => $highlightText,
                    ]);
                }
            }
        }

        // Update inclusions
        if (!empty($validated['inclusions'])) {
            ServiceInclusion::where('service_id', $service->id)->delete();
            foreach ($validated['inclusions'] as $inclusionText) {
                if ($inclusionText) {
                    ServiceInclusion::create([
                        'service_id' => $service->id,
                        'text' => $inclusionText,
                    ]);
                }
            }
        }

        // Update important info
        if (!empty($validated['important_info'])) {
            ServiceImportantInfo::where('service_id', $service->id)->delete();
            foreach ($validated['important_info'] as $infoText) {
                if ($infoText) {
                    ServiceImportantInfo::create([
                        'service_id' => $service->id,
                        'text' => $infoText,
                    ]);
                }
            }
        }

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
