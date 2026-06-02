<div class="form-box">
    <h2>Mulai Analisis Usaha</h2>

        <form action="{{ auth()->check() ? route('rekomendasi') : route('login') }}" method="GET">

            <!-- MODAL -->
            <div class="form-group">
                <label>Modal Usaha</label>
                <input type="number" name="modal" class="form-control" placeholder="Contoh: 5000000">
            </div>

            <!-- JENIS USAHA -->
            <div class="form-group">
                <label>Jenis Usaha</label>
                <select name="jenis_usaha" class="form-control">
                    <option value="">Pilih Jenis Usaha</option>
                    @if(isset($jenisUsaha) && $jenisUsaha->count())
                        @foreach($jenisUsaha as $item)
                            <option value="{{ $item->nama_jenis_usaha }}">{{ $item->nama_jenis_usaha }}</option>
                        @endforeach
                    @else
                        <option>Kuliner</option>
                        <option>Fashion</option>
                        <option>Kerajinan</option>
                        <option>Jasa</option>
                    @endif
                </select>
            </div>

            <!-- TARGET PASAR -->
            <div class="form-group">
                <label>Target Pasar</label>
                <input type="text" name="target_pasar" class="form-control"
                    placeholder="Contoh: Pelajar, Mahasiswa, Umum">
            </div>

            <!-- LOKASI -->
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Malang">
            </div>

            @if (auth()->check())
                <button type="submit" class="btn-primary">
                    Mulai Analisis Usaha
                </button>
            @else
                <a href="#" class="btn-primary openModal"
                    style="display:block;
                      text-align:center;
                      padding:12px;
                      border-radius:8px;
                      text-decoration:none;">
                    Mulai Analisis Usaha
                </a>
            @endif

        </form>

    </div>
</div>
