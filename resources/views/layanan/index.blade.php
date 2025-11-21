<div id="modalHarga" class="modal hidden">
    <div class="modal-content">

        <h2>Update Harga Laundrymu!</h2>

        <form action="{{ route('layanan.update_mass') }}" method="POST">
            @csrf
            @method('PUT')

            @foreach ($layanans as $layanan)
                <label>
                    {{ $layanan->jenis_layanan }}
                </label>

                <div class="input-group">
                    <input 
                        type="number" 
                        name="harga[{{ $layanan->id_layanan }}]" 
                        value="{{ $layanan->harga_per_kg }}" 
                        required
                    >
                </div>
            @endforeach

            <button type="submit">Simpan Perubahan</button>
        </form>

    </div>
</div>