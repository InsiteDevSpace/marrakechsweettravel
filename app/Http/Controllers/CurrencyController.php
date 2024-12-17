<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CurrencyController extends Controller
{
    public function setCurrency(Request $request)
    {
        $currency = $request->get('currency', 'USD'); // Default to USD if no currency is provided
        Session::put('currency', $currency); // Save currency to the session
        return response()->json(['success' => true, 'currency' => $currency]);
    }
}
