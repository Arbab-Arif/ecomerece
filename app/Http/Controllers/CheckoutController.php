<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart');

        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Calculate the total amount (convert to smallest currency unit, e.g., cents for USD)
        $totalAmount = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        $customer = Customer::firstOrCreate([
            'name'  => session('customer')['name'],
            'email' => session('customer')['email'],
        ]);

        $paymentIntent = $customer->createSetupIntent();

        return view('checkout', [
            'cart'        => $cart,
            'totalAmount' => $totalAmount,
            'intent'      => $paymentIntent
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required',
        ]);
        session()->put('customer', $request->only('name', 'email'));

        return to_route('checkout.index');
    }

    public function charge(Request $request)
    {
        $request->validate([
            'paymentMethod' => 'required',
        ]);

        $totalAmount = collect(session('cart'))->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        $customer = Customer::firstOrcreate([
            'name'  => session('customer')['name'],
            'email' => session('customer')['email'],
        ]);

        if (!$customer->hasStripeId()) {
            $customer->createAsStripeCustomer();
        }

        $customer->updateDefaultPaymentMethod($request->paymentMethod);
        $orderId = ceil(mt_rand(11111, 99999));
        $customer->invoiceFor( $orderId . " - Order", $totalAmount * 100);

        session()->forget('cart');
        session()->forget('customer');

        return to_route('thanks');
    }
}
