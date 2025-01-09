<?php

namespace App\Http\Controllers;

use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = session('cart');

        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Calculate the total amount (convert to smallest currency unit, e.g., cents for USD)
        $totalAmount = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        // Initialize Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a Payment Intent
        $paymentIntent = PaymentIntent::create([
            'amount'   => $totalAmount * 100, // Convert to cents
            'currency' => 'usd',
            'metadata' => [
                'user_id' => auth()->id(),
                'cart_id' => session()->getId(),
            ],
        ]);

        return view('checkout', [
            'cart'        => $cart,
            'totalAmount' => $totalAmount,
            'intent'      => $paymentIntent,
        ]);
    }
}
