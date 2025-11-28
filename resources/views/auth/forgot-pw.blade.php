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
      <div class="relative">
        <label class="block text-sm font-bold text-gray-700 mb-1">Password Baru</label>
        <input 
          type="password"
          name="password"
          id="password"
          placeholder="Masukan password baru"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-gray-400"
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
      </div>

      <!-- KONFIRMASI -->
      <div class="relative">
        <label class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Password</label>
        <input 
          type="password"
          name="password_confirmation"
          id="password2"
          placeholder="Ulangi password"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 placeholder:text-gray-400"
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
        Reset Password
      </button>
    </form>

    <p class="text-gray-600 text-sm text-center mt-6">
      Kembali ke login?
      <a href="{{ route('login') }}" class="text-sky-500 hover:underline font-medium">Masuk di sini</a>
    </p>

  </div>

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
