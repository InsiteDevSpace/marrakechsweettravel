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
            'reservation_dates' => 'required|array', // Must be an array of dates
            'adults_count' => 'required|integer|min:1', // At least 1 adult
            'children_count' => 'nullable|integer|min:0', // Can be 0 or more
            'payment_status' => 'required|in:paid,unpaid', // Must be either 'paid' or 'unpaid'
            'status' => 'required|in:confirmed,pending,cancelled', // Must be one of the statuses
        ]);

        // Fetch the service to calculate pricing and validate availability
        $service = Service::findOrFail($request->service_id);
        $totalSlotsRequired = $request->adults_count + $request->children_count;

        foreach ($request->reservation_dates as $date) {
            // Check availability for each selected date
            $availability = ServiceAvailability::where('service_id', $request->service_id)
                ->where('start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->first();

            if (!$availability || $availability->remaining_slots < $totalSlotsRequired) {
                return redirect()->back()->withErrors(__('Not enough slots available for the date: ') . $date);
            }

            // Deduct slots from availability
            $availability->decrement('remaining_slots', $totalSlotsRequired);
        }

        // Calculate total price based on adults and children
        $totalPrice = ($request->adults_count * $service->price) + ($request->children_count * $service->price * 0.5);

        // Create the reservation
        Reservation::create([
            'client_id' => $request->client_id,
            'service_id' => $request->service_id,
            'reservation_dates' => json_encode($request->reservation_dates), // Save dates as JSON
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
        $reservation->reservation_dates = json_decode($reservation->reservation_dates, true);
        return response()->json($reservation->load('client', 'service'));
    }


    /**
     * Update a specific reservation.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'reservation_dates' => 'required|array',
            'adults_count' => 'required|integer|min:1',
            'children_count' => 'nullable|integer|min:0',
            'payment_status' => 'required|in:paid,unpaid',
            'status' => 'required|in:confirmed,pending,cancelled',
        ]);

        // Ensure service availability
        foreach ($request->reservation_dates as $date) {
            $availability = ServiceAvailability::where('service_id', $request->service_id)
                ->where('start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->first();

            if (!$availability || $availability->remaining_slots < ($request->adults_count + $request->children_count)) {
                return redirect()->back()->withErrors(__('Not enough slots available for the date: ') . $date);
            }
        }

        // Adjust the remaining slots if required
        $slotsDifference = ($request->adults_count + $request->children_count) - ($reservation->adults_count + $reservation->children_count);
        if ($slotsDifference > 0) {
            foreach ($request->reservation_dates as $date) {
                $availability = ServiceAvailability::where('service_id', $request->service_id)
                    ->where('start_date', '<=', $date)
                    ->where('end_date', '>=', $date)
                    ->first();
                $availability->decrement('remaining_slots', $slotsDifference);
            }
        } elseif ($slotsDifference < 0) {
            foreach ($request->reservation_dates as $date) {
                $availability = ServiceAvailability::where('service_id', $request->service_id)
                    ->where('start_date', '<=', $date)
                    ->where('end_date', '>=', $date)
                    ->first();
                $availability->increment('remaining_slots', abs($slotsDifference));
            }
        }

        // Calculate the total price
        $service = Service::findOrFail($request->service_id);
        $totalPrice = ($request->adults_count * $service->price) + ($request->children_count * $service->price * 0.5);

        // Update the reservation
        $reservation->update([
            'client_id' => $request->client_id,
            'service_id' => $request->service_id,
            'reservation_dates' => json_encode($request->reservation_dates),
            'adults_count' => $request->adults_count,
            'children_count' => $request->children_count,
            'total_price' => $totalPrice,
            'payment_status' => $request->payment_status,
            'status' => $request->status,
        ]);

        return redirect()->route('reservations.index')->with('success', __('Reservation updated successfully.'));
    }

      public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', __('messages.reservation_deleted_successfully'));
    }
}
