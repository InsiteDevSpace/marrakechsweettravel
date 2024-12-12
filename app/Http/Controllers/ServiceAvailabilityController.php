<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceAvailability;
use App\Models\Service;

class ServiceAvailabilityController extends Controller
{
    /**
     * Display a listing of the service availabilities.
     */
    public function index()
    {
        // Use the correct relationship name: 'availabilities'
        $services = Service::with('availabilities')->get();

        return view('service_availability.index', compact('services'));
    }

    /**
     * Show the form for creating a new availability.
     */
    public function create()
    {
        $services = Service::all();

        return view('service_availability.create', compact('services'));
    }

    /**
     * Store a newly created availability in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'remaining_slots' => 'required|integer|min:1',
        ]);

        // Create the availability
        ServiceAvailability::create($request->all());

        return redirect()->route('service_availability.index')->with('success', __('messages.availability_added_successfully'));
    }

    /**
     * Show the details of a specific availability for the show modal.
     */
    public function show(ServiceAvailability $serviceAvailability)
    {
        // Load the associated service data
        $serviceAvailability->load('service');

        return response()->json($serviceAvailability);
    }

    /**
     * Show the form for editing the specified availability.
     */
    public function edit(ServiceAvailability $serviceAvailability)
    {
        return response()->json($serviceAvailability);
    }

    /**
     * Update the specified availability in storage.
     */
    public function update(Request $request, ServiceAvailability $serviceAvailability){
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',

            'remaining_slots' => 'required|integer|min:1',
        ]);

        $serviceAvailability->update($request->all());

        return redirect()->route('service_availability.index')
                        ->with('success', __('messages.availability_updated_successfully'));
    }


    /**
     * Remove the specified availability from storage.
     */
    public function destroy(ServiceAvailability $serviceAvailability)
    {
        $serviceAvailability->delete();

        return redirect()->route('service_availability.index')->with('success', __('messages.availability_deleted_successfully'));
    }
}
