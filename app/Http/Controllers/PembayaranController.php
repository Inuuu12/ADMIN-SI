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
        // Ambil data pendaftaran santri berdasarkan ID
        $pendaftaran = Pendaftaran::find($id);

        // Cek jika data pendaftaran tidak ditemukan atau statusnya belum diterima (accepted)
        if (!$pendaftaran || $pendaftaran->status != 'accepted') {
            return abort(404, 'Data pendaftaran belum disetujui atau tidak ditemukan.');
        }

        // Biaya tetap Rp 200.000
        $biaya = 200000;

        // Atur parameter transaksi untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => $biaya, // Menggunakan biaya tetap
            ],
            'customer_details' => [
                'first_name' => $pendaftaran->nama_santri,
                'email' => 'santri@example.com', // Ganti dengan email dari data pendaftaran jika ada
            ],
        ];

        // Dapatkan Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Kirim data pendaftaran dan snap token ke view
        return view('pembayaran', compact('pendaftaran', 'snapToken'));
    }





    public function processBayar(Request $request)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => 200000,
            ],
            'customer_details' => [
                'first_name' => 'Santri Baru',
                'email' => 'santri@example.com',
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['token' => $snapToken]);
    }
}
 
