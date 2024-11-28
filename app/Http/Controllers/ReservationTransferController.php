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
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'transfer_id' => 'required|exists:transfers,id',
            'total_people' => 'required|',
            'total_price' => 'required',
            'date' => 'required|date',
        ]);

        // Create a new reservation
        ReservationTransfer::create([
            'client_id' => $request->client_id,
            'transfer_id' => $request->transfer_id,
            'total_people' => $request->total_people,
            'total_price' => $request->total_price,
            'date' => $request->date,
        ]);

        // Redirect or show success message
        return redirect()->route('reservation_transfers.index')->with('success', __('messages.reservation_created'));
    }

    // Show all reservations
    public function index()
    {
        $clients = Client::all();
        $transfers = Transfer::all();

        $reservations = ReservationTransfer::with('client', 'transfer')
            ->paginate(10);

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
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'transfer_id' => 'required|exists:transfers,id',
            'total_people' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'date' => 'required|date',
            // 'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation = ReservationTransfer::findOrFail($id);
        $reservation->update([
            'client_id' => $request->client_id,
            'transfer_id' => $request->transfer_id,
            'total_people' => $request->total_people,
            'total_price' => $request->total_price,
            'date' => $request->date,
            // 'status' => $request->status,
        ]);

        return redirect()->route('reservation_transfers.index')->with('success', __('messages.reservation_updated'));
    }

    // Delete a reservation
    public function destroy($id)
    {
        $reservation = ReservationTransfer::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservation_transfers.index')->with('success', __('messages.reservation_deleted'));
    }
}
