@extends('layouts.admin')

@section('title', 'Kelola Rule Forward Chaining')

@section('topbar-label', 'Sistem Pakar')
@section('topbar-heading', 'Kelola Rule Forward Chaining')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/rule.css') }}">
@endpush

@section('content')

    {{-- SECTION HEADER --}}
    <div class="section-header">
        <p class="section-label">Sistem Pakar</p>
        <h2 class="section-title">Rule Forward Chaining</h2>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert-success-custom">
            <svg width="16" height="16" viewBox="0 0 20 20" fill="#16a34a">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="rule-form-card">
        <div class="rule-form-card-header">
            <div class="header-icon">
                <svg width="16" height="16" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h3>Tambah Rule Baru</h3>
        </div>

        <div class="rule-form-body">
            <form action="{{ route('admin.rule.store') }}" method="POST">
                @csrf

                {{-- Baris 1 --}}
                <div class="form-grid form-grid-5">
                    <div class="form-group">
                        <label class="form-label">ID Rule</label>
                        <input type="text"
                               name="id_aturan"
                               class="form-input"
                               placeholder="Contoh: R1"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kriteria</label>
                        <select name="id_kriteria" class="form-select" required>
                            <option value="">Pilih Kriteria</option>
                            @foreach($kriteria as $item)
                                <option value="{{ $item->kode_kriteria }}">
                                    {{ $item->kode_kriteria }} — {{ $item->nama_kriteria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Operator</label>
                        <select name="operator" class="form-select" required>
                            <option value="between">between</option>
                            <option value=">=">&gt;=</option>
                            <option value="<=">&lt;=</option>
                            <option value=">">&gt;</option>
                            <option value="<">&lt;</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nilai Min</label>
                        <input type="number"
                               step="0.01"
                               name="nilai_min"
                               class="form-input"
                               placeholder="0.00">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nilai Max</label>
                        <input type="number"
                               step="0.01"
                               name="nilai_max"
                               class="form-input"
                               placeholder="0.00">
                    </div>
                </div>

                {{-- Baris 2 --}}
                <div class="form-grid form-grid-3">
                    <div class="form-group">
                        <label class="form-label">Label</label>
                        <input type="text"
                               name="label"
                               class="form-input"
                               placeholder="Rendah / Sedang / Tinggi"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Skor Aturan</label>
                        <input type="number"
                               name="skor_aturan"
                               class="form-input"
                               placeholder="0"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan"
                                  rows="1"
                                  class="form-textarea"
                                  placeholder="Deskripsi aturan (opsional)"></textarea>
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-submit">
                        <svg width="14" height="14" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Simpan Rule
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="rule-table-card">
        <div class="rule-table-header">
            <div class="rule-table-header-left">
                <div class="header-icon">
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3>Daftar Rule Forward Chaining</h3>
            </div>
            <span class="rule-count-badge">{{ $rules->count() }} Rule</span>
        </div>

        <table class="rule-table">
            <thead>
                <tr>
                    <th>ID Rule</th>
                    <th>Kriteria</th>
                    <th>Operator</th>
                    <th>Rentang Nilai</th>
                    <th>Label</th>
                    <th>Skor</th>
                    <th>Keterangan</th>
                    <th style="width:90px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rules as $rule)
                <tr>
                    <td>
                        <span class="id-rule-badge">{{ $rule->id_aturan }}</span>
                    </td>

                    <td>
                        <span class="kriteria-chip">{{ $rule->kriteria->nama_kriteria }}</span>
                    </td>

                    <td>
                        <span class="operator-badge">{{ $rule->operator }}</span>
                    </td>

                    <td>
                        <div class="nilai-range">
                            <span>{{ $rule->nilai_min ?? '—' }}</span>
                            @if($rule->operator === 'between')
                                <span class="nilai-dash">–</span>
                                <span>{{ $rule->nilai_max ?? '—' }}</span>
                            @endif
                        </div>
                    </td>

                    <td>
                        @php
                            $lbl = strtolower($rule->label);
                            $lblClass = match(true) {
                                str_contains($lbl, 'tinggi') => 'tinggi',
                                str_contains($lbl, 'sedang') => 'sedang',
                                str_contains($lbl, 'rendah') => 'rendah',
                                default => 'default'
                            };
                        @endphp
                        <span class="label-badge {{ $lblClass }}">{{ $rule->label }}</span>
                    </td>

                    <td>
                        <span class="skor-pill">{{ $rule->skor_aturan }}</span>
                    </td>

                    <td>
                        <span class="keterangan-text" title="{{ $rule->keterangan }}">
                            {{ $rule->keterangan ?: '—' }}
                        </span>
                    </td>

                    <td>
                        <form action="{{ route('admin.rule.destroy', $rule->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus rule {{ $rule->id_aturan }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">
                                <svg width="12" height="12" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="rule-empty">
                            <svg width="36" height="36" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 4a3 3 0 016 0v1h1a1 1 0 01.894.553l1 2A1 1 0 0114 9H6a1 1 0 01-.894-1.447l1-2A1 1 0 017 5h1V4a1 1 0 00-2 0H5zm7 6a1 1 0 00-1 1v3a1 1 0 002 0v-3a1 1 0 00-1-1zm-4 0a1 1 0 00-1 1v3a1 1 0 002 0v-3a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <p>Belum ada data rule yang ditambahkan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection