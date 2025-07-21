<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pengguna;

class LaporanController extends Controller
{
    /**
     * Menampilkan detail laporan untuk santri tertentu.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
            // Ambil pengguna yang sedang login
            $pengguna = auth()->guard('Pengguna')->user();

            // Pastikan pengguna adalah santri atau wali
            if ($pengguna->role_id == 3 || $pengguna->role_id == 4) {
                // Ambil Santri_id dari pengguna (untuk santri) atau dari wali_id jika wali
                $santriId = $pengguna->role_id == 3 ? $pengguna->santri_id : $pengguna->wali_id;

                // Ambil laporan berdasarkan id dan pastikan milik santri yang login
                $laporan = Laporan::with([
                    'pembuat',
                    'santri',
                    'psikologiSantri.santri',
                    'pembayaran.santri',
                    'progressHafalan.santri'
                ])->where('Santri_id', $santriId)->findOrFail($id);
            } else {
                // Untuk admin atau pengurus, izinkan akses penuh
                $laporan = Laporan::with([
                    'pembuat',
                    'santri',
                    'psikologiSantri.santri',
                    'pembayaran.santri',
                    'progressHafalan.santri'
                ])->findOrFail($id);
            }

            $activeTab = request()->get('tab', 'psikologi');

            return view('laporan', compact('laporan', 'activeTab'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Laporan tidak ditemukan untuk pengguna ini.');
        }
    }

    /**
     * Mengunduh laporan dalam format PDF.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf($id)
    {
        // Ambil pengguna yang sedang login
        $pengguna = auth()->guard('Pengguna')->user();

        // Pastikan pengguna adalah santri atau wali
        if ($pengguna->role_id == 3 || $pengguna->role_id == 4) {
            $santriId = $pengguna->role_id == 3 ? $pengguna->santri_id : $pengguna->wali_id;
            $laporan = Laporan::with([
                'pembuat',
                'psikologiSantri.santri',
                'pembayaran.santri',
                'progressHafalan.santri'
            ])->where('Santri_id', $santriId)->findOrFail($id);
        } else {
            $laporan = Laporan::with([
                'pembuat',
                'psikologiSantri.santri',
                'pembayaran.santri',
                'progressHafalan.santri'
            ])->findOrFail($id);
        }

        // Konversi Tanggal_generate ke objek DateTime jika masih string
        if (is_string($laporan->Tanggal_generate)) {
            $laporan->Tanggal_generate = Carbon::parse($laporan->Tanggal_generate);
        }

        // Konversi Tanggal_lapor ke objek DateTime jika masih string
        if (is_string($laporan->Tanggal_lapor)) {
            $laporan->Tanggal_lapor = Carbon::parse($laporan->Tanggal_lapor);
        }

        $activeTab = 'psikologi';

        $pdf = PDF::loadView('laporan', compact('laporan', 'activeTab'))
            ->setPaper('a4', 'landscape')
            ->setOptions(['defaultFont' => 'Arial']);

        return $pdf->download('laporan-pondok-mbs-' . $laporan->id . '-' . now()->format('YmdHis') . '.pdf');
    }
}