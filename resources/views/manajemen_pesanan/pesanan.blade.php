<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Coeciin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
</head>
<body style="background-color: #EFFCFF;">

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div id="mainContent" class="transition-all duration-300 ease-in-out" style="margin-left: 16rem;">

        <!-- Navbar -->
        @include('layouts.navbar')

        <div class="p-4 md:p-8" style="margin-top: 5rem;">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Manajemen Pesanan</h1>
                <p class="text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-xl flex items-center gap-2">
    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 2a6 6 0 016 6v3l1.293 1.293a1 1 0 01-1.414 1.414L15 12.414V8a5 5 0 10-10 0v4.414l-.879.879a1 1 0 01-1.414-1.414L4 11V8a6 6 0 016-6z"/>
        <path d="M5 15a5 5 0 0010 0h-2a3 3 0 11-6 0H5z"/>
    </svg>
    Kelola pesanan laundry Anda dengan cepat, rapi, dan efisien!
</p>


            </div>

            <!-- Notifikasi sukses -->
            @if (session('success'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 transition-all duration-500"
                >
                    {{ session('success') }}
                </div>
            @endif

            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

                <!-- Card Header -->
                <div class="px-4 md:px-8 py-6 border-b-2 border-gray-100 bg-white flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">List Pesanan</h2>
                            <p class="text-sm text-gray-500 mt-0.5">
                                Total {{ $pesanans->where('status_pesanan', '!=', 'Selesai')->count() }} pesanan belum selesai
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                        {{-- <form method="GET" action="{{ route('pesanan.daftar') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto"> --}}
                        <!-- Filter Bulan & Tahun -->
                        <form id="filterForm" method="GET" action="{{ route('pesanan.daftar') }}">
                            <div class="mb-1">
                                <label class="text-xs font-semibold text-gray-600">Filter Bulan & Tahun</label>
                            </div>

                            <div class="relative w-full">
                                <input type="text"
                                    id="monthYearPicker"
                                    name="filter_bulan_tahun"
                                    placeholder="Pilih Bulan & Tahun"
                                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm cursor-pointer focus:ring-2 focus:ring-blue-400"
                                    value="{{ request('filter_bulan_tahun') ?? '' }}"
                                    readonly>
                            </div>
                        </form>

                        <!-- Tombol tambah -->
                        <a href="{{ route('pesanan.tambah') }}"
                           class="px-6 py-3 bg-blue-500 text-white rounded-xl text-sm font-semibold hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Pesanan
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto overflow-y-auto" style="max-height: 600px;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Nama Pelanggan</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Barang Laundry</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Tanggal Masuk</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Tanggal Selesai</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Jenis Layanan</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Total Berat</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Total Harga</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">
                                    <form id="filterStatusForm" method="GET" action="{{ route('pesanan.daftar') }}">
                                        
                                        <!-- Pertahankan filter bulan-tahun -->
                                        @if (request('filter_bulan_tahun'))
                                            <input type="hidden" name="filter_bulan_tahun" value="{{ request('filter_bulan_tahun') }}">
                                        @endif

                                        <select name="status_pesanan"
                                            class="text-xs font-semibold bg-white border border-gray-300 rounded-lg px-2 py-1 focus:ring-blue-400 cursor-pointer"
                                            onchange="document.getElementById('filterStatusForm').submit()">

                                            <option value="">Semua Status</option>
                                            <option value="Pending" {{ request('status_pesanan')=='Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Proses" {{ request('status_pesanan')=='Proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="Selesai" {{ request('status_pesanan')=='Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                </th>
                                <th class="px-4 md:px-6 py-4 text-center text-xs font-bold text-gray-700 tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($pesanans as $pesanan)
                                <tr class="hover:bg-gray-50 transition-all duration-200">
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $pesanan->nama_pelanggan }}</td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-lg">
                                            {{ ucfirst($pesanan->barang_laundry) }}
                                        </span>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ date('d/m/Y', strtotime($pesanan->tanggal_pesanan)) }}</td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $pesanan->tanggal_selesai ? date('d/m/Y', strtotime($pesanan->tanggal_selesai)) : '-' }}</td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                        @php
                                            $jenisLayananColors = [
                                                ''   => 'bg-blue-100 text-blue-700',
                                                'Satuan'  => 'bg-green-100 text-green-700',
                                                'Regular'  => 'bg-yellow-100 text-yellow-700',
                                                'Express'       => 'bg-purple-100 text-purple-700',
                                                'Super Express/Kilat'     => 'bg-red-100 text-red-700',
                                            ];
                                            $warna = $jenisLayananColors[$pesanan->layanan->jenis_layanan] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span class="px-3 py-1 text-xs font-medium rounded-lg {{ $warna }}">
                                            {{ $pesanan->layanan->jenis_layanan ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pesanan->berat_cucian }} kg</td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'Pending' => 'bg-red-100 text-red-800',
                                                'Proses' => 'bg-blue-100 text-blue-800',
                                                'Selesai' => 'bg-green-100 text-green-800',
                                            ];
                                        @endphp
                                        <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full shadow-sm {{ $statusColors[$pesanan->status_pesanan] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $pesanan->status_pesanan }}
                                        </span>
                                    </td>
                                    {{-- <td class="px-4 md:px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ route('pesanan.edit', $pesanan->id_pesanan) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>

                                        <form action="{{ route('pesanan.destroy', $pesanan->id_pesanan) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus pesanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td> --}}
                                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center justify-center space-x-2">
                                            {{-- Tombol Edit (optional, bisa dikosongkan atau di-link ke edit jika mau) --}}
                                            <a href="{{ route('pesanan.edit', $pesanan->id_pesanan) }}"
                                                class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-100 rounded-lg transition-all duration-200 group">
                                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('pesanan.destroy', $pesanan->id_pesanan) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus pesanan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200 group">
                                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-6 text-gray-500">Belum ada pesanan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-6 flex justify-center">
                        <!-- Pagination custom langsung di view -->
                        @if ($pesanans->hasPages())
                            <nav>
                                <ul class="inline-flex items-center space-x-1">

                                    {{-- Previous --}}
                                    @if ($pesanans->onFirstPage())
                                        <li class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            Previous
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ $pesanans->previousPageUrl() }}"
                                            class="px-3 py-2 bg-white border border-gray-300 rounded-lg hover:bg-blue-100">
                                                Previous
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Page Numbers --}}
                                    @foreach ($pesanans->links()->elements[0] as $page => $url)
                                        @if ($page == $pesanans->currentPage())
                                            <li class="px-3 py-2 text-white bg-blue-600 rounded-lg border border-blue-600">
                                                {{ $page }}
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $url }}"
                                                class="px-3 py-2 bg-white border border-gray-300 rounded-lg hover:bg-blue-100">
                                                    {{ $page }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next --}}
                                    @if ($pesanans->hasMorePages())
                                        <li>
                                            <a href="{{ $pesanans->nextPageUrl() }}"
                                            class="px-3 py-2 bg-white border border-gray-300 rounded-lg hover:bg-blue-100">
                                                Next
                                            </a>
                                        </li>
                                    @else
                                        <li class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            Next
                                        </li>
                                    @endif

                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
    flatpickr("#monthYearPicker", {
    plugins: [
        new monthSelectPlugin({
            shorthand: true,
            dateFormat: "m/Y",
            altFormat: "F Y"
        })
    ],
        locale: "id",
        onChange: function(selectedDates, dateStr, instance) {
            // submit form saat tanggal/bulan dipilih
            document.getElementById('filterForm').submit();

        }
    });

    </script>

</body>
</html>
