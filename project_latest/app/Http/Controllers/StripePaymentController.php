<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\User;


class StripePaymentController extends Controller
{
    public function stripe(Request $request): JsonResponse
    {
        // Fetch the value from the request payload
        $value = $request->input('value');

        // Assuming you have a User model and the user is authenticated
        $user = auth()->user();

        // Update the subscription field with the received value
        $user->subscription = $value;
        $user->save();

        // You can now use the $value variable as needed in your logic
        // For example, you can return it in the response
        return response()->json([
            'value' => $value
        ]);
    }
        



    public function stripeCheckout(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';

        $response = $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,

            'customer_email' => 'demo@gmail.com',

            'payment_method_types' => ['link','card'],

            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $request->product,
                        ],
                        'unit_amount' => 100 * $request->price,
                        'currency' => 'USD',
                    ],
                    'quantity' => 1
                ],
            ],

            'mode' => 'payment',
            'allow_promotion_codes' => true,
        ]);

        return redirect($response['url']);
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        return redirect()->route('stripe.index')
                            ->with('success','Payment successful.');
    }
}