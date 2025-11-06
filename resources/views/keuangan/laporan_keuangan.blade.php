@extends('layouts.app')

@section('title', 'Laporan Pengeluaran')

@section('content')
<main class="p-8 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Laporan Pengeluaran</h1>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Data --}}
    <table class="w-full table-auto border border-gray-300 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Penerima</th>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Nominal</th>
                <th class="border px-4 py-2">Kategori</th>
                <th class="border px-4 py-2">Bukti</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengeluarans as $index => $p)
            <tr class="hover:bg-gray-50">
                <td class="border px-4 py-2 text-center">{{ $index + $pengeluarans->firstItem() }}</td>
                <td class="border px-4 py-2">{{ $p->penerima }}</td>
                <td class="border px-4 py-2">{{ $p->tanggal->format('d/m/Y') }}</td>
                <td class="border px-4 py-2">Rp{{ number_format($p->nominal,0,',','.') }}</td>
                <td class="border px-4 py-2">{{ ucfirst(str_replace('_', ' ', $p->kategori)) }}</td>
                <td class="border px-4 py-2 text-center">
                    @if($p->bukti_pengeluaran)
                        <button
                            class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600"
                            onclick="showBukti('{{ $p->bukti_pengeluaran }}')"
                        >
                            Lihat
                        </button>
                    @else
                        -
                    @endif
                </td>

                <td class="px-4 md:px-6 py-2 whitespace-nowrap text-sm font-medium text-center">
                    <div class="flex items-center justify-center space-x-2">
                        {{-- Tombol Detail --}}
                        <button
                            onclick='showDetail(@json($p))'
                            class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded-lg transition-all duration-200 group"
                        >
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>

                        {{-- Tombol Edit --}}
                        <a href="{{ route('pengeluaran.edit', $p->id_pengeluaran) }}"
                            class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-100 rounded-lg transition-all duration-200 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                                    a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('pengeluaran.destroy', $p->id_pengeluaran) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin hapus pengeluaran ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                        a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4
                                        a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $pengeluarans->links() }}
    </div>
</main>

{{-- ===================== MODAL: LIHAT BUKTI ===================== --}}
<div id="modalBukti" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded shadow-lg max-w-lg w-full p-4 relative">
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800" onclick="closeBukti()">✕</button>
        <div class="text-center">
            <img id="buktiImage" src="" alt="Bukti Pengeluaran" class="max-h-[400px] mx-auto rounded">
        </div>
    </div>
</div>

{{-- ===================== MODAL: DETAIL PENGELUARAN ===================== --}}
<div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800" onclick="closeDetail()">✕</button>
        <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Detail Pengeluaran</h2>

        <div class="grid grid-cols-1 gap-2 text-sm text-gray-700">
            <p><strong>Penerima:</strong> <span id="detailPenerima"></span></p>
            <p><strong>Tanggal:</strong> <span id="detailTanggal"></span></p>
            <p><strong>Nominal:</strong> Rp<span id="detailNominal"></span></p>
            <p><strong>Kategori:</strong> <span id="detailKategori"></span></p>
            <p><strong>Metode Pembayaran:</strong> <span id="detailMetode"></span></p>
            <p><strong>Keterangan:</strong> <span id="detailKeterangan"></span></p>

            <div class="mt-3 text-center">
                <p class="font-semibold mb-2">Bukti Pengeluaran:</p>
                <img id="detailBukti" class="max-h-[250px] mx-auto rounded border" alt="Bukti Pengeluaran">
            </div>
        </div>
    </div>
</div>

{{-- ===================== SCRIPT ===================== --}}
<script>
    // ===== Modal Bukti =====
    function showBukti(src) {
        const modal = document.getElementById('modalBukti');
        const img = document.getElementById('buktiImage');
        img.src = src.startsWith('data:image') ? src : '{{ asset('storage') }}/' + src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeBukti() {
        const modal = document.getElementById('modalBukti');
        const img = document.getElementById('buktiImage');
        img.src = '';
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // ===== Modal Detail =====
    function showDetail(data) {
        document.getElementById('detailPenerima').textContent = data.penerima || '-';
        document.getElementById('detailTanggal').textContent = new Date(data.tanggal).toLocaleDateString('id-ID');
        document.getElementById('detailNominal').textContent = (data.nominal || 0).toLocaleString('id-ID');
        document.getElementById('detailKategori').textContent = data.kategori ? data.kategori.replace('_', ' ') : '-';
        document.getElementById('detailMetode').textContent = data.metode_pembayaran || '-';
        document.getElementById('detailKeterangan').textContent = data.keterangan || '-';

        const img = document.getElementById('detailBukti');
        if (data.bukti_pengeluaran) {
            img.src = '{{ asset('storage') }}/' + data.bukti_pengeluaran;
            img.classList.remove('hidden');
        } else {
            img.classList.add('hidden');
        }

        const modal = document.getElementById('modalDetail');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeDetail() {
        const modal = document.getElementById('modalDetail');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
