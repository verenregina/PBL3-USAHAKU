@extends('layouts.admin')

@section('title', 'Kelola Dataset')

@section('topbar-label', 'Dataset')
@section('topbar-heading', 'Kelola Dataset UMKM')

@push('styles')
<style>

    .page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:24px;
        gap:16px;
        flex-wrap:wrap;
    }

    .page-title h2{
        font-size:24px;
        font-weight:700;
        color:#1f2937;
    }

    .page-title p{
        font-size:13px;
        color:#6b7280;
        margin-top:4px;
    }

    .btn-primary{
        background:#f97316;
        color:white;
        border:none;
        padding:12px 18px;
        border-radius:12px;
        font-size:13px;
        font-weight:600;
        cursor:pointer;
        display:flex;
        align-items:center;
        gap:8px;
        transition:.2s ease;
        text-decoration:none;
    }

    .btn-primary:hover{
        background:#ea580c;
        transform:translateY(-1px);
    }

    /* ===== FILTER ===== */

    .filter-card{
        background:white;
        border-radius:18px;
        padding:18px;
        margin-bottom:22px;
        border:1px solid #e5e7eb;

        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:14px;
        flex-wrap:wrap;
    }

    .search-box{
        flex:1;
        min-width:240px;
        position:relative;
    }

    .search-box input{
        width:100%;
        padding:12px 14px 12px 42px;
        border-radius:12px;
        border:1px solid #d1d5db;
        outline:none;
        font-size:13px;
        background:#f9fafb;
    }

    .search-box i{
        position:absolute;
        left:14px;
        top:50%;
        transform:translateY(-50%);
        color:#9ca3af;
        font-size:14px;
    }

    .filter-actions{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
    }

    .filter-select{
        padding:11px 14px;
        border-radius:12px;
        border:1px solid #d1d5db;
        background:white;
        font-size:13px;
        outline:none;
    }

    /* ===== TABLE ===== */

    .table-card{
        background:white;
        border-radius:18px;
        border:1px solid #e5e7eb;
        overflow:hidden;
    }

    .table-header{
        padding:18px 22px;
        border-bottom:1px solid #f1f5f9;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .table-header h3{
        font-size:16px;
        font-weight:700;
        color:#111827;
    }

    .dataset-count{
        font-size:12px;
        color:#6b7280;
    }

    .table-wrapper{
        overflow-x:auto;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    thead{
        background:#f9fafb;
    }

    th{
        padding:16px;
        text-align:left;
        font-size:12px;
        color:#6b7280;
        font-weight:600;
        text-transform:uppercase;
        letter-spacing:.5px;
    }

    td{
        padding:16px;
        border-top:1px solid #f3f4f6;
        font-size:13px;
        color:#374151;
        vertical-align:middle;
    }

    tbody tr:hover{
        background:#fafafa;
    }

    .dataset-name{
        font-weight:600;
        color:#111827;
    }

    .status-badge{
        display:inline-flex;
        align-items:center;
        padding:6px 12px;
        border-radius:999px;
        font-size:11px;
        font-weight:600;
    }

    .status-active{
        background:rgba(34,197,94,.12);
        color:#16a34a;
    }

    .status-draft{
        background:rgba(234,179,8,.12);
        color:#ca8a04;
    }

    .action-buttons{
        display:flex;
        gap:8px;
    }

    .btn-action{
        width:34px;
        height:34px;
        border:none;
        border-radius:10px;
        cursor:pointer;
        display:flex;
        align-items:center;
        justify-content:center;
        transition:.2s;
    }

    .btn-view{
        background:rgba(59,130,246,.12);
        color:#2563eb;
    }

    .btn-edit{
        background:rgba(249,115,22,.12);
        color:#ea580c;
    }

    .btn-delete{
        background:rgba(239,68,68,.12);
        color:#dc2626;
    }

    .btn-action:hover{
        transform:translateY(-2px);
    }

    /* ===== MODAL ===== */

    .modal-overlay{
        position:fixed;
        inset:0;
        background:rgba(15,23,42,.45);
        display:none;
        align-items:center;
        justify-content:center;
        z-index:999;
        padding:20px;
    }

    .modal-overlay.active{
        display:flex;
    }

    .custom-modal{
        width:100%;
        max-width:480px;
        background:white;
        border-radius:24px;
        overflow:hidden;
        animation:fadeIn .2s ease;
    }

    @keyframes fadeIn{
        from{
            opacity:0;
            transform:translateY(10px);
        }
        to{
            opacity:1;
            transform:translateY(0);
        }
    }

    .modal-header{
        padding:20px 24px;
        border-bottom:1px solid #f1f5f9;

        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .modal-header h3{
        font-size:18px;
        font-weight:700;
        color:#111827;
    }

    .close-modal{
        width:36px;
        height:36px;
        border:none;
        border-radius:10px;
        background:#f3f4f6;
        cursor:pointer;
    }

    .upload-area{
        padding:35px 24px;
        text-align:center;
    }

    .upload-area i{
        font-size:52px;
        color:#f97316;
        margin-bottom:14px;
    }

    .upload-area p{
        font-size:14px;
        color:#6b7280;
        margin-bottom:20px;
    }

    .btn-upload-file{
        background:#f97316;
        color:white;
        border:none;
        padding:11px 18px;
        border-radius:12px;
        cursor:pointer;
        font-weight:600;
    }

    .modal-actions{
        padding:20px 24px;
        border-top:1px solid #f1f5f9;

        display:flex;
        justify-content:flex-end;
        gap:12px;
    }

    .btn-cancel{
        padding:10px 16px;
        border:none;
        border-radius:12px;
        background:#f3f4f6;
        cursor:pointer;
    }

    .btn-save{
        padding:10px 16px;
        border:none;
        border-radius:12px;
        background:#f97316;
        color:white;
        cursor:pointer;
    }

    /* ===== PAGINATION ===== */

    .pagination-wrapper{
        margin-top:22px;

        display:flex;
        justify-content:flex-end;
        align-items:center;
        gap:8px;
    }

    .pagination-btn,
    .pagination-number{
        width:38px;
        height:38px;
        border:none;
        border-radius:10px;
        background:white;
        border:1px solid #e5e7eb;
        cursor:pointer;
        font-weight:600;
    }

    .pagination-number.active{
        background:#f97316;
        color:white;
        border-color:#f97316;
    }

    @media(max-width:768px){

        .page-title h2{
            font-size:20px;
        }

        th, td{
            padding:14px;
        }

    }

</style>
@endpush

@section('content')

<div class="page-header">

    <div class="page-title">
        <h2>Kelola Dataset</h2>
        <p>Admin dapat mengelola dataset UMKM dan melakukan import data CSV.</p>
    </div>

    <button class="btn-primary" onclick="openImportModal()">
        <i class="fa-solid fa-upload"></i>
        Import CSV
    </button>

</div>

{{-- FILTER --}}
<div class="filter-card">

    <div class="search-box">
        <i class="fa-solid fa-search"></i>
        <input type="text" placeholder="Cari dataset...">
    </div>

    <div class="filter-actions">

        <select class="filter-select">
            <option>Semua Status</option>
            <option>Aktif</option>
            <option>Draft</option>
        </select>

        <select class="filter-select">
            <option>Terbaru</option>
            <option>Terlama</option>
        </select>

    </div>

</div>

{{-- TABLE --}}
<div class="table-card">

    <div class="table-header">
        <h3>Daftar Dataset</h3>
        <span class="dataset-count">Total 12 dataset</span>
    </div>

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>Nama Dataset</th>
                    <th>Kategori</th>
                    <th>Jumlah Data</th>
                    <th>Tanggal Upload</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>
                        <div class="dataset-name">Dataset UMKM Kuliner</div>
                    </td>
                    <td>Kuliner</td>
                    <td>1.240 Data</td>
                    <td>12 Mei 2026</td>
                    <td>
                        <span class="status-badge status-active">
                            Aktif
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">

                            <button class="btn-action btn-view">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <button class="btn-action btn-edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button class="btn-action btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="dataset-name">Dataset UMKM Fashion</div>
                    </td>
                    <td>Fashion</td>
                    <td>980 Data</td>
                    <td>10 Mei 2026</td>
                    <td>
                        <span class="status-badge status-draft">
                            Draft
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">

                            <button class="btn-action btn-view">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <button class="btn-action btn-edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button class="btn-action btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </div>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

{{-- PAGINATION --}}
<div class="pagination-wrapper">

    <button class="pagination-btn">
        <i class="fa-solid fa-angle-left"></i>
    </button>

    <button class="pagination-number active">1</button>
    <button class="pagination-number">2</button>
    <button class="pagination-number">3</button>

    <button class="pagination-btn">
        <i class="fa-solid fa-angle-right"></i>
    </button>

</div>

{{-- MODAL IMPORT CSV --}}
<div class="modal-overlay" id="importModal">

    <div class="custom-modal">

        <div class="modal-header">

            <h3>Import Dataset CSV</h3>

            <button class="close-modal" onclick="closeImportModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

        <form>

            <div class="upload-area">

                <i class="fa-solid fa-file-csv"></i>

                <p>Pilih file CSV untuk diupload</p>

                <input type="file" hidden id="csvFile">

                <button type="button"
                        class="btn-upload-file"
                        onclick="document.getElementById('csvFile').click()">

                    Pilih File

                </button>

            </div>

            <div class="modal-actions">

                <button type="button"
                        class="btn-cancel"
                        onclick="closeImportModal()">

                    Batal

                </button>

                <button type="submit" class="btn-save">
                    Upload Dataset
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')
<script>

    function openImportModal(){
        document.getElementById('importModal')
            .classList.add('active');
    }

    function closeImportModal(){
        document.getElementById('importModal')
            .classList.remove('active');
    }

</script>
@endpush