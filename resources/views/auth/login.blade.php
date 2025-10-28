<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Coeciin Laundry</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-white">

  <!-- 🔹 Header -->
  <header class="w-full bg-sky-500 text-white py-4 px-8 flex items-center justify-between">
    <h1 class="text-2xl font-semibold tracking-wide ml-7">Coeciin</h1>
  </header>

  <!-- 🔹 Konten utama -->
  <main class="flex flex-1">
    <!-- Bagian kiri -->
    <div class="hidden md:flex w-1/2 relative">
      <img 
        src="{{ asset('images/laundry.jpg') }}" 
        alt="Laundry Background"
        class="object-cover w-full h-full brightness-75"
      />
      <div class="absolute inset-0 bg-black/0"></div>
      <div class="absolute inset-0 flex flex-col justify-start items-start px-15 pt-15">
        <h1 class="text-white text-5xl font-bold leading-snug drop-shadow-md">
          Kelola pesanan<br />dengan cepat,<br />pelanggan pun puas.
        </h1>
      </div>
    </div>

    <!-- Bagian kanan -->
    <div class="flex w-full md:w-1/2 items-center justify-center bg-white">
      <div class="max-w-md w-full p-8">
        <div class="text-center mb-8">
          <h2 class="text-4xl font-semibold text-gray-800">Login</h2>
        </div>

        @if ($errors->any())
          <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first() }}
          </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
          @csrf
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Username</label>
            <input 
              type="text" 
              name="username" 
              placeholder="Masukan username"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 placeholder:text-gray-400"
              required
            />
          </div>

          <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
            <input 
              type="password" 
              name="password" 
              placeholder="Masukan password"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 placeholder:text-gray-400"
              required
            />
          </div>

          <div class="text-left -mt-4">
            <a href="#" class="text-sm text-sky-500 hover:underline">Lupa password?</a>
          </div>

          <button 
            type="submit"
            class="w-full bg-sky-500 text-white py-2 rounded-lg font-medium hover:bg-sky-600 transition">
            Masuk
          </button>
        </form>

        <p class="text-gray-600 text-sm text-center mt-6">
          Belum punya akun?
          <a href="{{ route('register') }}" class="text-sky-500 hover:underline font-medium">Daftar di sini</a>
        </p>
      </div>
    </div>
  </main>

</body>
</html>