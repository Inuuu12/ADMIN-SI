@extends('layouts.berandaly')

<div class="w-3/4 mb-[100px] mx-auto drop-shadow">
    <a href="">
        <img src="{{ asset('img/bannerpendaftaran.png') }}" alt="">
    </a>
    <div class="flex flex-col p-10 bg-white">
        <div class="card flex bg-white shadow-sm rounded-lg overflow-hidden w-full md:w-full border border-gray-300">
            <div class="bg-white rounded-lg p-6 w-full">
                <h1 class="text-xl font-bold text-gray-800 mb-6 text-center">Pembayaran Awal</h1>
                
                <!-- Cek status pembayaran -->
                @if($pendaftaran->status_pembayaran == 'sudah') 
                    <div class="mb-6">
                        <p class="text-sm text-gray-600">Pembayaran Anda sudah berhasil</p>
                        <p class="text-2xl font-bold text-green-600">Terima kasih telah melakukan pembayaran</p>
                    </div>
                @else
                    <div class="mb-6">  
                        <p class="text-sm text-gray-600">Total Pembayaran</p>
                        <p class="text-2xl font-bold text-gray-800">Rp{{ number_format(10000, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <button id="pay-button"
                            class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            Bayar
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@extends('layouts.footerly')

<!-- Midtrans Snap Script -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function (e) {
            e.preventDefault();

            const snapToken = "{{ $snapToken }}";

            snap.pay(snapToken, {
                onSuccess: function (result) {
                    window.location.href = "/pembayaran/sukses?order_id={{ $pendaftaran->order_id }}";
                },

                onPending: function (result) {
                    console.log("Pending:", result);
                    alert("Pembayaran masih pending.");
                },
                onError: function (result) {
                    console.error("Error:", result);
                    alert("Terjadi kesalahan saat pembayaran.");
                },
                onClose: function () {
                    alert("Popup ditutup tanpa menyelesaikan pembayaran.");
                }
            });
        });
    });
</script>
