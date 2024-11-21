<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::paginate(10);
        return view('donations.index', compact('donations'));
    }

    public function store(Request $request)
    {
         $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|in:card,transfer,cheque',
            'amount' => 'nullable|numeric|min:1|required_if:payment_method,card',
            'currency' => 'nullable|in:EUR,MAD|required_if:payment_method,card',
            'country' => 'required|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
        ]);


        Donation::create($validated);

        return redirect()->route('donations.index')->with('success', __('messages.donation_added'));
    }


    public function donate(Request $request)
    {
        // Validate common fields
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|in:card,transfer,cheque',
            'country' => 'required|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Conditional validation for card
        if ($request->input('payment_method') === 'card') {
            $validated = array_merge($validated, $request->validate([
                'amount' => 'required|numeric|min:1',
                'currency' => 'required|in:EUR,MAD',
            ]));
        }else{
            return redirect()->back()->with('error', 'Merci de choisir une methode paiement.');
        }


    

        // Try to create the donation and catch any error
        try {
            Donation::create($validated);
            return redirect()->back()->with('success', 'Don ajouté avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Il y a eu un problème avec votre don. Veuillez réessayer.');
        }
    }


    public function show(Donation $donation)
    {
        return response()->json($donation);
    }



    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('donations.index')->with('success', __('messages.donation_deleted'));
    }
}
