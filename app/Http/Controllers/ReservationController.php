<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\ServiceAvailability;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
    public function index()
    {
        $reservations = Reservation::with(['client', 'service'])->get();
        $clients = Client::all();
        $services = Service::all();

        return view('reservations.index', compact('reservations', 'clients', 'services'));
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'start_date' => 'required|date', // Start date
            'end_date' => 'required|date|after_or_equal:start_date', // End date must be after or equal to start date
            'adults_count' => 'required|integer|min:1', // At least 1 adult
            'children_count' => 'nullable|integer|min:0', // Can be 0 or more
            'payment_status' => 'required|in:paid,unpaid', // Must be either 'paid' or 'unpaid'
            'status' => 'required|in:confirmed,pending,cancelled', // Must be one of the statuses
        ]);

        // Fetch the service to calculate pricing
        $service = Service::findOrFail($request->service_id);

        // Calculate total slots required
        $totalReservedSlots = $request->adults_count + $request->children_count;

        // Fetch availability for the selected start and end dates
        $availability = ServiceAvailability::where('service_id', $request->service_id)
            ->where('start_date', '<=', $request->start_date)
            ->where('end_date', '>=', $request->end_date)
            ->first();

        // Check if availability exists and has enough slots
        if (!$availability || $availability->remaining_slots < $totalReservedSlots) {
            return redirect()->back()->withErrors(__('Not enough slots available for the selected dates.'));
        }

        // Deduct the slots
        $availability->decrement('remaining_slots', $totalReservedSlots);

        // Calculate total price based on adults and children
        $totalPrice = ($request->adults_count * $service->price) + ($request->children_count * $service->price * 0.5);

        // Create the reservation
        Reservation::create([
            'client_id' => $request->client_id,
            'service_id' => $request->service_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'adults_count' => $request->adults_count,
            'children_count' => $request->children_count,
            'total_price' => $totalPrice,
            'payment_status' => $request->payment_status,
            'status' => $request->status,
        ]);

        // Redirect back with success message
        return redirect()->route('reservations.index')->with('success', __('Reservation created successfully.'));
    }



    /**
     * Show the details of a specific reservation.
     */
    public function show(Reservation $reservation)
    {
        return response()->json($reservation->load('client', 'service'));
    }


    /**
     * Update a specific reservation.
     */
    public function update(Request $request, Reservation $reservation)
    {
        // Validate the input data
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'adults_count' => 'required|integer|min:1',
            'children_count' => 'nullable|integer|min:0',
            'payment_status' => 'required',
            'status' => 'required',
        ]);

        // Step 1: Fetch previous total slots and availability
        $previousTotalSlots = $reservation->adults_count + $reservation->children_count;

        $oldAvailability = ServiceAvailability::where('service_id', $reservation->service_id)
            ->where('start_date', '<=', $reservation->start_date)
            ->where('end_date', '>=', $reservation->end_date)
            ->first();

        if ($oldAvailability) {
            // Revert previous slots
            $oldAvailability->increment('remaining_slots', $previousTotalSlots);
        }

        // Step 2: Calculate the new total slots
        $newTotalSlots = $request->adults_count + $request->children_count;

        $newAvailability = ServiceAvailability::where('service_id', $request->service_id)
            ->where('start_date', '<=', $request->start_date)
            ->where('end_date', '>=', $request->end_date)
            ->first();

        if ($newAvailability) {
            // Deduct new slots
            if ($newAvailability->remaining_slots < $newTotalSlots) {
                return redirect()->back()->withErrors(__('Not enough slots available for the selected date.'));
            }

            $newAvailability->decrement('remaining_slots', $newTotalSlots);
        }

        // Step 3: Update reservation fields
        $reservation->update([
            'client_id' => $request->client_id,
            'service_id' => $request->service_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'adults_count' => $request->adults_count,
            'children_count' => $request->children_count,
            'payment_status' => $request->payment_status,
            'status' => $request->status,
        ]);

        // Redirect with success message
        return redirect()->route('reservations.index')->with('success', __('Reservation updated successfully.'));
    }


    public function destroy(Reservation $reservation)
    {
        // Calculate the total slots to be added back
        $totalSlotsToAdd = $reservation->adults_count + $reservation->children_count;

        // Fetch availability for the reservation's start and end dates
        $availability = ServiceAvailability::where('service_id', $reservation->service_id)
            ->where('start_date', '<=', $reservation->start_date)
            ->where('end_date', '>=', $reservation->end_date)
            ->first();

        // If availability exists, increment the remaining slots
        if ($availability) {
            $availability->increment('remaining_slots', $totalSlotsToAdd);
        }

        // Delete the reservation
        $reservation->delete();

        // Redirect with success message
        return redirect()->route('reservations.index')->with('success', __('messages.reservation_deleted_successfully'));
    }

}
