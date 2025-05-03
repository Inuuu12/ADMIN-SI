<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function pay($id)
    {
        // Data dummy santri baru
        $nama = "Santri Baru #$id";
        $amount = 200000;

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => $nama,
                'email' => 'santri@example.com',
                'phone' => '08123456789',
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('payment', compact('snapToken'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to create payment link.']);
        }
    }
}
