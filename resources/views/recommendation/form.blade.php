@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-orange text-white">
                    <h4 class="mb-0">Form Input Rekomendasi Usaha</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('recommendation.process') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="nama_usaha" class="form-label">Nama Usaha</label>
                            <input type="text" id="nama_usaha" name="nama_usaha" class="form-control" value="{{ old('nama_usaha') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="daerah" class="form-label">Daerah/Lokasi</label>
                            <input type="text" id="daerah" name="daerah" class="form-control" value="{{ old('daerah') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="aset" class="form-label">Aset (Rp)</label>
                                    <input type="number" id="aset" name="aset" class="form-control" value="{{ old('aset') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="omset" class="form-label">Omset (Rp)</label>
                                    <input type="number" id="omset" name="omset" class="form-control" value="{{ old('omset') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="laba" class="form-label">Laba (Rp)</label>
                                    <input type="number" id="laba" name="laba" class="form-control" value="{{ old('laba') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="jumlah_pelanggan" class="form-label">Jumlah Pelanggan</label>
                                    <input type="number" id="jumlah_pelanggan" name="jumlah_pelanggan" class="form-control" value="{{ old('jumlah_pelanggan') }}" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-orange w-100">Dapatkan Rekomendasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-orange {
        background-color: #FF7A00;
    }

    .btn-orange {
        background-color: #FF7A00;
        border: none;
        color: white;
        font-weight: 600;
    }

    .btn-orange:hover {
        background-color: #E56A00;
        color: white;
    }
</style>
@endsection
