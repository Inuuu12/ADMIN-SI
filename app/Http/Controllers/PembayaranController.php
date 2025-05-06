<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran; // Menggunakan model Pendaftaran
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PembayaranController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$clientKey = config('midtrans.client_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    
        // Debug sementara
        if (!\Midtrans\Config::$serverKey) {
            dd('Server Key kosong');
        }
    }

    public function formBayar($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran || $pendaftaran->status != 'accepted') {
            return abort(404, 'Data pendaftaran belum disetujui atau tidak ditemukan.');
        }

        // Buat Snap Token baru jika belum ada
        if (!$pendaftaran->snap_token) {
            $orderId = 'ORDER-' . uniqid();
            $pendaftaran->order_id = $orderId;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => 10000, // total pembayaran
                ],
                'customer_details' => [
                    'first_name' => $pendaftaran->nama_santri,
                    'email' => 'santri@example.com',
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $pendaftaran->snap_token = $snapToken;
                $pendaftaran->save();
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        } else {
            $snapToken = $pendaftaran->snap_token;
        }

        return view('pembayaran', compact('pendaftaran', 'snapToken'));
    }



    


    public function processBayar(Request $request)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'Santri Baru',
                'email' => 'santri@example.com',
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['token' => $snapToken]);
    }

    public function suksesPembayaran(Request $request)
    {
        $orderId = $request->get('order_id');
        $statusPembayaran = $request->get('transaction_status');
    
        $pendaftaran = Pendaftaran::where('order_id', $orderId)->first();
    
        if (!$pendaftaran) {
            return abort(404, 'Pendaftaran tidak ditemukan');
        }
    
        // Cek status pembayaran dan update status
        if ($statusPembayaran == 'settlement') {
            $pendaftaran->status_pembayaran = 'sudah';
        } elseif ($statusPembayaran == 'pending') {
            $pendaftaran->status_pembayaran = 'pending';
        } else {
            $pendaftaran->status_pembayaran = 'gagal';
        }
    
        $pendaftaran->save();
    
        return view('pembayaran.sukses', compact('pendaftaran'));
    }
    



}

 
