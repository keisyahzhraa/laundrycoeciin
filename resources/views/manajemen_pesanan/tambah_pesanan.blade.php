<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah/Update Pesanan - Coociin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body style="background-color: #EFFCFF;">
    @include('layouts.sidebar')
    @include('layouts.navbar')

    <main id="mainContent" class="transition-all duration-300 ease-in-out pt-20" style="margin-left: 16rem;">
        <div class="p-8">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Pesanan</h1>
                <p class="text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-xl flex items-center gap-2 mt-1">
                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 016 6v3l1.293 1.293a1 1 0 01-1.414 1.414L15 12.414V8a5 5 0 10-10 0v4.414l-.879.879a1 1 0 01-1.414-1.414L4 11V8a6 6 0 016-6z"/>
                        <path d="M5 15a5 5 0 0010 0h-2a3 3 0 11-6 0H5z"/>
                    </svg>

                    {{ isset($pesanan) 
                        ? 'Ubah data pesanan yang sudah ada.' 
                        : 'Tambah data pesanan baru ke sistem.' 
                    }}
                </p>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl p-10 border border-gray-100">
                <form action="{{ isset($pesanan) ? route('pesanan.update', $pesanan->id_pesanan) : route('pesanan.store') }}" method="POST" id="formPesanan">
                    @csrf
                    @if(isset($pesanan))
                        @method('PUT')
                    @endif

                    <!-- Identitas Pembeli -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h4 class="text-lg font-bold text-gray-900 mb-6">Identitas Pembeli</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan<span class="text-red-500 ml-1">*</span></label>
                                <input type="text" name="nama_pelanggan" placeholder="Masukkan nama pelanggan" required
                                       value="{{ $pesanan->nama_pelanggan ?? old('nama_pelanggan') }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon (opsional)</label>
                                <input type="text" name="nomor_telephone" placeholder="Masukkan nomor telepon"
                                       value="{{ $pesanan->nomor_telephone ?? old('nomor_telephone') }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Detail Pesanan -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h4 class="text-lg font-bold text-gray-900 mb-6">Detail Pesanan</h4>

                        <!-- Barang, Berat, Jenis Layanan -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Barang Laundry<span class="text-red-500 ml-1">*</span></label>
                                <select name="barang_laundry" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500">
                                    <option value="" disabled {{ !isset($pesanan) ? 'selected' : '' }}>Pilih barang laundry</option>
                                    <option value="pakaian" {{ (isset($pesanan) && $pesanan->barang_laundry == 'pakaian') ? 'selected' : '' }}>Pakaian</option>
                                    <option value="sepatu" {{ (isset($pesanan) && $pesanan->barang_laundry == 'sepatu') ? 'selected' : '' }}>Sepatu</option>
                                    <option value="celana" {{ (isset($pesanan) && $pesanan->barang_laundry == 'celana') ? 'selected' : '' }}>Celana</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Berat (kg)<span class="text-red-500 ml-1">*</span></label>
                                <input type="number" step="0.1" name="berat_cucian" id="berat" placeholder="Masukkan berat laundry" required
                                       value="{{ $pesanan->berat_cucian ?? old('berat_cucian') }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                    Jenis Layanan<span class="text-red-500">*</span>

                                    <!-- Tombol Premium -->
                                    <button type="button"
                                            onclick="openModalHarga()"
                                            class="p-1 text-gray-700 hover:text-black transition">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            class="w-5 h-5">
                                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 000-1.42l-2.34-2.34a1.003 1.003 0 00-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                        </svg>
                                    </button>
                                </label>

                                <select name="id_layanan" id="id_layanan" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500">

                                    <option value="" disabled {{ !isset($pesanan) ? 'selected' : '' }}>Pilih jenis laundry</option>

                                    @foreach ($layanans as $layanan)
                                        <option value="{{ $layanan->id_layanan }}"
                                            {{ isset($pesanan) && $pesanan->id_layanan == $layanan->id_layanan ? 'selected' : '' }}>
                                            {{ $layanan->jenis_layanan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tanggal Pesanan, Tanggal Selesai, Status Pesanan -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pesanan<span class="text-red-500 ml-1">*</span></label>
                                <input type="datetime-local" name="tanggal_pesanan" required
                                       value="{{ isset($pesanan) ? date('Y-m-d\TH:i', strtotime($pesanan->tanggal_pesanan)) : '' }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai<span class="text-red-500 ml-1">*</span></label>
                                <input type="datetime-local" name="tanggal_selesai" required
                                       value="{{ isset($pesanan) && $pesanan->tanggal_selesai ? date('Y-m-d\TH:i', strtotime($pesanan->tanggal_selesai)) : '' }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Pesanan<span class="text-red-500 ml-1">*</span></label>
                                <select name="status_pesanan" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500">
                                    <option value="" disabled {{ !isset($pesanan) ? 'selected' : '' }}>Pilih status</option>
                                    <option value="Pending" {{ (isset($pesanan) && $pesanan->status_pesanan == 'Pending') ? 'selected' : '' }}>Pending</option>
                                    <option value="Proses" {{ (isset($pesanan) && $pesanan->status_pesanan == 'Proses') ? 'selected' : '' }}>Proses</option>
                                    <option value="Selesai" {{ (isset($pesanan) && $pesanan->status_pesanan == 'Selesai') ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Pembayaran -->
                    <div class="mb-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-6">Pembayaran</h4>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Total Harga<span class="text-red-500 ml-1">*</span></label>
                                <input type="text" id="total_harga_display"
                                    name="total_harga_display"
                                    placeholder="Isi manual atau otomatis"
                                    class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-sm text-gray-700">

                                <input type="hidden" name="total_harga" id="total_harga"
                                    value="{{ $pesanan->total_harga ?? '' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran</label>
                                <select name="metode_pembayaran"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500">
                                    <option value="" disabled {{ !isset($pesanan) ? 'selected' : '' }}>Pilih metode pembayaran</option>
                                    <option value="Cash" {{ (isset($pesanan) && $pesanan->metode_pembayaran == 'Cash') ? 'selected' : '' }}>Cash</option>
                                    <option value="Transfer" {{ (isset($pesanan) && $pesanan->metode_pembayaran == 'Transfer') ? 'selected' : '' }}>Transfer</option>
                                    <option value="E-wallet" {{ (isset($pesanan) && $pesanan->metode_pembayaran == 'E-wallet') ? 'selected' : '' }}>E-Wallet</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Pembayaran<span class="text-red-500 ml-1">*</span></label>
                                <select name="status_pembayaran" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500">
                                    <option value="" disabled {{ !isset($pesanan) ? 'selected' : '' }}>Status pembayaran</option>
                                    <option value="Belum Lunas" {{ (isset($pesanan) && $pesanan->status_pembayaran == 'Belum Lunas') ? 'selected' : '' }}>Belum Lunas</option>
                                    <option value="Lunas" {{ (isset($pesanan) && $pesanan->status_pembayaran == 'Lunas') ? 'selected' : '' }}>Lunas</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pembayaran</label>
                                <input type="datetime-local" name="tanggal_pembayaran"
                                       value="{{ isset($pesanan) && $pesanan->tanggal_pembayaran ? date('Y-m-d\TH:i', strtotime($pesanan->tanggal_pembayaran)) : '' }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 pt-6 border-t-2 border-gray-200">
                        <button type="reset"
                                class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200">
                            Reset
                        </button>
                        <button type="submit"
                                class="px-8 py-3 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600 flex items-center">
                            {{ isset($pesanan) ? 'Update Pesanan' : 'Tambah Pesanan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const berat = document.getElementById('berat');
        const idLayanan = document.getElementById('id_layanan');
        const totalDisplay = document.getElementById('total_harga_display');
        const totalReal = document.getElementById('total_harga');

            // Saat edit form, tampilkan total harga lama
        if (totalReal.value) {
            totalDisplay.value = "Rp " + Number(totalReal.value).toLocaleString('id-ID');
        }

        function hitungTotal() {
            if (!berat.value || !idLayanan.value) return;

            fetch("{{ route('pesanan.hitung_harga') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    berat_cucian: berat.value,
                    id_layanan: idLayanan.value
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    totalDisplay.value = "Rp " + data.total_harga.toLocaleString('id-ID');
                    totalReal.value = data.total_harga;
                }
            });
        }

        berat.addEventListener("input", hitungTotal);
        idLayanan.addEventListener("change", hitungTotal);

        totalDisplay.addEventListener("input", () => {
            let angka = totalDisplay.value.replace(/[^0-9]/g, '');
            totalReal.value = angka === "" ? "" : angka;
        });
    });
    </script>

    <script>
    function openModalHarga() {
        document.getElementById('modalHarga').classList.remove('hidden');
    }

    function closeModalHarga() {
        document.getElementById('modalHarga').classList.add('hidden');
    }
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const form = document.getElementById("formPesanan");
        const inputDisplay = document.getElementById("total_harga_display");
        const inputHidden  = document.getElementById("total_harga");

        // === Membuat elemen warning ===
        let warningText = document.createElement("p");
        warningText.className = "text-red-500 text-xs mt-1 hidden";
        warningText.innerText = "Cukup tuliskan angka saja.";
        inputDisplay.insertAdjacentElement("afterend", warningText);

        // === Hapus semua selain angka ===
        function cleanNumber(str) {
            return str.replace(/[^0-9]/g, "");
        }

        // === Format Rp. 999.999 ===
        function formatRupiah(angka) {
            return "Rp " + angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // === EVENT INPUT (langsung format saat user mengetik) ===
        inputDisplay.addEventListener("input", function () {
            let raw = cleanNumber(this.value);

            // Jika user masukkan karakter selain angka
            if (this.value.match(/[^0-9]/)) {
                warningText.classList.remove("hidden");
            } else {
                warningText.classList.add("hidden");
            }

            if (raw.length === 0) {
                this.value = "";
                inputHidden.value = "";
                return;
            }

            this.value = formatRupiah(raw);
            inputHidden.value = raw;
        });

        // === 🔥 VALIDASI SUBMIT (Bagian penting agar form tidak lolos submit) ===
        form.addEventListener("submit", function (e) {

            let raw = inputHidden.value;

            // 1. Tidak boleh kosong
            if (!raw || raw.length === 0) {
                e.preventDefault();
                alert("Total harga tidak boleh kosong.");
                return;
            }

            // 2. Tidak boleh lebih dari 8 digit (sesuai DECIMAL(10,2))
            if (raw.length > 8) {
                e.preventDefault();
                alert("Total harga terlalu besar. Maksimal 8 digit angka.");
                return;
            }

            // 3. Jika display mengandung karakter ilegal
            if (inputDisplay.value.match(/[^0-9\.Rp\s]/)) {
                e.preventDefault();
                alert("Format total harga salah. Cukup tuliskan angka saja.");
                return;
            }
        });

    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const statusBayar = document.querySelector("select[name='status_pembayaran']");
        const metodeBayar = document.querySelector("select[name='metode_pembayaran']");
        const tanggalBayar = document.querySelector("input[name='tanggal_pembayaran']");

        // === RULE 1: Jika tanggal pembayaran dipilih → set status = Lunas + metode wajib terisi ===
        tanggalBayar.addEventListener("change", function () {
            if (tanggalBayar.value) {

                statusBayar.value = "Lunas";

                if (!metodeBayar.value) {
                    alert("Silakan pilih metode pembayaran karena tanggal pembayaran sudah diisi.");
                    metodeBayar.focus();
                }
            }
        });

        // === RULE 2: Jika status pembayaran = Lunas → tanggal & metode harus dipilih ===
        // === VALIDASI SAAT SUBMIT ===
        const form = tanggalBayar.closest("form");

        form.addEventListener("submit", function (e) {

            // Jika status Lunas → tanggal & metode wajib
            if (statusBayar.value === "Lunas") {

                if (!tanggalBayar.value) {
                    e.preventDefault();
                    alert("Tanggal pembayaran wajib diisi karena status Lunas.");
                    tanggalBayar.focus();
                    return;
                }

                if (!metodeBayar.value) {
                    e.preventDefault();
                    alert("Metode pembayaran wajib diisi karena status Lunas.");
                    metodeBayar.focus();
                    return;
                }
            }
        });

        // === RULE 3: Jika status masih Belum Lunas → hapus tanggal & hapus metode ===
        statusBayar.addEventListener("change", function () {
            if (statusBayar.value === "Belum Lunas") {
                tanggalBayar.value = "";
                metodeBayar.value = "";
            }
        });

        // === RULE 4: Jika metode pembayaran diisi tapi status Belum Lunas → kembalikan kosong ===
        metodeBayar.addEventListener("change", function () {
            if (statusBayar.value === "Belum Lunas" && metodeBayar.value !== "") {
                alert("Tidak bisa memilih metode karena status pembayaran masih Belum Lunas.");
                metodeBayar.value = ""; // reset pilihan
            }
        });

    });
    </script>

    <div id="modalHarga"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center hidden z-50">

        <div class="bg-white w-[420px] rounded-3xl shadow-2xl p-6 animate-fadeIn">

            <!-- Header -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-blue-500 leading-tight">
                    Update Harga<br>Layanan Laundry
                </h2>
            </div>

            <form action="{{ route('layanan.update') }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ($layanans as $layanan)
                    <div class="mb-5">

                        <label class="block text-gray-700 font-semibold mb-1">
                            {{ $layanan->jenis_layanan }}
                        </label>

                        <input type="number"
                            name="harga[{{ $layanan->id_layanan }}][harga_per_kg]"
                            value="{{ $layanan->harga_per_kg }}"
                            class="w-full border p-3 rounded-xl"
                            required>

                        <input type="hidden"
                            name="harga[{{ $layanan->id_layanan }}][id_layanan]"
                            value="{{ $layanan->id_layanan }}">
                    </div>
                @endforeach

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button"
                        onclick="closeModalHarga()"
                        class="px-5 py-2 bg-gray-200 rounded-xl hover:bg-gray-300">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-5 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <style>
    @keyframes fadeIn {
        0% { opacity: 0; transform: scale(0.95); }
        100% { opacity: 1; transform: scale(1); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.25s ease-out;
    }
    </style>

</body>
</html>
