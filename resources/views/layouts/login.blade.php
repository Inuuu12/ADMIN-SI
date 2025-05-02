<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-fadeInUp {
      animation: fadeInUp 0.8s ease-out forwards;
    }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-8">

<div class="flex w-full max-w-6xl bg-white rounded-2xl shadow-xl overflow-hidden">

  <!-- Kiri: Form Login -->
  <div class="w-full md:w-1/2 p-8 opacity-0 translate-y-5 animate-fadeInUp flex items-center justify-center">
  
    <div class="w-full max-w-md">
    <a href="{{ route('beranda') }}" class="border border-red-500 text-red-500 px-4 py-2 rounded text-center hover:bg-red-50 inline-flex items-center gap-2">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
        
      <div class="text-center mb-8">
  
        <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-full mb-4">
          <i class="fas fa-sign-in-alt text-emerald-500 fa-lg"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Yayasan Nurul Iman</h2>
        <p class="text-gray-600 mt-2">Silakan masuk untuk melanjutkan</p>
      </div>

      <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
          <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300" placeholder="you@example.com">
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
          <input type="password" name="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300" placeholder="••••••••">
        </div>

        <button type="submit" class="w-full bg-emerald-500 text-white py-3 rounded-lg font-semibold hover:bg-emerald-600">
  Masuk
</button>

      <div class="mt-4 text-center">
        <a href="{{ route('resend.email.form') }}" class="text-sm text-emerald-500 hover:text-emerald-700 font-semibold">
          Kirim ulang email verifikasi
        </a>
      </div>

        <p class="mt-6 text-center text-gray-600">
          Belum memiliki akun?
          <a href="{{ route('register') }}" class="ml-1 text-emerald-500 hover:text-emerald-700 font-semibold">Sign up</a>
        </p>
      </form>
      <hr class="my-6 border-t border-gray-300">
      <div class="text-center">
        <a href="{{ route('login-admin') }}" class="border border-emerald-500 text-emerald-500 px-4 py-2 rounded text-center hover:bg-emerald-50 inline-flex items-center gap-2">
          Masuk sebagai Admin
        </a>
      </div>
    </div>
  </div>

  <!-- Kanan: Gambar -->
  <div class="w-full md:w-1/2 hidden md:block">
    <img src="{{ asset('img/kegiatan/al-quran.jpg') }}" alt="Login Image" class="object-cover w-full h-full">
  </div>

</div>

</body>
</html>
