<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengeluaran - Coeciin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body style="background-color: #EFFCFF;">

    @include('layouts.sidebar')

    <div id="mainContent" class="transition-all duration-300 ease-in-out" style="margin-left: 16rem;">

        @include('layouts.navbar')

        <div class="p-4 md:p-8" style="margin-top: 5rem;">

            <!-- TITLE -->
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Manajemen Pengeluaran</h1>
                <p class="text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-xl flex items-center gap-2">
                    Kelola seluruh pengeluaran bisnis Anda secara terstruktur.
                </p>
            </div>

            <!-- SUCCESS NOTIF -->
            @if (session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50">
                    
                    {{ session('success') }}
                </div>
            @endif

            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

                <!-- CARD HEADER -->
                <div class="px-6 py-6 border-b flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 bg-white">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center mr-4 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Daftar Pengeluaran</h2>
                            <p class="text-sm text-gray-500 mt-1">
                                @if($isFilterActive)
                                    Total {{ $totalPerBulan }} pencatatan pada bulan yang difilter
                                @else
                                    Total {{ $totalPerBulan }} pencatatan bulan ini
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                        {{-- <form method="GET" action="{{ route('pengeluaran.daftar') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto"> --}}
                        <!-- Filter Bulan & Tahun -->
                        <form id="filterForm" method="GET" action="{{ route('pengeluaran.daftar') }}">
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
                        <a href="{{ route('pengeluaran.tambah') }}"
                           class="px-6 py-3 bg-blue-500 text-white rounded-xl text-sm font-semibold hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Pengeluaran
                        </a>
                    </div>
                </div>    
                <!-- TABLE -->
                <div class="overflow-x-auto overflow-y-auto" style="max-height: 600px;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-700 text-left">Tanggal</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-700 text-left">Kategori</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-700 text-left">Nominal</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-700 text-left">Penerima</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-700 text-center">Bukti</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-700 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($pengeluarans as $item)
                                <tr class="hover:bg-gray-50">

                                    <!-- Tanggal -->
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $item->tanggal->format('d/m/Y') }}
                                    </td>

                                    <!-- Kategori -->
                                    <td class="px-6 py-4 text-sm font-semibold">
                                        {{ ucfirst(str_replace('_',' ',$item->kategori)) }}
                                    </td>

                                    <!-- Nominal -->
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                        Rp{{ number_format($item->nominal, 0, ',', '.') }}
                                    </td>

                                    <!-- Penerima -->
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $item->penerima }}
                                    </td>

                                    <!-- Bukti -->
                                    <td class="px-6 py-4 text-center">
                                        @if($item->bukti_pengeluaran)
                                            <button onclick="showBukti('{{ asset('storage/' . $item->bukti_pengeluaran) }}')"
                                                class="text-blue-600 hover:bg-blue-100 p-2 rounded-lg">
                                                <svg class="w-5 h-5" stroke="currentColor" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 
                                                        4.057-5.065 7-9.542 7-4.477 
                                                        0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>

                                    <!-- ACTION ICONS -->
                                    <td class="px-6 py-4 text-center flex gap-3 justify-center">

                                        <!-- Detail -->
                                        <button onclick='showDetail(@json($item))'
                                            class="text-gray-600 hover:bg-gray-100 p-2 rounded-lg">
                                            <svg class="w-5 h-5" stroke="currentColor" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 
                                                    0 8.268 2.943 9.542 7-1.274 
                                                    4.057-5.065 7-9.542 7-4.477 
                                                    0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>

                                        <!-- Edit -->
                                        <a href="{{ route('pengeluaran.edit', $item->id_pengeluaran) }}"
                                            class="text-blue-600 hover:bg-blue-100 p-2 rounded-lg">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <!-- Delete -->
                                        <form method="POST"
                                            action="{{ route('pengeluaran.destroy', $item->id_pengeluaran) }}"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    class="delete-btn text-red-600 hover:bg-red-100 p-2 rounded-lg">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-500">Belum ada data pengeluaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-6 flex justify-center">
                        <!-- Pagination custom langsung di view -->
                        @if ($pengeluarans->hasPages())
                            <nav>
                                <ul class="inline-flex items-center space-x-1">

                                    {{-- Previous --}}
                                    @if ($pengeluarans->onFirstPage())
                                        <li class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            Previous
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ $pengeluarans->previousPageUrl() }}"
                                            class="px-3 py-2 bg-white border border-gray-300 rounded-lg hover:bg-blue-100">
                                                Previous
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Page Numbers --}}
                                    @foreach ($pengeluarans->links()->elements[0] as $page => $url)
                                        @if ($page == $pengeluarans->currentPage())
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
                                    @if ($pengeluarans->hasMorePages())
                                        <li>
                                            <a href="{{ $pengeluarans->nextPageUrl() }}"
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

    <!-- MODAL BUKTI -->
    <div id="modalBukti"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
        <div class="bg-white p-4 rounded-lg shadow-xl max-w-lg w-full relative">
            <button onclick="closeBukti()" class="absolute top-2 right-3 text-gray-500 text-xl">×</button>
            <img id="buktiImage" class="max-h-[450px] mx-auto rounded shadow">
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div id="modalDetail"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
        <div class="bg-white p-6 rounded-xl shadow-xl max-w-lg w-full relative">

            <button onclick="closeDetail()" class="absolute top-2 right-3 text-gray-500 text-xl">×</button>

            <h2 class="text-xl font-bold text-center mb-4">Detail Pengeluaran</h2>

            <div class="space-y-2 text-sm">
                <p><strong>Penerima:</strong> <span id="detailPenerima"></span></p>
                <p><strong>Tanggal:</strong> <span id="detailTanggal"></span></p>
                <p><strong>Nominal:</strong> Rp<span id="detailNominal"></span></p>
                <p><strong>Kategori:</strong> <span id="detailKategori"></span></p>
                <p><strong>Metode:</strong> <span id="detailMetode"></span></p>
                <p><strong>Keterangan:</strong> <span id="detailKeterangan"></span></p>

                <div class="pt-3">
                    <p class="font-semibold text-center">Bukti Pengeluaran:</p>
                    <img id="detailBukti" class="max-h-[300px] mx-auto border rounded shadow">
                </div>
            </div>
        </div>
    </div>

    <script>
        function showBukti(src) {
            document.getElementById("buktiImage").src = src;
            modalBukti.classList.remove("hidden");
            modalBukti.classList.add("flex");
        }

        function closeBukti() {
            modalBukti.classList.add("hidden");
            modalBukti.classList.remove("flex");
        }

        function showDetail(data) {
            document.getElementById("detailPenerima").textContent = data.penerima;
            document.getElementById("detailTanggal").textContent = new Date(data.tanggal).toLocaleDateString('id-ID');
            document.getElementById("detailNominal").textContent = Number(data.nominal).toLocaleString('id-ID');
            document.getElementById("detailKategori").textContent = data.kategori.replace('_',' ');
            document.getElementById("detailMetode").textContent = data.metode_pembayaran ?? "-";
            document.getElementById("detailKeterangan").textContent = data.keterangan ?? "-";

            // 🔵 PERUBAHAN
            if (data.bukti_pengeluaran)
                document.getElementById("detailBukti").src = "{{ asset('storage') }}/" + data.bukti_pengeluaran;
            else
                document.getElementById("detailBukti").src = "";
        
            modalDetail.classList.remove("hidden");
            modalDetail.classList.add("flex");
        }

        function closeDetail() {
            modalDetail.classList.add("hidden");
            modalDetail.classList.remove("flex");
        }
        
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

        document.addEventListener("DOMContentLoaded", () => {

            const deleteButtons = document.querySelectorAll(".delete-btn");

            deleteButtons.forEach(btn => {
                btn.addEventListener("click", function () {

                    let form = this.closest("form");

                    Swal.fire({
                        title: 'Hapus Pengeluaran?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });
            });
        });
    </script>
</body>
</html>
