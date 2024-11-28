<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the transfers.
     */
    public function index()
    {
        // Fetch all transfers
        $transfers = Transfer::paginate(10);

        // Return the view with the data
        return view('transfers.index', compact('transfers'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'min_people' => 'required|integer|min:1',
            'max_people' => 'required|integer|min:1',
            'estimated_time' => 'nullable|integer',
            'price' => 'required|numeric|min:0',
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => $request->type === 'round_trip' ? 'required|date' : 'nullable|date',
            'type' => 'required|in:one_way,round_trip',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/transfers'), $fileName);
            $validated['image'] = $fileName;
        }

        // Create a new transfer
        Transfer::create($validated);

        // Redirect to the transfers index page with a success message
        return redirect()->route('transfers.index')->with('success',  __('messages.transfer_created_success'));
    }

    public function show($id)
    {
        $transfer = Transfer::findOrFail($id);

        return response()->json($transfer);
    }

    public function update(Request $request, $id)
    {
        $transfer = Transfer::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'min_people' => 'required|integer|min:1',
            'max_people' => 'required|integer|min:1',
            'estimated_time' => 'nullable|integer',
            'price' => 'required|numeric|min:0',
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'type' => 'required|in:one_way,round_trip',
        ]);

        // Handle file upload if provided
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/transfers'), $fileName);
            $validated['image'] = $fileName;
        }

        $transfer->update($validated);

        return redirect()->route('transfers.index')->with('success', __('messages.transfer_updated_success'));
    }


    public function destroy($id)
    {
        $transfer = Transfer::findOrFail($id);

        // Delete the transfer
        $transfer->delete();

        // Redirect back to the transfers index page with a success message
        return redirect()->route('transfers.index')->with('success',  __('messages.transfer_deleted_success'));
    }
}
