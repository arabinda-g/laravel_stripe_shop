<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentMethod;

class PaymentController extends Controller
{
    public function success()
    {
        return view('payment.success');
    }

    public function failed()
    {
        return view('payment.failed');
    }

    public function processPayment(Request $request, $product_id)
    {
        $user = auth()->user();
        $request->validate([
            'stripeToken' => 'required|string',
        ]);

        // Load the product from the database
        $product = Product::findOrFail($product_id);
        $amount = $product->price * 100;
        $stripeToken = $request->stripeToken;

        try {
            // Set Stripe secret key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Convert token to payment method
            $paymentMethod = PaymentMethod::create([
                'type' => 'card',
                'card' => ['token' => $stripeToken],
            ]);

            // Charge the user
            $charge = $user->charge($amount, $paymentMethod->id, [
                'currency' => 'inr',
            ]);

            // Record the purchase
            Purchase::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'amount' => $product->price,
                'currency' => 'inr',
                'stripe_charge_id' => $charge->id,
            ]);

            return redirect()->route('payment.success');
        } catch (\Exception $e) {
            return redirect()->route('payment.failed')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
