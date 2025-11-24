<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lupa Password | Coeciin Laundry</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- FULL BACKGROUND IMAGE -->
<body 
  class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center"
  style="background-image: url('{{ asset('fogot.png') }}');"
>

  <!-- OVERLAY GELAP -->
  <div class="absolute inset-0 bg-black bg-opacity-50"></div>

  <!-- MODAL FORM -->
  <div class="relative z-10 w-full max-w-md bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-xl">

    <div class="text-center mb-8">
      <h2 class="text-4xl font-semibold text-gray-800">Lupa Password?</h2>
      <p class="text-gray-600 mt-2">Masukkan email & buat password baru.</p>
    </div>

    <!-- Success -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded-lg text-green-700">
            ✔️ {{ session('success') }}
        </div>
    @endif

    <!-- Errors -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-300 rounded-lg text-red-700">
            ⚠️ {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
      @csrf

      <!-- EMAIL -->
      <div>
        <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
        <input 
          type="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Masukan email yang terdaftar"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-gray-400"
          required
        />
      </div>

      <!-- PASSWORD BARU -->
      <div>
        <label class="block text-sm font-bold text-gray-700 mb-1">Password Baru</label>
        <input 
          type="password"
          name="password"
          placeholder="Masukan password baru"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-gray-400"
          required
        />
      </div>

      <!-- KONFIRMASI -->
      <div>
        <label class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Password</label>
        <input 
          type="password"
          name="password_confirmation"
          placeholder="Ulangi password"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-gray-400"
          required
        />
      </div>

      <button 
        type="submit"
        class="w-full bg-sky-500 text-white py-2 rounded-lg font-medium hover:bg-sky-600 transition">
        Reset Password
      </button>
    </form>

    <p class="text-gray-600 text-sm text-center mt-6">
      Kembali ke login?
      <a href="{{ route('login') }}" class="text-sky-500 hover:underline font-medium">Masuk di sini</a>
    </p>

  </div>

</body>
</html>
