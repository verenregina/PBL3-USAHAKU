<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\JenisUsaha;
use App\Models\Marketplace;
use App\Models\Umkm;
use Illuminate\Http\Request;

class KelolaDataController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPIL DATA
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $q = $request->query('q', '');
        $filterKategori = $request->query('kategori', '');
        $filterStatus = $request->query('status', '');
        $filterKota = $request->query('kota', '');

        $query = Umkm::with([
            'jenisUsaha',
            'daerah',
            'marketplace',
            'analisis'
        ]);

        // Filter berdasarkan pencarian (q)
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_usaha', 'like', '%' . $q . '%')
                    ->orWhere('id_umkm', 'like', '%' . $q . '%')
                    ->orWhereHas('daerah', function ($qq) use ($q) {
                        $qq->where('nama_daerah', 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('jenisUsaha', function ($qq) use ($q) {
                        $qq->where('nama_jenis_usaha', 'like', '%' . $q . '%');
                    });
            });
        }

        if ($filterKategori) {
            $query->where('id_jenis_usaha', $filterKategori);
        }

        if ($filterStatus === 'aktif') {
            $query->where('laba', '>=', 0);
        } elseif ($filterStatus === 'nonaktif') {
            $query->where('laba', '<', 0);
        }

        if ($filterKota) {
            $query->whereHas('daerah', function ($q2) use ($filterKota) {
                $q2->where('nama_daerah', 'like', '%' . $filterKota . '%');
            });
        }

        $dataUsaha = $query->latest()
                   ->paginate(10)
                   ->appends(request()->query());

        $jenisUsaha = JenisUsaha::all();
        $marketplaces = Marketplace::all();
        $daerahs = Daerah::all();

        return view('admin.kelola-data', compact(
            'dataUsaha',
            'jenisUsaha',
            'marketplaces',
            'daerahs',
            'filterKategori',
            'filterStatus',
            'filterKota',
            'q'
        ));
    }

    /**
     * Pencarian UMKM (JSON paginated)
     */
    public function search(Request $request)
    {
        try {
            if (auth()->user()->role != 'admin') {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            $q = $request->query('q', '');
            $filterKategori = $request->query('kategori', '');
            $filterStatus = $request->query('status', '');
            $filterKota = $request->query('kota', '');
            $page = $request->query('page', 1);

            $query = Umkm::with(['jenisUsaha', 'daerah', 'marketplace']);

            if ($filterKategori) {
                $query->where('id_jenis_usaha', $filterKategori);
            }

            if ($filterStatus === 'aktif') {
                $query->where('laba', '>=', 0);
            } elseif ($filterStatus === 'nonaktif') {
                $query->where('laba', '<', 0);
            }

            if ($filterKota) {
                $query->whereHas('daerah', function ($q2) use ($filterKota) {
                    $q2->where('nama_daerah', 'like', '%' . $filterKota . '%');
                });
            }

            if ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nama_usaha', 'like', '%' . $q . '%')
                        ->orWhere('id_umkm', 'like', '%' . $q . '%')
                        ->orWhereHas('daerah', function ($qq) use ($q) {
                            $qq->where('nama_daerah', 'like', '%' . $q . '%');
                        })
                        ->orWhereHas('jenisUsaha', function ($qq) use ($q) {
                            $qq->where('nama_jenis_usaha', 'like', '%' . $q . '%');
                        });
                });
            }

            $dataUsaha = $query->latest()->paginate(10, ['*'], 'page', $page);

            $items = $dataUsaha->items();
            $formattedItems = array_map(function ($item) {
                return [
                    'id_umkm' => $item->id_umkm,
                    'nama_usaha' => $item->nama_usaha,
                    'id_jenis_usaha' => $item->id_jenis_usaha,
                    'jenis_usaha' => $item->jenisUsaha?->nama_jenis_usaha,
                    'id_daerah' => $item->id_daerah,
                    'daerah' => $item->daerah?->nama_daerah,
                    'aset' => $item->aset,
                ];
            }, $items);

            return response()->json([
                'success' => true,
                'data' => $formattedItems,
                'meta' => [
                    'current_page' => $dataUsaha->currentPage(),
                    'last_page' => $dataUsaha->lastPage(),
                    'per_page' => $dataUsaha->perPage(),
                    'total' => $dataUsaha->total(),
                    'from' => $dataUsaha->firstItem(),
                    'to' => $dataUsaha->lastItem(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tampilkan detail UMKM
     */
    public function show($id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $umkm = Umkm::with(['jenisUsaha', 'daerah', 'marketplace', 'analisis'])->findOrFail($id);

        return view('admin.kelola-data-detail', compact('umkm'));
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required',
            'id_jenis_usaha' => 'required|exists:jenis_usaha,id_jenis_usaha',
            'id_marketplace' => 'required|exists:marketplace,id_marketplace',
            'id_daerah' => 'required|exists:daerah,id_daerah',
            'tenaga_kerja_perempuan' => 'required|numeric',
            'tenaga_kerja_laki_laki' => 'required|numeric',
            'total_tenaga_kerja' => 'required|numeric',
            'aset' => 'required|numeric',
            'omset' => 'required|numeric',
            'kapasitas_produksi' => 'required|numeric',
            'tahun_berdiri' => 'required|integer',
            'jumlah_pelanggan' => 'required|numeric',
            'laba' => 'required|numeric',
            'biaya_karyawan' => 'required|numeric',
        ]);

        Umkm::create($request->only([
            'nama_usaha',
            'id_jenis_usaha',
            'id_marketplace',
            'id_daerah',
            'tenaga_kerja_perempuan',
            'tenaga_kerja_laki_laki',
            'total_tenaga_kerja',
            'aset',
            'omset',
            'kapasitas_produksi',
            'tahun_berdiri',
            'jumlah_pelanggan',
            'laba',
            'biaya_karyawan',
        ]));

        return redirect()
            ->route('admin.kelola-data')
            ->with('success', 'Data UMKM berhasil ditambahkan');
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $umkm = Umkm::findOrFail($id);

        $request->validate([
            'nama_usaha' => 'required',
            'id_jenis_usaha' => 'required|exists:jenis_usaha,id_jenis_usaha',
            'id_marketplace' => 'required|exists:marketplace,id_marketplace',
            'id_daerah' => 'required|exists:daerah,id_daerah',
            'tenaga_kerja_perempuan' => 'required|numeric',
            'tenaga_kerja_laki_laki' => 'required|numeric',
            'total_tenaga_kerja' => 'required|numeric',
            'aset' => 'required|numeric',
            'omset' => 'required|numeric',
            'kapasitas_produksi' => 'required|numeric',
            'tahun_berdiri' => 'required|integer',
            'jumlah_pelanggan' => 'required|numeric',
            'laba' => 'required|numeric',
            'biaya_karyawan' => 'required|numeric',
        ]);

        $umkm->update([
            'nama_usaha' => $request->nama_usaha,
            'id_jenis_usaha' => $request->id_jenis_usaha,
            'id_marketplace' => $request->id_marketplace,
            'id_daerah' => $request->id_daerah,
            'tenaga_kerja_perempuan' => $request->tenaga_kerja_perempuan,
            'tenaga_kerja_laki_laki' => $request->tenaga_kerja_laki_laki,
            'total_tenaga_kerja' => $request->total_tenaga_kerja,
            'aset' => $request->aset,
            'omset' => $request->omset,
            'kapasitas_produksi' => $request->kapasitas_produksi,
            'tahun_berdiri' => $request->tahun_berdiri,
            'jumlah_pelanggan' => $request->jumlah_pelanggan,
            'laba' => $request->laba,
            'biaya_karyawan' => $request->biaya_karyawan,
        ]);

        return redirect()
            ->route('admin.kelola-data')
            ->with('success', 'Data UMKM berhasil diupdate');
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS DATA
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);

        $umkm->delete();

        return redirect()
            ->route('admin.kelola-data')
            ->with('success', 'Data UMKM berhasil dihapus');
    }
}
