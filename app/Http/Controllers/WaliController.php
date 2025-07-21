<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\ProgressHafalan;
use App\Models\Pembayaran;
use App\Models\PsikologiSantri;
use App\Models\Laporan;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WaliController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:Pengguna');
        $this->middleware('role:wali');
    }

    public function dashboard()
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();

        // Data Hafalan
        $hafalanData = $this->getHafalanData($santri->id);
        $keuanganData = $this->getKeuanganData($santri->id);
        $psikologiData = $this->getPsikologiData($santri->id);

        // Initialize empty notifications array
        $notifications = [];

        return view('dashboard.wali', array_merge(
            [
                'wali' => $wali,
                'santri' => $santri
            ],
            $hafalanData,
            $keuanganData,
            $psikologiData,
            [
                'chartHafalan' => $this->getHafalanChartData($santri->id),
                'notifications' => $notifications
            ]
        ));
    }

    public function akademik()
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();

        // Fetch paginated data for each section
        $progressHafalans = $santri->progressHafalans()->paginate(5, ['*'], 'hafalan_page');
        $psikologiSantris = $santri->psikologiSantris()->with('pengguna')->paginate(5, ['*'], 'psikologi_page');
        $pembayarans = $santri->pembayarans()->paginate(5, ['*'], 'pembayaran_page');

        // Calculate hafalan stats
        $hafalanStats = $this->calculateHafalanStats($santri->id, $progressHafalans);

        return view('dashboard.akademik', [
            'wali' => $wali,
            'santri' => $santri,
            'progressHafalans' => $progressHafalans,
            'psikologiSantris' => $psikologiSantris,
            'pembayarans' => $pembayarans,
            'progressHafalansJson' => $progressHafalans->toArray(),
            'psikologiSantrisJson' => $psikologiSantris->toArray(),
            'pembayaransJson' => $pembayarans->toArray(),
            'totalJuz' => $hafalanStats['totalJuz'],
            'persentaseLancar' => $hafalanStats['persentaseLancar'],
            'rataJuzPerBulan' => $hafalanStats['rataJuzPerBulan'],
        ]);
    }

    public function keuangan()
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();
        $keuanganData = $this->getKeuanganData($santri->id);

        return view('dashboard.keuangan', array_merge(
            ['wali' => $wali, 'santri' => $santri],
            $keuanganData
        ));
    }

    public function riwayatKeuangan()
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();
        $pembayarans = Pembayaran::where('Santri_id', $santri->id)
            ->orderBy('Tanggal_bayar', 'desc')
            ->paginate(10);

        // Calculate summary data
        $totalDibayar = Pembayaran::where('Santri_id', $santri->id)
            ->where('Status_bayar', 'Lunas')
            ->sum('Jumlah');

        $transaksiTahunIni = Pembayaran::where('Santri_id', $santri->id)
            ->whereYear('Tanggal_bayar', now()->year)
            ->count();

        $totalTransaksi = Pembayaran::where('Santri_id', $santri->id)->count();
        $tepatWaktu = Pembayaran::where('Santri_id', $santri->id)
            ->where('Status_bayar', 'Lunas')
            ->where('Tanggal_bayar', '<=', 'Jatuh_tempo') // Asumsi ada kolom Jatuh_tempo
            ->count();
        $persentaseTepatWaktu = $totalTransaksi > 0 ? ($tepatWaktu / $totalTransaksi * 100) : 0;

        return view('dashboard.keuangan-riwayat', [
            'wali' => $wali,
            'santri' => $santri,
            'pembayarans' => $pembayarans,
            'totalDibayar' => $totalDibayar,
            'transaksiTahunIni' => $transaksiTahunIni,
            'persentaseTepatWaktu' => $persentaseTepatWaktu
        ]);
    }

    public function exportKeuangan()
    {
        // Logika untuk export ke CSV atau format lain
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();
        $pembayarans = Pembayaran::where('Santri_id', $santri->id)
            ->orderBy('Tanggal_bayar', 'desc')
            ->get();

        $csvContent = "Tanggal Bayar,Jenis Pembayaran,Jumlah,Status\n";
        foreach ($pembayarans as $pembayaran) {
            $csvContent .= sprintf(
                "%s,%s,%s,%s\n",
                $pembayaran->Tanggal_bayar ? $pembayaran->Tanggal_bayar->format('d M Y') : '-',
                $pembayaran->Jenis_pembayaran ?? '-',
                number_format($pembayaran->Jumlah, 0, ',', '.'),
                $pembayaran->Status_bayar ?? 'Belum Lunas'
            );
        }

        $filename = 'riwayat_pembayaran_' . $santri->Nama_santri . '_' . now()->format('Ymd_His') . '.csv';
        return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    }

    public function psikologi()
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();
        $psikologiData = $this->getPsikologiData($santri->id);

        // Ambil daftar lengkap psikologi berdasarkan Santri_id dengan paginasi
        $psikologi = PsikologiSantri::where('Santri_id', $santri->id)
            ->orderBy('Tanggal_konseling', 'desc')
            ->paginate(10);

        return view('dashboard.psikologi', array_merge(
            ['wali' => $wali, 'santri' => $santri, 'psikologi' => $psikologi],
            $psikologiData
        ));
    }

    public function profil()
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();

        return view('dashboard.profil', [
            'wali' => $wali,
            'santri' => $santri,
            'user' => $user
        ]);
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();

        $request->validate([
            'Nama_wali' => 'required|string|max:255',
            'Alamat_wali' => 'required|string|max:500',
            'Kontak' => 'required|string|max:20',
            'Email_wali' => 'required|email|unique:walis,Email_wali,' . $wali->id . '|max:255',
            'Hubungan' => 'required|string|max:50',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['Nama_wali', 'Alamat_wali', 'Kontak', 'Email_wali', 'Hubungan']);
        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('profile_photos', 'public');
            $data['foto_profil'] = $path;
        }

        $wali->update($data);
        return redirect()->route('dashboard.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function laporan()
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();
        $laporans = Laporan::where('Santri_id', $santri->id)
            ->with('pembuat', 'psikologiSantri', 'pembayaran', 'progressHafalan')
            ->paginate(10);

        return view('dashboard.laporan-wali', [
            'wali' => $wali,
            'santri' => $santri,
            'laporans' => $laporans
        ]);
    }

    public function showLaporan($id)
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();
        $laporan = Laporan::where('Santri_id', $santri->id)
            ->with(['santri', 'psikologiSantri', 'pembayaran', 'progressHafalan'])
            ->findOrFail($id);

        return view('dashboard.laporan-detail-wali', [
            'wali' => $wali,
            'santri' => $santri,
            'laporan' => $laporan
        ]);
    }

    public function cetakLaporan($id)
    {
        $user = Auth::guard('Pengguna')->user();
        $wali = Wali::where('id', $user->wali_id)->firstOrFail();
        $santri = Santri::where('wali_id', $wali->id)->firstOrFail();
        $laporan = Laporan::where('Santri_id', $santri->id)
            ->with(['santri', 'psikologiSantri', 'pembayaran', 'progressHafalan'])
            ->findOrFail($id);

        return view('dashboard.laporan-cetak-wali', [
            'wali' => $wali,
            'santri' => $santri,
            'laporan' => $laporan
        ]);
    }

    private function getHafalanData($santriId)
    {
        $latestHafalan = ProgressHafalan::where('Santri_id', $santriId)
            ->latest('Tanggal_setor')
            ->first();

        return [
            'latestHafalan' => $latestHafalan,
            'totalJuz' => ProgressHafalan::where('Santri_id', $santriId)->distinct('Juz')->count('Juz'),
            'formattedTanggalSetor' => $this->formatDate($latestHafalan->Tanggal_setor ?? null)
        ];
    }

    private function getKeuanganData($santriId)
    {
        $latestPembayaran = Pembayaran::where('Santri_id', $santriId)
            ->latest('Tanggal_bayar')
            ->first();

        $totalTagihan = Pembayaran::where('Santri_id', $santriId)->sum('Jumlah');
        $totalDibayar = Pembayaran::where('Santri_id', $santriId)
            ->where('Status_bayar', 'Lunas')
            ->sum('Jumlah');

        return [
            'latestPembayaran' => $latestPembayaran,
            'totalTagihan' => $totalTagihan,
            'totalDibayar' => $totalDibayar,
            'sisaTagihan' => $totalTagihan - $totalDibayar,
            'formattedTanggalBayar' => $this->formatDate($latestPembayaran->Tanggal_bayar ?? null)
        ];
    }

    private function getPsikologiData($santriId)
    {
        $latestPsikologi = PsikologiSantri::where('Santri_id', $santriId)
            ->latest('Tanggal_konseling')
            ->first();

        return [
            'latestPsikologi' => $latestPsikologi,
            'formattedTanggalKonseling' => $this->formatDate($latestPsikologi->Tanggal_konseling ?? null)
        ];
    }

    private function calculateHafalanStats($santriId, $progressHafalans)
    {
        $total = $progressHafalans->total();
        $lancarCount = ProgressHafalan::where('Santri_id', $santriId)
            ->where('Kualitas_hafalan', 'Lancar')
            ->count();

        $yearlyJuz = ProgressHafalan::where('Santri_id', $santriId)
            ->where('Tanggal_setor', '>=', now()->subYear())
            ->distinct('Juz')
            ->count('Juz');

        return [
            'totalJuz' => ProgressHafalan::where('Santri_id', $santriId)->distinct('Juz')->count('Juz'),
            'persentaseLancar' => $total > 0 ? ($lancarCount / $total * 100) : 0,
            'rataJuzPerBulan' => $yearlyJuz / 12
        ];
    }

    private function formatDate($date)
    {
        return $date instanceof \Carbon\Carbon ? $date->format('d M Y') : $date;
    }

    private function getHafalanChartData($santriId)
    {
        try {
            // Ambil data hafalan 6 bulan terakhir
            $data = ProgressHafalan::where('Santri_id', $santriId)
                ->where('Tanggal_setor', '>=', now()->subMonths(6))
                ->selectRaw('MONTH(Tanggal_setor) as bulan, YEAR(Tanggal_setor) as tahun, COUNT(DISTINCT Juz) as total')
                ->groupBy('bulan', 'tahun')
                ->orderBy('tahun')
                ->orderBy('bulan')
                ->get();

            $labels = [];
            $values = [];

            // Generate 6 bulan terakhir
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $month = $date->format('M Y');
                $labels[] = $month;

                $monthNumber = $date->month;
                $yearNumber = $date->year;
                
                // Cari data untuk bulan dan tahun ini
                $found = $data->where('bulan', $monthNumber)->where('tahun', $yearNumber)->first();
                $values[] = $found ? $found->total : 0;
            }

            // Hitung total untuk menentukan hasData
            $totalProgress = collect($values)->sum();

            return [
                'labels' => $labels,
                'data' => $values,
                'hasData' => $totalProgress > 0,
                'totalProgress' => $totalProgress
            ];
            
        } catch (\Exception $e) {
            // Return default structure jika error
            $labels = [];
            for ($i = 5; $i >= 0; $i--) {
                $labels[] = now()->subMonths($i)->format('M Y');
            }
            
            return [
                'labels' => $labels,
                'data' => array_fill(0, 6, 0),
                'hasData' => false,
                'totalProgress' => 0,
                'error' => 'Gagal memuat data chart: ' . $e->getMessage()
            ];
        }
    }
}