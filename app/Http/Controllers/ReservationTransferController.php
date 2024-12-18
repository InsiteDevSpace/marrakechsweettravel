<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transfer;
use App\Models\ReservationTransfer;
use Illuminate\Http\Request;

class ReservationTransferController extends Controller
{
    // Show the form to create a reservation
    public function create()
    {
        // Fetch all transfers and clients to populate the form
        $transfers = Transfer::all();
        $clients = Client::all();

        return view('reservation_transfers.create', compact('transfers', 'clients'));
    }

    // Store a new reservation
    public function store(Request $request)
    {
        $transfer = Transfer::findOrFail($request->transfer_id);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'transfer_id' => 'required|exists:transfers,id',
            'adults_count' => 'required|integer|min:1',
            'children_count' => 'nullable|integer|min:0',
            'total_price' => 'required|numeric|min:0',
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($transfer) {
                    $reservationDate = new \DateTime($value);
                    $startDate = new \DateTime($transfer->start_date);
                    $endDate = $transfer->end_date ? new \DateTime($transfer->end_date) : null;

                    if ($reservationDate < $startDate || ($endDate && $reservationDate > $endDate)) {
                        $fail(__('messages.reservation_date_invalid_range'));
                    }
                }
            ],
            'hotel_name' => 'nullable|string|max:255',
            'hotel_address' => 'nullable|string|max:255',
            'flight_number' => 'nullable|string|min:1',
            'hotel_phone' => 'nullable|numeric',
            'comment' => 'nullable|string|max:500',
        ]);

        $totalPeople = $request->adults_count + $request->children_count;

        // Check if there are enough places for the reservation
        if ($transfer->max_people < $totalPeople) {
            return back()->withErrors([
                'total_people' => __('messages.not_enough_places'),
            ]);
        }

        // Update max_people for the transfer
        $transfer->decrement('max_people', $totalPeople);

        // Create the reservation
        ReservationTransfer::create([
            'client_id' => $request->client_id,
            'transfer_id' => $request->transfer_id,
            'adults_count' => $request->adults_count,
            'children_count' => $request->children_count,
            'total_price' => $request->total_price,
            'date' => $request->date,
            'hotel_name' => $request->hotel_name,
            'hotel_address' => $request->hotel_address,
            'flight_number' => $request->flight_number,
            'flight_time' => $request->flight_time,
            'hotel_phone' => $request->hotel_phone,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reservation_transfers.index')->with('success', __('messages.reservation_created'));
    }

    // Show all reservations
    public function index()
    {
        $clients = Client::all();
        $transfers = Transfer::all();

        $reservations = ReservationTransfer::with('client', 'transfer')->paginate(10);

        return view('reservation_transfers.index', compact('clients', 'transfers', 'reservations'));
    }

    // Show the details of a specific reservation
    public function show($id)
    {
        $reservation = ReservationTransfer::with('transfer', 'client')->findOrFail($id);

        return response()->json($reservation);
    }

    // Edit an existing reservation
    public function edit($id)
    {
        $reservation = ReservationTransfer::findOrFail($id);
        $transfers = Transfer::all();
        $clients = Client::all();

        return view('reservation_transfers.edit', compact('reservation', 'transfers', 'clients'));
    }

    // Update an existing reservation
    public function update(Request $request, $id)
    {
        $reservation = ReservationTransfer::findOrFail($id);
        $transfer = Transfer::findOrFail($request->transfer_id);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'transfer_id' => 'required|exists:transfers,id',
            'adults_count' => 'required|integer|min:1',
            'children_count' => 'nullable|integer|min:0',
            'total_price' => 'required|numeric|min:0',
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($transfer) {
                    $reservationDate = new \DateTime($value);
                    $startDate = new \DateTime($transfer->start_date);
                    $endDate = $transfer->end_date ? new \DateTime($transfer->end_date) : null;

                    if ($reservationDate < $startDate || ($endDate && $reservationDate > $endDate)) {
                        $fail(__('messages.reservation_date_invalid_range'));
                    }
                }
            ],
            'hotel_name' => 'nullable|string|max:255',
            'hotel_address' => 'nullable|string|max:255',
            'flight_number' => 'nullable|string|min:1',
            'flight_time' => 'nullable',
            'hotel_phone' => 'nullable|numeric',
            'comment' => 'nullable|string|max:500',
        ]);

        $newTotalPeople = $request->adults_count + $request->children_count;
        $oldTotalPeople = $reservation->adults_count + $reservation->children_count;
        $peopleDifference = $newTotalPeople - $oldTotalPeople;

        // Check if enough places are available for the updated reservation
        if ($peopleDifference > 0 && $transfer->max_people < $peopleDifference) {
            return back()->withErrors([
                'total_people' => __('messages.not_enough_places'),
            ]);
        }

        // Update max_people for the transfer
        if ($peopleDifference > 0) {
            $transfer->decrement('max_people', $peopleDifference);
        } elseif ($peopleDifference < 0) {
            $transfer->increment('max_people', abs($peopleDifference));
        }

        // Update the reservation
        $reservation->update([
            'client_id' => $request->client_id,
            'transfer_id' => $request->transfer_id,
            'adults_count' => $request->adults_count,
            'children_count' => $request->children_count,
            'total_price' => $request->total_price,
            'date' => $request->date,
            'hotel_name' => $request->hotel_name,
            'hotel_address' => $request->hotel_address,
            'flight_number' => $request->flight_number,
            'flight_time' => $request->flight_time,
            'hotel_phone' => $request->hotel_phone,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reservation_transfers.index')->with('success', __('messages.reservation_updated'));
    }

    // Delete a reservation
    public function destroy($id)
    {
        $reservation = ReservationTransfer::findOrFail($id);

        // Get the associated transfer for the reservation
        $transfer = $reservation->transfer;

        // Increase the max_people by the number of people in the reservation being deleted
        $transfer->increment('max_people', $reservation->adults_count + $reservation->children_count);

        // Delete the reservation
        $reservation->delete();

        return redirect()->route('reservation_transfers.index')->with('success', __('messages.reservation_deleted'));
    }
}
