@extends('layouts.admin')

@section('title', 'Kelola Data')

@section('topbar-label', 'Kelola Data')
@section('topbar-heading', 'Selamat datang, ' . auth()->user()->name)

@push('styles')
<style>
    /* PAGE HEADER */
    .page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .page-header-left .breadcrumb {
        font-size: 11px;
        color: #f97316;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .page-header-left h2 {
        font-size: 20px;
        font-weight: 700;
        color: #1a2236;
        margin-top: 2px;
    }

    .btn-tambah {
        display: flex;
        align-items: center;
        gap: 7px;
        background: #f97316;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s, transform 0.1s;
        text-decoration: none;
    }

    .btn-tambah:hover { background: #ea580c; transform: translateY(-1px); }
    .btn-tambah svg { width: 16px; height: 16px; fill: white; }

    /* FILTER BAR */
    .filter-bar {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 1;
        min-width: 180px;
    }

    .filter-label {
        font-size: 12px;
        color: #6b7280;
        font-weight: 500;
        white-space: nowrap;
    }

    .filter-select, .filter-input {
        flex: 1;
        padding: 7px 10px;
        border: 1px solid #e5e7eb;
        border-radius: 7px;
        font-size: 12px;
        color: #374151;
        background: #f9fafb;
        outline: none;
        transition: border-color 0.15s;
    }

    .filter-select:focus, .filter-input:focus {
        border-color: #f97316;
        background: white;
    }

    .filter-divider {
        width: 1px;
        height: 28px;
        background: #e5e7eb;
    }

    .btn-reset {
        padding: 7px 14px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 7px;
        font-size: 12px;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.15s;
        white-space: nowrap;
    }

    .btn-reset:hover { background: #e5e7eb; color: #374151; }

    /* TABLE CARD */
    .table-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .table-card-header {
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f3f4f6;
    }

    .table-card-header h3 {
        font-size: 14px;
        font-weight: 700;
        color: #1a2236;
    }

    .table-count {
        font-size: 12px;
        color: #6b7280;
        background: #f3f4f6;
        padding: 3px 10px;
        border-radius: 20px;
    }

    /* TABLE */
    .data-table { width: 100%; border-collapse: collapse; }

    .data-table thead tr {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
    }

    .data-table thead th {
        padding: 11px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        white-space: nowrap;
    }

    .data-table thead th.sortable { cursor: pointer; user-select: none; }
    .data-table thead th.sortable:hover { color: #f97316; }

    .sort-icon { display: inline-block; margin-left: 4px; opacity: 0.4; font-size: 10px; }

    .data-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.1s;
    }

    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #fafafa; }

    .data-table tbody td {
        padding: 13px 16px;
        font-size: 13px;
        color: #374151;
        vertical-align: middle;
    }

    .td-no   { font-size: 12px; color: #9ca3af; font-weight: 500; width: 40px; }
    .td-name { font-weight: 600; color: #1a2236; }
    .td-sub  { font-size: 11px; color: #9ca3af; margin-top: 2px; }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-kuliner    { background: rgba(249,115,22,0.1); color: #ea580c; }
    .badge-fashion    { background: rgba(168,85,247,0.1); color: #9333ea; }
    .badge-teknologi  { background: rgba(59,130,246,0.1); color: #2563eb; }
    .badge-kesehatan  { background: rgba(34,197,94,0.1);  color: #16a34a; }
    .badge-pendidikan { background: rgba(234,179,8,0.1);  color: #ca8a04; }
    .badge-jasa       { background: rgba(20,184,166,0.1); color: #0d9488; }

    /* Status */
    .status-dot { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 500; }
    .dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .dot-aktif    { background: #22c55e; }
    .dot-nonaktif { background: #9ca3af; }
    .text-aktif   { color: #16a34a; }
    .text-nonaktif { color: #9ca3af; }

    .modal-value { font-weight: 700; color: #1a2236; }

    /* Action buttons */
    .action-group { display: flex; align-items: center; gap: 6px; }

    .btn-action {
        width: 30px;
        height: 30px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
        text-decoration: none;
    }

    .btn-action svg { width: 14px; height: 14px; }

    .btn-view   { background: rgba(59,130,246,0.1); color: #3b82f6; }
    .btn-edit   { background: rgba(249,115,22,0.1); color: #f97316; }
    .btn-delete { background: rgba(239,68,68,0.1);  color: #ef4444; }

    .btn-view:hover   { background: #3b82f6; color: white; }
    .btn-edit:hover   { background: #f97316; color: white; }
    .btn-delete:hover { background: #ef4444; color: white; }

    /* PAGINATION */
    .pagination-bar {
        padding: 14px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #f3f4f6;
    }

    .pagination-info { font-size: 12px; color: #6b7280; }
    .pagination-pages { display: flex; align-items: center; gap: 4px; }

    .page-btn {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 500;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.15s;
        text-decoration: none;
    }

    .page-btn:hover { border-color: #f97316; color: #f97316; }
    .page-btn.active { background: #f97316; border-color: #f97316; color: white; }
    .page-btn svg { width: 13px; height: 13px; }

    /* ALERT */
    .alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border-radius: 9px;
        margin-bottom: 16px;
        font-size: 13px;
        font-weight: 500;
    }

    .alert-success {
        background: rgba(34,197,94,0.1);
        color: #16a34a;
        border: 1px solid rgba(34,197,94,0.2);
    }

    .alert svg { width: 16px; height: 16px; flex-shrink: 0; fill: currentColor; }

    /* MODAL */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 100;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.open { display: flex; }

    .modal-box {
        background: white;
        border-radius: 14px;
        width: 480px;
        max-width: 95vw;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        animation: modalIn 0.2s ease;
    }

    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    .modal-header {
        padding: 20px 24px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f3f4f6;
    }

    .modal-title { font-size: 16px; font-weight: 700; color: #1a2236; }

    .modal-close {
        width: 30px;
        height: 30px;
        border-radius: 7px;
        background: #f3f4f6;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #6b7280;
        font-size: 16px;
        line-height: 1;
        transition: background 0.15s;
    }

    .modal-close:hover { background: #e5e7eb; }

    .modal-body { padding: 20px 24px; }

    .form-group { margin-bottom: 16px; }

    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13px;
        color: #374151;
        background: #f9fafb;
        outline: none;
        transition: border-color 0.15s, background 0.15s;
    }

    .form-control:focus {
        border-color: #f97316;
        background: white;
        box-shadow: 0 0 0 3px rgba(249,115,22,0.1);
    }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    .modal-footer {
        padding: 16px 24px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        border-top: 1px solid #f3f4f6;
    }

    .btn-cancel {
        padding: 9px 20px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13px;
        color: #6b7280;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.15s;
    }

    .btn-cancel:hover { background: #e5e7eb; }

    .btn-simpan {
        padding: 9px 22px;
        background: #f97316;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        color: white;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.15s;
    }

    .btn-simpan:hover { background: #ea580c; }

    /* DELETE MODAL */
    .modal-delete-body { padding: 24px; text-align: center; }

    .delete-icon {
        width: 56px;
        height: 56px;
        background: rgba(239,68,68,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .delete-icon svg { width: 26px; height: 26px; fill: #ef4444; }

    .delete-title { font-size: 16px; font-weight: 700; color: #1a2236; margin-bottom: 8px; }
    .delete-desc  { font-size: 13px; color: #6b7280; line-height: 1.6; }

    .delete-footer {
        padding: 16px 24px;
        display: flex;
        justify-content: center;
        gap: 10px;
        border-top: 1px solid #f3f4f6;
    }

    .btn-hapus {
        padding: 9px 22px;
        background: #ef4444;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        color: white;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.15s;
    }

    .btn-hapus:hover { background: #dc2626; }
</style>
@endpush

@section('content')

    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert alert-success">
        <svg viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <p class="breadcrumb">Manajemen</p>
            <h2>Kelola Data</h2>
        </div>
        <button class="btn-tambah" onclick="openModal('modal-tambah')">
            <svg viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            Tambah Data
        </button>
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-bar">
        <div class="filter-group">
            <span class="filter-label">Kategori</span>
            <select class="filter-select">
                <option value="">Semua Kategori</option>
                <option>Kuliner</option>
                <option>Fashion</option>
                <option>Teknologi</option>
                <option>Kesehatan</option>
                <option>Pendidikan</option>
                <option>Jasa</option>
            </select>
        </div>
        <div class="filter-divider"></div>
        <div class="filter-group">
            <span class="filter-label">Status</span>
            <select class="filter-select">
                <option value="">Semua Status</option>
                <option>Aktif</option>
                <option>Non-Aktif</option>
            </select>
        </div>
        <div class="filter-divider"></div>
        <div class="filter-group">
            <span class="filter-label">Kota</span>
            <input type="text" class="filter-input" placeholder="Cari kota..." />
        </div>
        <div class="filter-divider"></div>
        <button class="btn-reset">Reset Filter</button>
    </div>

    {{-- TABLE CARD --}}
    <div class="table-card">
        <div class="table-card-header">
            <h3>Daftar Data Usaha</h3>
            <span class="table-count">{{ count($dataUsaha) }} data</span>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="sortable">Nama Usaha <span class="sort-icon">↕</span></th>
                    <th class="sortable">Kategori <span class="sort-icon">↕</span></th>
                    <th class="sortable">Kota/Kab <span class="sort-icon">↕</span></th>
                    <th class="sortable">Modal Awal <span class="sort-icon">↕</span></th>
                    <th>Status</th>
                    <th>Potensi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataUsaha as $index => $item)
                <tr>
                    <td class="td-no">{{ $index + 1 }}</td>
                    <td>
                        <div class="td-name">{{ $item['nama_usaha'] }}</div>
                        <div class="td-sub">ID: {{ $item['id'] }}</div>
                    </td>
                    <td>
                        <span class="badge badge-{{ \Illuminate\Support\Str::slug(strtolower($item['kategori'])) }}">
                            {{ $item['kategori'] }}
                        </span>
                    </td>
                    <td>{{ $item['kota'] }}</td>
                    <td class="modal-value">Rp {{ number_format($item['modal_awal'], 0, ',', '.') }}</td>
                    <td>
                        <span class="status-dot">
                            <span class="dot {{ strtolower($item['status']) === 'aktif' ? 'dot-aktif' : 'dot-nonaktif' }}"></span>
                            <span class="{{ strtolower($item['status']) === 'aktif' ? 'text-aktif' : 'text-nonaktif' }}">
                                {{ ucfirst($item['status']) }}
                            </span>
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{ \Illuminate\Support\Str::slug(strtolower($item['potensi'])) }}">
                            {{ $item['potensi'] }}
                        </span>
                    </td>
                    <td>
                        <div class="action-group">
                            <button class="btn-action btn-view" title="Detail">
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <button class="btn-action btn-edit" title="Edit" onclick="openModal('modal-edit')">
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg>
                            </button>
                            <button class="btn-action btn-delete" title="Hapus" onclick="openModal('modal-hapus')">
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="padding: 32px; text-align: center; color: #9ca3af; font-size: 13px;">
                        Tidak ada data usaha untuk ditampilkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="pagination-bar">
            <span class="pagination-info">
                Menampilkan 1–{{ min(count($dataUsaha), 10) }} dari {{ count($dataUsaha) }} data
            </span>
            <div class="pagination-pages">
                <a class="page-btn">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
                <a class="page-btn active">1</a>
                <a class="page-btn">2</a>
                <a class="page-btn">3</a>
                <span style="font-size:12px; color:#9ca3af; padding: 0 4px;">...</span>
                <a class="page-btn">50</a>
                <a class="page-btn">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>

    </div>{{-- end table-card --}}

@endsection

{{-- ===== MODAL TAMBAH ===== --}}
@push('modals')
<div class="modal-overlay" id="modal-tambah">
    <div class="modal-box">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Usaha</h4>
            <button class="modal-close" onclick="closeModal('modal-tambah')">✕</button>
        </div>
        <div class="modal-body">
            <form action="{{ route('kelola-data.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Usaha</label>
                    <input type="text" class="form-control" name="nama_usaha" placeholder="Masukkan nama usaha" required />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option value="">Pilih kategori</option>
                            <option>Kuliner</option>
                            <option>Fashion</option>
                            <option>Teknologi</option>
                            <option>Kesehatan</option>
                            <option>Pendidikan</option>
                            <option>Jasa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kota/Kabupaten</label>
                        <input type="text" class="form-control" name="kota" placeholder="e.g. Surabaya" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Modal Awal (Rp)</label>
                        <input type="number" class="form-control" name="modal_awal" placeholder="5000000" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi singkat usaha..."></textarea>
                </div>
                <div class="modal-footer" style="padding: 0; border: none; margin-top: 8px;">
                    <button type="button" class="btn-cancel" onclick="closeModal('modal-tambah')">Batal</button>
                    <button type="submit" class="btn-simpan">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL EDIT ===== --}}
<div class="modal-overlay" id="modal-edit">
    <div class="modal-box">
        <div class="modal-header">
            <h4 class="modal-title">Edit Data Usaha</h4>
            <button class="modal-close" onclick="closeModal('modal-edit')">✕</button>
        </div>
        <div class="modal-body">
            <form action="{{ route('kelola-data.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama Usaha</label>
                    <input type="text" class="form-control" name="nama_usaha" value="Warung Makan Bu Sari" required />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option>Kuliner</option>
                            <option>Fashion</option>
                            <option>Teknologi</option>
                            <option>Kesehatan</option>
                            <option>Pendidikan</option>
                            <option>Jasa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kota/Kabupaten</label>
                        <input type="text" class="form-control" name="kota" value="Surabaya" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Modal Awal (Rp)</label>
                        <input type="number" class="form-control" name="modal_awal" value="5000000" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="aktif" selected>Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3">Warung makan dengan menu masakan Jawa Timur.</textarea>
                </div>
                <div class="modal-footer" style="padding: 0; border: none; margin-top: 8px;">
                    <button type="button" class="btn-cancel" onclick="closeModal('modal-edit')">Batal</button>
                    <button type="submit" class="btn-simpan">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL HAPUS ===== --}}
<div class="modal-overlay" id="modal-hapus">
    <div class="modal-box" style="width: 380px;">
        <div class="modal-delete-body">
            <div class="delete-icon">
                <svg viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <p class="delete-title">Hapus Data Usaha?</p>
            <p class="delete-desc">Data <strong>Warung Makan Bu Sari</strong> akan dihapus secara permanen dan tidak dapat dikembalikan.</p>
        </div>
        <div class="delete-footer">
            <button class="btn-cancel" onclick="closeModal('modal-hapus')">Batal</button>
            <form action="{{ route('kelola-data.destroy', 1) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-hapus">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
        document.body.style.overflow = '';
    }

    // Tutup modal saat klik overlay
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        });
    });

    // Tutup modal dengan Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.open').forEach(m => {
                closeModal(m.id);
            });
        }
    });
</script>
@endpush