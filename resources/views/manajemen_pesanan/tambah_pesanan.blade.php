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
                <p class="text-sm text-gray-500 mt-1">{{ isset($pesanan) ? 'Edit pesanan' : 'Tambah pesanan baru' }} ke sistem</p>
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
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Layanan<span class="text-red-500 ml-1">*</span></label>
                                <select name="jenis_layanan" id="jenis" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500">
                                    <option value="" disabled {{ !isset($pesanan) ? 'selected' : '' }}>Pilih jenis laundry</option>
                                    <option value="Satuan" {{ (isset($pesanan) && $pesanan->jenis_layanan == 'Satuan') ? 'selected' : '' }}>Satuan</option>
                                    <option value="Regular" {{ (isset($pesanan) && $pesanan->jenis_layanan == 'Regular') ? 'selected' : '' }}>Regular</option>
                                    <option value="Express" {{ (isset($pesanan) && $pesanan->jenis_layanan == 'Express') ? 'selected' : '' }}>Express</option>
                                    <option value="Super Express/Kilat" {{ (isset($pesanan) && $pesanan->jenis_layanan == 'Super Express/Kilat') ? 'selected' : '' }}>Super Express/Kilat</option>
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
                                <input type="text" id="total_harga" readonly
                                       placeholder="Otomatis terhitung"
                                       value="{{ $pesanan->total_harga ?? '' }}"
                                       class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-sm text-gray-700">
                                <input type="hidden" name="total_harga" id="total_harga_numeric" value="{{ $pesanan->total_harga ?? '' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran<span class="text-red-500 ml-1">*</span></label>
                                <select name="metode_pembayaran" required
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
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pembayaran<span class="text-red-500 ml-1">*</span></label>
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
    document.addEventListener('DOMContentLoaded', function() {
        const beratInput = document.getElementById('berat');
        const jenisSelect = document.getElementById('jenis');
        const totalHargaInput = document.getElementById('total_harga');
        const totalHargaInputNumeric = document.getElementById('total_harga_numeric');

        const hargaPerJenis = {
            "Satuan": 10000,
            "Regular": 7000,
            "Express": 10000,
            "Super Express/Kilat": 12000
        };

        function hitungTotal() {
            const berat = parseFloat(beratInput.value) || 0;
            const jenis = jenisSelect.value;
            const harga = hargaPerJenis[jenis] || 0;
            const total = berat * harga;

            totalHargaInput.value = total > 0 ? 'Rp ' + total.toLocaleString('id-ID') : '';
            totalHargaInputNumeric.value = total;
        }

        beratInput.addEventListener('input', hitungTotal);
        jenisSelect.addEventListener('change', hitungTotal);

        // jika edit, langsung hitung total awal
        if(beratInput.value && jenisSelect.value){
            hitungTotal();
        }
    });
    </script>
</body>
</html>
