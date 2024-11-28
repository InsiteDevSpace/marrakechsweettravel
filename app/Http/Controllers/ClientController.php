<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        // Validate client input, including the new fields
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:255'],
            'passport_number' => ['nullable', 'string', 'max:255'],
            'birth_day' => ['nullable', 'date'],
            'nationality' => ['nullable', 'string', 'max:255'],
        ]);

        // Create the client
        Client::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
            'zip_code' => $validated['zip_code'] ?? null,
            'country' => $validated['country'] ?? null,
            'passport_number' => $validated['passport_number'] ?? null,
            'birth_day' => $validated['birth_day'] ?? null,
            'nationality' => $validated['nationality'] ?? null,
        ]);

        return redirect()->route('clients.index')->with('success', __('messages.client_added_success'));
    }

    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client);
    }

    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        // Validate input for updating client data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:255'],
            'passport_number' => ['nullable', 'string', 'max:255'],
            'birth_day' => ['nullable', 'date'],
            'nationality' => ['nullable', 'string', 'max:255'],
        ]);

        $client = Client::findOrFail($id);
        $client->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city ?? null,
            'state' => $request->state ?? null,
            'zip_code' => $request->zip_code ?? null,
            'country' => $request->country ?? null,
            'passport_number' => $request->passport_number ?? null,
            'birth_day' => $request->birth_day ?? null,
            'nationality' => $request->nationality ?? null,
        ]);

        return redirect()->route('clients.index')->with('success', __('messages.client_updated_success'));
    }

    public function destroy(string $id)
    {
        // Find and delete the client
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')->with('success', __('messages.client_deleted_success'));
    }
}
