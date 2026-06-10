@extends('layouts.admin')

@section('title', 'Kelola Rule Forward Chaining')

@section('content')

<div class="container">

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD TAMBAH RULE --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <h4>Tambah Rule Forward Chaining</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.rule.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>ID Rule</label>
                        <input type="text"
                               name="id_aturan"
                               class="form-control"
                               placeholder="R1"
                               required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Kriteria</label>

                        <select name="id_kriteria"
                                class="form-control"
                                required>

                            <option value="">Pilih Kriteria</option>

                            @foreach($kriteria as $item)
                                <option value="{{ $item->kode_kriteria }}">
                                    {{ $item->kode_kriteria }}
                                    -
                                    {{ $item->nama_kriteria }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Operator</label>

                        <select name="operator"
                                class="form-control"
                                required>

                            <option value="between">between</option>
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                            <option value=">">></option>
                            <option value="<"><</option>

                        </select>

                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Nilai Min</label>

                        <input type="number"
                               step="0.01"
                               name="nilai_min"
                               class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Nilai Max</label>

                        <input type="number"
                               step="0.01"
                               name="nilai_max"
                               class="form-control">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Label</label>

                        <input type="text"
                               name="label"
                               class="form-control"
                               placeholder="Rendah / Sedang / Tinggi"
                               required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Skor Aturan</label>

                        <input type="number"
                               name="skor_aturan"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Keterangan</label>

                        <textarea
                            name="keterangan"
                            rows="1"
                            class="form-control"></textarea>
                    </div>

                </div>

                <button class="btn btn-primary">
                    Simpan Rule
                </button>

            </form>

        </div>

    </div>


    {{-- TABEL RULE --}}
    <div class="card shadow-sm">

        <div class="card-header">
            <h4>Daftar Rule Forward Chaining</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>

                    <tr>
                        <th>ID Rule</th>
                        <th>Kriteria</th>
                        <th>Operator</th>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Label</th>
                        <th>Skor</th>
                        <th>Keterangan</th>
                        <th width="120">Aksi</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($rules as $rule)

                        <tr>

                            <td>{{ $rule->id_aturan }}</td>

                            <td>
                                {{ $rule->kriteria->nama_kriteria }}
                            </td>

                            <td>{{ $rule->operator }}</td>

                            <td>{{ $rule->nilai_min }}</td>

                            <td>{{ $rule->nilai_max }}</td>

                            <td>{{ $rule->label }}</td>

                            <td>{{ $rule->skor_aturan }}</td>

                            <td>{{ $rule->keterangan }}</td>

                            <td>

                                <form action="{{ route('admin.rule.destroy',$rule->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus rule ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center">
                                Belum ada data rule
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection