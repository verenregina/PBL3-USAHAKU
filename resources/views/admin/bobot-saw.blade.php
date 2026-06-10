@extends('layouts.admin')

@section('title', 'Kelola Bobot SAW')

@section('topbar-label', 'Kelola Bobot SAW')
@section('topbar-heading', 'Selamat datang, ' . auth()->user()->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/kelolabobotsaw.css') }}">
@endpush

@section('content')
    <div class="page-header">
        <div class="page-header-left">
            <h2>Kelola Bobot SAW</h2>
        </div>
    </div>

    <div class="kbs-card">

        {{-- ── Header ──────────────────────────────────────── --}}
        <div class="kbs-header">
            <div class="kbs-header-left">
                <div class="kbs-header-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M12 3c7 0 9 3 9 9s-2 9-9 9-9-3-9-9 2-9 9-9z"/><path d="M12 8v4l3 3"/>
                    </svg>
                </div>
                <div>
                    <p class="kbs-header-title">Kelola Bobot SAW</p>
                    <p class="kbs-header-sub">Atur bobot tiap kriteria penilaian usaha</p>
                </div>
            </div>
            <div class="kbs-total-pill" id="kbs-pill">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M19 5 5 19M5 5h6M13 19h6"/></svg>
                Total: <span id="kbs-pill-val">—</span>
            </div>
        </div>

        {{-- ── Flash messages ───────────────────────────────── --}}
        @if(session('success'))
            <div class="kbs-alert kbs-alert-success">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="kbs-alert kbs-alert-error">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- ── Info bar ─────────────────────────────────────── --}}
        <div class="kbs-info-bar">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            Jumlah seluruh bobot harus = <strong style="margin-left:3px">1.00 (100%)</strong>
        </div>

        {{-- ── Form ─────────────────────────────────────────── --}}
        <form action="{{ route('admin.bobot.update') }}" method="POST" id="kbs-form">
            @csrf

            <div class="kbs-table-wrap">
                <table class="kbs-table">
                    <thead>
                        <tr>
                            <th style="width:90px">Kode</th>
                            <th style="width:22%">Nama Kriteria</th>
                            <th>Deskripsi</th>
                            <th style="width:200px">Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kriteria as $item)
                            <tr>
                                <td>
                                    <span class="kbs-kode">{{ $item->kode_kriteria }}</span>
                                </td>
                                <td>
                                    <div class="kbs-nama">{{ $item->nama_kriteria }}</div>
                                </td>
                                <td>
                                    <span class="kbs-deskripsi">{{ $item->deskripsi }}</span>
                                </td>
                                <td>
                                    <div class="kbs-bobot-wrap">
                                        <div class="kbs-bobot-bar">
                                            <div class="kbs-bobot-fill"
                                                 id="bar-{{ $item->id }}"
                                                 style="width: {{ (old('bobot.'.$item->id, $item->bobot) * 100) }}%">
                                            </div>
                                        </div>
                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            max="1"
                                            class="kbs-bobot-input"
                                            id="inp-{{ $item->id }}"
                                            name="bobot[{{ $item->id }}]"
                                            value="{{ old('bobot.'.$item->id, $item->bobot) }}"
                                            data-id="{{ $item->id }}"
                                            required>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ── Footer ───────────────────────────────────── --}}
            <div class="kbs-footer">
                <div class="kbs-progress-group">
                    <span class="kbs-progress-label">Total bobot:</span>
                    <div class="kbs-progress-track">
                        <div class="kbs-progress-fill" id="kbs-prog-fill" style="width:0%"></div>
                    </div>
                    <span class="kbs-progress-value is-invalid" id="kbs-prog-val">0.00 / 1.00</span>
                </div>

                <button type="submit" class="kbs-btn-save">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    function getTotal() {
        let t = 0;
        document.querySelectorAll('.kbs-bobot-input').forEach(function (inp) {
            t += parseFloat(inp.value) || 0;
        });
        return t;
    }

    function updateUI() {
        const t     = getTotal();
        const isOk  = Math.abs(t - 1.00) < 0.001;
        const pct   = Math.min(Math.round(t * 100), 100);
        const cls   = isOk ? 'is-valid' : 'is-invalid';

        document.getElementById('kbs-prog-fill').style.width = pct + '%';
        document.getElementById('kbs-prog-fill').className   = 'kbs-progress-fill ' + (isOk ? 'is-valid' : '');
        document.getElementById('kbs-prog-val').textContent   = t.toFixed(2) + ' / 1.00';
        document.getElementById('kbs-prog-val').className     = 'kbs-progress-value ' + cls;
        document.getElementById('kbs-pill').className         = 'kbs-total-pill ' + (isOk ? 'is-valid' : 'is-invalid');
        document.getElementById('kbs-pill-val').textContent   = t.toFixed(2);
    }

    document.querySelectorAll('.kbs-bobot-input').forEach(function (inp) {
        var id = inp.dataset.id;
        inp.addEventListener('input', function () {
            var val = Math.min(Math.max(parseFloat(this.value) || 0, 0), 1);
            var bar = document.getElementById('bar-' + id);
            if (bar) bar.style.width = Math.round(val * 100) + '%';
            updateUI();
        });
    });

    updateUI();
})();
</script>
@endpush