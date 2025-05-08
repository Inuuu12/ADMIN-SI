<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Transaction;
use Barryvdh\DomPDF\Facade as PDF;

class PembayaranController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = false;
        // Config::$isSanitized = true;
        // Config::$is3ds = true;

        if (!Config::$serverKey) {
            dd('Server Key kosong');
        }
    }

    public function formBayar($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran || $pendaftaran->status != 'accepted') {
            return abort(404, 'Data pendaftaran belum disetujui atau tidak ditemukan.');
        }

        $snapToken = $pendaftaran->snap_token;
        $orderId = $pendaftaran->order_id;
        $regenerateToken = false;

        if ($snapToken && $orderId) {
            try {
                $status = Transaction::status($orderId);
                if (in_array($status->transaction_status, ['expire', 'cancel', 'failure'])) {
                    $regenerateToken = true;
                }
            } catch (\Exception $e) {
                $regenerateToken = true; // Snap token mungkin tidak valid
            }                      
        } else {
            $regenerateToken = true;
        }

        if ($regenerateToken) {
            $orderId = 'ORDER-' . uniqid();
            $pendaftaran->order_id = $orderId;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => 10000,
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
        }

        return view('pembayaran', compact('pendaftaran', 'snapToken'));
    }

    public function processBayar(Request $request)
    {
        $orderId = 'ORDER-' . uniqid(); // Buat order_id baru

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'Santri Baru',
                'email' => 'santri@example.com',
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json([
                'token' => $snapToken,
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function suksesPembayaran(Request $request)
    {
        $orderId = $request->get('order_id');

        $pendaftaran = Pendaftaran::where('order_id', $orderId)->first();

        if (!$pendaftaran) {
            return abort(404, 'Pendaftaran tidak ditemukan');
        }

        try {
            $status = Transaction::status($orderId);

            if ($status->transaction_status === 'settlement') {
                $pendaftaran->status_pembayaran = 'sudah';
            } elseif ($status->transaction_status === 'pending') {
                $pendaftaran->status_pembayaran = 'pending';
            } else {
                $pendaftaran->status_pembayaran = 'gagal';
            }

            $pendaftaran->save();
        } catch (\Exception $e) {
            return abort(500, 'Gagal mengambil status transaksi dari Midtrans: ' . $e->getMessage());
        }

        return view('pembayaran.sukses', compact('pendaftaran'));
    }


    public function checkTransactionStatus($orderId)
    {
        try {
            $status = Transaction::status($orderId);
            dd($status); // Debug
        } catch (\Exception $e) {
            dd($e->getMessage()); // Bisa "Transaction doesn't exist"
        }
    }

    public function cetakInvoice($id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Cek jika pembayaran sudah selesai
        if ($pendaftaran->status_pembayaran != 'sudah') {
            return abort(404, 'Pembayaran belum selesai.');
        }

        // Siapkan data untuk template PDF
        $data = [
            'pendaftaran' => $pendaftaran,
            'paymentDate' => $pendaftaran->updated_at->format('d M Y'), // Tanggal pembayaran
            // Tambahkan data lain yang dibutuhkan untuk invoice
        ];

        // Gunakan DomPDF untuk menghasilkan PDF
        $pdf = PDF::loadView('invoice.cetak', $data);

        // Menghasilkan dan mengunduh file PDF
        return $pdf->download('invoice-' . $pendaftaran->order_id . '.pdf');
    }

}
