<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Diterima</title>
    <style>
        .button {
            background-color: #38a169;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <p>Assalamualaikum, {{ $pendaftaran->nama_santri }}!</p>
    <p>Selamat, pendaftaran Anda telah <strong>DITERIMA</strong>.</p>
    <p>Silakan klik tombol di bawah ini untuk melanjutkan ke halaman pembayaran.</p>
    <a href="{{ url('/bayar/' . $pendaftaran->id) }}" class="button">Ke Halaman Pembayaran</a>
    <p>Terima kasih.</p>
</body>
</html>
