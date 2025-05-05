<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Ditolak</title>
    <style>
        .button {
            background-color: #e3342f;
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
    <h2>Halo {{ $pendaftaran->nama_santri }},</h2>
    <p>Data yang diberikan kurang sesuai dengan yang dibutuhkan.</p>
    <p>Silakan klik tombol di bawah ini untuk mengakses halaman pendaftaran dan memperbarui data Anda.</p>
    <a href="{{ route('pendaftaran') }}" class="button">Ke Halaman Pendaftaran</a>
    <p>Terima kasih.</p>
</body>
</html>
