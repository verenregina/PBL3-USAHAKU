<?php

namespace App\Http\Controllers;

use App\Models\AturanRekomendasi;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class RuleForwardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN DATA RULE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $rules = AturanRekomendasi::with('kriteria')
            ->orderBy('id_aturan')
            ->get();

        $kriteria = Kriteria::orderBy('kode_kriteria')->get();

        return view('admin.rule-forward', compact(
            'rules',
            'kriteria'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN RULE BARU
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'id_aturan' => 'required|unique:aturan_rekomendasi,id_aturan',
            'id_kriteria' => 'required|exists:m_kriteria,kode_kriteria',
            'operator' => 'required',
            'nilai_min' => 'nullable|numeric',
            'nilai_max' => 'nullable|numeric',
            'label' => 'required',
            'skor_aturan' => 'required|integer',
            'keterangan' => 'nullable'
        ]);

        AturanRekomendasi::create($request->all());

        return back()
            ->with('success', 'Rule berhasil ditambahkan.');
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE RULE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $rule = AturanRekomendasi::findOrFail($id);

        $request->validate([
            'id_kriteria' => 'required|exists:m_kriteria,kode_kriteria',
            'operator' => 'required',
            'nilai_min' => 'nullable|numeric',
            'nilai_max' => 'nullable|numeric',
            'label' => 'required',
            'skor_aturan' => 'required|integer',
            'keterangan' => 'nullable'
        ]);

        $rule->update([
            'id_kriteria' => $request->id_kriteria,
            'operator' => $request->operator,
            'nilai_min' => $request->nilai_min,
            'nilai_max' => $request->nilai_max,
            'label' => $request->label,
            'skor_aturan' => $request->skor_aturan,
            'keterangan' => $request->keterangan
        ]);

        return back()
            ->with('success', 'Rule berhasil diperbarui.');
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS RULE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $rule = AturanRekomendasi::findOrFail($id);

        $rule->delete();

        return back()
            ->with('success', 'Rule berhasil dihapus.');
    }
}