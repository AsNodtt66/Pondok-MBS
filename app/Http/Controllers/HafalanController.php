<?php

namespace App\Http\Controllers;

use App\Models\ProgressHafalan;
use App\Models\Santri; // Pastikan Santri di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HafalanController extends Controller
{
    public function index($santriId)
    {
        $santri = Santri::findOrFail($santriId);

        // Mendapatkan data paginasi
        $progressHafalans = $santri->progressHafalans()->paginate(10);
        $psikologiSantris = $santri->psikologiSantris()->paginate(10);
        $pembayarans = $santri->pembayarans()->paginate(10);

        // Mengubah Paginator menjadi format yang berisi data dan HTML links
        $progressHafalansJson = [
            'data' => $progressHafalans->items(), // Ambil hanya item data
            'links' => $progressHafalans->links()->toHtml(), // Konversi links menjadi HTML string
            'hasPages' => $progressHafalans->hasPages(), // Indikator apakah ada halaman lain
        ];
        $psikologiSantrisJson = [
            'data' => $psikologiSantris->items(),
            'links' => $psikologiSantris->links()->toHtml(),
            'hasPages' => $psikologiSantris->hasPages(),
        ];
        $pembayaransJson = [
            'data' => $pembayarans->items(),
            'links' => $pembayarans->links()->toHtml(),
            'hasPages' => $pembayarans->hasPages(),
        ];

        return view('akademik', compact('santri', 'progressHafalansJson', 'psikologiSantrisJson', 'pembayaransJson'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'Santri_id' => 'required|exists:santris,id',
                'Juz' => 'required|integer|min:1|max:30',
                'Surah' => 'required|string|max:255',
                'Ayat_mulai' => 'required|integer|min:1',
                'Ayat_selesai' => 'required|integer|min:1|gte:Ayat_mulai',
                'Tanggal_setor' => 'required|date',
                'Status_setor' => 'required|in:lulus,belum lulus',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
            }

            $hafalan = ProgressHafalan::create($request->all());
            return response()->json(['message' => 'Data hafalan berhasil ditambahkan.', 'data' => $hafalan], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'Juz' => 'required|integer|min:1|max:30',
                'Surah' => 'required|string|max:255',
                'Ayat_mulai' => 'required|integer|min:1',
                'Ayat_selesai' => 'required|integer|min:1|gte:Ayat_mulai',
                'Tanggal_setor' => 'required|date',
                'Status_setor' => 'required|in:lulus,belum lulus',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
            }

            $hafalan = ProgressHafalan::findOrFail($id);
            $hafalan->update($request->all());
            return response()->json(['message' => 'Data hafalan berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $hafalan = ProgressHafalan::findOrFail($id);
            $hafalan->delete();
            return response()->json(['message' => 'Data hafalan berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function dataJson($santriId)
    {
        try {
            $santri = Santri::findOrFail($santriId);

            $progressHafalans = $santri->progressHafalans()->paginate(10);
            $psikologiSantris = $santri->psikologiSantris()->paginate(10);
            $pembayarans = $santri->pembayarans()->paginate(10);

            return response()->json([
                'progressHafalans' => [
                    'data' => $progressHafalans->items(),
                    'links' => $progressHafalans->links()->toHtml(), // Konversi links menjadi HTML string
                    'hasPages' => $progressHafalans->hasPages(),
                ],
                'psikologiSantris' => [
                    'data' => $psikologiSantris->items(),
                    'links' => $psikologiSantris->links()->toHtml(),
                    'hasPages' => $psikologiSantris->hasPages(),
                ],
                'pembayarans' => [
                    'data' => $pembayarans->items(),
                    'links' => $pembayarans->links()->toHtml(),
                    'hasPages' => $pembayarans->hasPages(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}