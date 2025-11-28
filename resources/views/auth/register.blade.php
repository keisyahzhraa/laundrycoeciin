<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | Coeciin Laundry</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen overflow-hidden">

  <!-- 🔹 Header -->
  <header class="w-full bg-sky-500 text-white py-4 px-8 flex items-center justify-between flex-none">
    <h1 class="text-2xl font-semibold tracking-wide ml-7">Coeciin</h1>
  </header>

  <!-- 🔹 Konten utama -->
   <main class="flex flex-1 h-full overflow-hidden">
    <!-- Bagian kiri -->
    <div class="hidden md:flex w-1/2 relative h-full overflow-hidden">
      <img 
        src="{{ asset('regist.png') }}" 
        alt="Laundry Background"
        class="object-cover w-full h-full brightness-75"
      />
      <div class="absolute inset-0 flex flex-col justify-start items-start px-15 pt-12">
        <h1 class="text-white text-5xl font-bold ml-11 -mt-4 leading-tight leading-snug drop-shadow-md">
          Daftarkan akun<br />adminmu dan mulai<br />kelola laundry dengan<br />lebih mudah
        </h1>
      </div>
    </div>

    <!-- Bagian kanan -->
    <div class="flex w-full md:w-1/2 items-center justify-center bg-white overflow-hidden">
      <div class="max-w-md w-full p-8">
        <div class="text-center mb-8">
          <h2 class="text-4xl font-semibold text-gray-800">Register</h2>
        </div>

        @if ($errors->any())
          <div class="mb-6 p-4 bg-red-100 border border-red-300 rounded-xl text-red-700 shadow-sm animate-[fadeIn_0.3s_ease-out]">
              <div class="flex items-center mb-2">
                  <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14" />
                  </svg>
                  <h3 class="font-semibold text-lg">Terjadi beberapa kesalahan:</h3>
              </div>

              <ul class="list-disc pl-6 space-y-1">
                  @foreach ($errors->all() as $error)
                      <li class="text-sm">{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-6">
          @csrf
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Username</label>
            <input 
              type="text" 
              name="username" 
              value="{{ old('username') }}"
              placeholder="Masukan username"
              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 
                    {{ $errors->has('username') ? 'border-red-500 focus:ring-red-400' : 'border-gray-300 focus:ring-sky-400' }}"
              required
            />
            @error('username')
                <p class="mt-1 text-red-600 text-sm flex items-center">
                    ⚠️ <span class="ml-1">{{ $message }}</span>
                </p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
            <input 
              type="email" 
              name="email" 
              value="{{ old('email') }}"
              placeholder="Masukan email"
              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 
                    {{ $errors->has('email') ? 'border-red-500 focus:ring-red-400' : 'border-gray-300 focus:ring-sky-400' }}"
              required
            />
            @error('email')
                <p class="mt-1 text-red-600 text-sm flex items-center">
                    ⚠️ <span class="ml-1">{{ $message }}</span>
                </p>
            @enderror
          </div>

          <div class="relative">
            <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
            <input 
              type="password" 
              name="password" 
              id="password"
              placeholder="Masukan password"
              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 
                    {{ $errors->has('password') ? 'border-red-500 focus:ring-red-400' : 'border-gray-300 focus:ring-sky-400' }}"
              required
            />

            <!-- Toggle Icon -->
            <span id="togglePassword" 
                  class="absolute inset-y-0 right-3 top-1/3 flex text-gray-500 items-center cursor-pointer">
                
              <!-- OPEN -->
              <svg id="iconOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 
                      9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>

              <!-- CLOSED -->
              <svg id="iconClosed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
                      a9.97 9.97 0 012.231-3.568M6.59 6.59A9.953 9.953 0 0112 5c4.477 0 
                      8.268 2.943 9.542 7a9.97 9.97 0 01-1.11 2.528M3 3l18 18" />
              </svg>
            </span>

            @error('password')
                <p class="mt-1 text-red-600 text-sm flex items-center">
                    ⚠️ <span class="ml-1">{{ $message }}</span>
                </p>
            @enderror
          </div>

            <!-- CONFIRM PASSWORD -->
          <div class="relative">
            <label class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Password</label>
            <input 
              type="password"
              name="password_confirmation"
              id="password2"
              placeholder="Ulangi password"
              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400"
              required
            />

            <!-- Toggle Icon -->
            <span id="togglePassword2" 
                  class="absolute inset-y-0 right-3 top-1/3 flex text-gray-500 items-center cursor-pointer">

              <!-- OPEN -->
              <svg id="iconOpen2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 
                      9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>

              <!-- CLOSED -->
              <svg id="iconClosed2" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
                      a9.97 9.97 0 012.231-3.568M6.59 6.59A9.953 9.953 0 0112 5c4.477 0 
                      8.268 2.943 9.542 7a9.97 9.97 0 01-1.11 2.528M3 3l18 18" />
              </svg>
            </span>
          </div>

          <button 
            type="submit"
            class="w-full bg-sky-500 text-white py-2 rounded-lg font-medium hover:bg-sky-600 transition">
            Daftar
          </button>
        </form>

        <p class="text-gray-600 text-sm text-center mt-6">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="text-sky-500 hover:underline font-medium">Masuk di sini</a>
        </p>
      </div>
    </div>
  </main>

  <script>
  function setupToggle(inputId, toggleId, openId, closedId) {
      const input = document.getElementById(inputId);
      const toggle = document.getElementById(toggleId);
      const openIcon = document.getElementById(openId);
      const closedIcon = document.getElementById(closedId);
      const toggleBtn = document.getElementById("togglePassword");
      const toggleBtn2 = document.getElementById("togglePassword2");

      // Sembunyikan icon awalnya
    toggleBtn.style.display = "none";
    toggleBtn2.style.display = "none";

      input.addEventListener("input", function () {
          toggle.style.display = this.value.length > 0 ? "flex" : "none";
          if (this.value.length === 0) {
              input.type = "password";
              openIcon.classList.remove("hidden");
              closedIcon.classList.add("hidden");
          }
      });

      toggle.addEventListener("click", function () {
          const isHidden = input.type === "password";
          input.type = isHidden ? "text" : "password";
          openIcon.classList.toggle("hidden", isHidden);
          closedIcon.classList.toggle("hidden", !isHidden);
      });
  }

  setupToggle("password", "togglePassword", "iconOpen", "iconClosed");
  setupToggle("password2", "togglePassword2", "iconOpen2", "iconClosed2");
  </script>

  <style>
    input::-ms-reveal,
  input::-ms-clear {
      display: none !important;
  }

  input[type="password"]::-webkit-textfield-decoration-container {
      display: none !important;
  }
  </style>

</body>
</html>