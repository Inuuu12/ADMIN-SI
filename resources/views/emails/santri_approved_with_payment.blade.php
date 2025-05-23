<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Pendaftaran Diterima</title>
</head>
<body>
    <p>Assalamualaikum, {{ $pendaftaran->nama_santri }}!</p>
    <p>Selamat, pendaftaran Anda telah <strong>DITERIMA</strong>.</p>
    <p>Silakan klik tombol di bawah ini untuk melanjutkan ke halaman pembayaran.</p>
    <a href="{{ url('/bayar/' . $pendaftaran->kode_unik) }}" class="button">Ke Halaman Pembayaran</a>
    <p>Terima kasih.</p>
>>>>>>> f9c2840 (keep perubahan ardien)
</body>
</html>
