<div class="form-box">
    <h2>Mulai Analisis Usaha</h2>

    <form action="{{ auth()->check() ? route('rekomendasi-form') : route('login') }}" method="GET">

        <div class="form-grid">

            <div class="form-group">
                <label>Nama Usaha</label>
                <input type="text" name="nama_usaha" placeholder="Tulis nama usaha" required>
                <small class="input-hint">Contoh: Reycelty</small>
            </div>

            <div class="form-group">
                <label>Jenis Usaha</label>
                <select>
                    <option selected>Pilih jenis usaha</option>
                    <option>Kesehatan</option>
                    <option>Perdagangan</option>
                    <option>Jasa</option>
                    <option>Pendidikan</option>
                    <option>Makanan & Minuman</option>
                    <option>Fashion</option>
                </select>
                <small class="input-hint">Pilih jenis usaha yang paling sesuai</small>
            </div>

            <div class="form-group">
                <label>Kabupaten / Kota</label>
                <select name="kabupaten" id="kabupaten" required>
                    <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                </select>
                <small class="input-hint">Lokasi utama usaha berada</small>
            </div>

            <div class="form-group">
                <label>Lama Usaha (Tahun)</label>
                <input type="number" name="lama_usaha" min="0" placeholder="Masukkan lama usaha" required>
                <small class="input-hint">Contoh: 3</small>
            </div>

            <!-- ================= DATA KEUANGAN ================= -->
            <div class="section-grid">

                <div class="form-section-box">
                    <div class="section-title">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                        Data Keuangan
                    </div>

                    <div class="section-form">
                        <div class="form-group">
                            <label>Total Aset (Rp)</label>
                            <input type="number" name="aset" placeholder="Masukkan total aset" required>
                            <small class="input-hint">Contoh: 50000000</small>
                        </div>

                        <div class="form-group">
                            <label>Omset / Pendapatan per Bulan (Rp)</label>
                            <input type="number" name="omset" placeholder="Masukkan omset bulanan" required>
                            <small class="input-hint">Contoh: 10000000</small>
                        </div>

                        <div class="form-group">
                            <label>Laba Bersih per Bulan (Rp)</label>
                            <input type="number" name="laba" placeholder="Masukkan laba bersih" required>
                            <small class="input-hint">Contoh: 2500000</small>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ================= DATA OPERASIONAL ================= -->
            <div class="form-section-box">

                <div class="section-title">
                    <i class="fa-solid fa-industry"></i>
                    Data Operasional
                </div>

                <div class="section-form">

                    <div class="form-group">
                        <label>Jumlah Karyawan (Orang)</label>
                        <input type="number" name="jumlah_karyawan" placeholder="Masukkan jumlah karyawan" required>
                        <small class="input-hint">Contoh: 5</small>
                    </div>

                    <div class="form-group">
                        <label>Kapasitas Produksi per Bulan</label>
                        <input type="number" name="kapasitas_produksi" placeholder="Masukkan kapasitas produksi"
                            required>
                        <small class="input-hint">Contoh: 1000</small>
                    </div>

                    <div class="form-group">
                        <label>Produksi Aktual per Bulan</label>
                        <input type="number" name="produksi_aktual" placeholder="Masukkan produksi aktual" required>
                        <small class="input-hint">Contoh: 850</small>
                    </div>

                </div>
            </div>

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

<!-- ================= AJAX KABUPATEN ================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {

        $.get('/wilayah/kabupaten', function(data) {

            $('#kabupaten').html('<option value="" disabled selected>Pilih Kabupaten/Kota</option>');

            data.forEach(function(item) {
                $('#kabupaten').append(`
                <option value="${item.name}" data-id="${item.id}">
                    ${item.name}
                </option>
            `);
            });

        });

    });
</script>
</div>
