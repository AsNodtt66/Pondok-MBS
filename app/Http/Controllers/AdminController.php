<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Wali;
use App\Models\Alumni;
use App\Models\Santri;
use App\Models\Laporan;
use App\Models\Pengguna;
use App\Models\Pengurus;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\ProgressHafalan;
use App\Models\PsikologiSantri;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:Pengguna');
        $this->middleware('role:admin');
    }

    // Admin Dashboard
    public function dashboard()
    {
        $totalPengguna = Pengguna::count();
        $totalSantri = Santri::count();
        $totalWali = Wali::count();
        $totalAlumni = Alumni::count();
        $totalPengurus = Pengurus::count();

        return view('admin.dashboard', compact(
            'totalPengguna',
            'totalSantri',
            'totalWali',
            'totalAlumni',
            'totalPengurus'
        ));
    }

    // Santri Management (Admin)
    public function indexSantri(Request $request)
    {
        $query = Santri::with('walis');
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('Nama_santri', 'like', "%{$search}%")
                ->orWhere('Santri_id', 'like', "%{$search}%")
                ->orWhere('Email', 'like', "%{$search}%");
            });
        }
        $santris = $query->paginate(10);
        return view('admin.santri.index', compact('santris'));
    }

    public function createSantri()
    {
        $walis = Wali::all();
        return view('admin.santri.create', compact('walis'));
    }

    public function storeSantri(Request $request)
    {
        $request->validate([
            'Nama_santri' => 'required|string|max:255',
            'Santri_id' => 'required|string|unique:santris|max:20',
            'Tanggal_lhr' => 'required|date|before_or_equal:' . Carbon::now()->subYears(5)->format('Y-m-d'),
            'Jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'Status_aksk' => 'required|in:aktif,nonaktif',
            'Email' => 'required|email|unique:santris|max:255',
            'No_hp' => 'required|string|max:20',
            'Wali_id' => 'nullable|exists:walis,id',
            'Kelas' => 'nullable|string|max:10',
        ], [
            'Tanggal_lhr.before_or_equal' => 'Tanggal lahir harus sebelum atau sama dengan ' . Carbon::now()->subYears(5)->format('d M Y'),
        ]);

        try {
            Santri::create($request->all());
            return redirect()->route('admin.santri.index')->with('success', 'Santri berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan santri: ' . $e->getMessage()])->withInput();
        }
    }

    public function editSantri($id)
    {
        $santri = Santri::findOrFail($id);
        $walis = Wali::all();
        return view('admin.santri.edit', compact('santri', 'walis'));
    }

    public function updateSantri(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);

        $request->validate([
            'Nama_santri' => 'required|string|max:255',
            'Santri_id' => 'required|string|unique:santris,Santri_id,' . $id . '|max:20',
            'Tanggal_lhr' => 'required|date|before_or_equal:' . Carbon::now()->subYears(5)->format('Y-m-d'),
            'Jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'Status_aksk' => 'required|in:aktif,nonaktif',
            'Email' => 'required|email|unique:santris,Email,' . $id . '|max:255',
            'No_hp' => 'required|string|max:20',
            'Wali_id' => 'nullable|exists:walis,id',
            'Kelas' => 'nullable|string|max:10',
        ], [
            'Tanggal_lhr.before_or_equal' => 'Tanggal lahir harus sebelum atau sama dengan ' . Carbon::now()->subYears(5)->format('d M Y'),
        ]);

        try {
            $santri->update($request->all());
            return redirect()->route('admin.santri.index')->with('success', 'Santri berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui santri: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroySantri($id)
    {
        try {
            $santri = Santri::findOrFail($id);
            $santri->delete();
            return redirect()->route('admin.santri.index')->with('success', 'Santri berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus santri: ' . $e->getMessage()]);
        }
    }

    // Academic Management for Santri (Admin View)
    public function akademikSantri(Santri $santri)
    {
        $progressHafalans = $santri->progressHafalans()->paginate(5, ['*'], 'hafalan_page');
        $psikologiSantris = $santri->psikologiSantris()->with('pengguna')->paginate(5, ['*'], 'psikologi_page');
        $pembayarans = $santri->pembayarans()->paginate(5, ['*'], 'pembayaran_page');

        $hafalanStats = [
            'totalJuz' => ProgressHafalan::where('Santri_id', $santri->id)->distinct('Juz')->count('Juz'),
            'lastSetor' => ProgressHafalan::where('Santri_id', $santri->id)->latest('Tanggal_setor')->first(),
        ];

        return view('admin.santri.akademik', [
            'santri' => $santri,
            'progressHafalans' => $progressHafalans,
            'psikologiSantris' => $psikologiSantris,
            'pembayarans' => $pembayarans,
            'progressHafalansJson' => $progressHafalans->toArray(),
            'psikologiSantrisJson' => $psikologiSantris->toArray(),
            'pembayaransJson' => $pembayarans->toArray(),
            'hafalanStats' => $hafalanStats,
        ]);
    }

    public function getAkademikDataJson(Santri $santri)
    {
        $progressHafalans = $santri->progressHafalans()->paginate(5, ['*'], 'hafalan_page');
        $psikologiSantris = $santri->psikologiSantris()->with('pengguna')->paginate(5, ['*'], 'psikologi_page');
        $pembayarans = $santri->pembayarans()->paginate(5, ['*'], 'pembayaran_page');

        return response()->json([
            'progressHafalans' => $progressHafalans->toArray(),
            'psikologiSantris' => $psikologiSantris->toArray(),
            'pembayarans' => $pembayarans->toArray(),
            'hafalanStats' => [
                'totalJuz' => ProgressHafalan::where('Santri_id', $santri->id)->distinct('Juz')->count('Juz'),
            ],
        ]);
    }

    // Wali Management
    public function indexWali()
    {
        $walis = Wali::with('santris')->paginate(10);
        return view('admin.wali.index', compact('walis'));
    }

    public function createWali()
    {
        return view('admin.wali.form', [
            'title' => 'Tambah Wali',
            'action' => route('admin.wali.store')
        ]);
    }

    public function storeWali(Request $request)
    {
        $request->validate([
            'Nama_wali' => 'required|string|max:255',
            'Alamat_wali' => 'required|string|max:500',
            'Kontak' => 'required|string|max:20',
            'Email_wali' => 'required|email|unique:walis|max:255',
            'Hubungan' => 'required|string|max:50',
        ]);

        Wali::create($request->all());
        return redirect()->route('admin.wali.index')->with('success', 'Wali berhasil ditambahkan.');
    }

    public function editWali($id)
    {
        $wali = Wali::findOrFail($id);
        return view('admin.wali.form', [
            'title' => 'Edit Wali',
            'action' => route('admin.wali.update', $id),
            'wali' => $wali
        ]);
    }

    public function updateWali(Request $request, $id)
    {
        $wali = Wali::findOrFail($id);

        $request->validate([
            'Nama_wali' => 'required|string|max:255',
            'Alamat_wali' => 'required|string|max:500',
            'Kontak' => 'required|string|max:20',
            'Email_wali' => 'required|email|unique:walis,Email_wali,' . $id . '|max:255',
            'Hubungan' => 'required|string|max:50',
        ]);

        $wali->update($request->all());
        return redirect()->route('admin.wali.index')->with('success', 'Wali berhasil diperbarui.');
    }

    public function destroyWali($id)
    {
        $wali = Wali::findOrFail($id);
        $wali->delete();
        return redirect()->route('admin.wali.index')->with('success', 'Wali berhasil dihapus.');
    }

    // Pengguna Management
    public function indexPengguna()
    {
        $penggunas = Pengguna::with('role')->paginate(10);
        return view('admin.pengguna.index', compact('penggunas'));
    }

    public function createPengguna()
    {
        $roles = Role::all();
        return view('admin.pengguna.create', compact('roles'));
    }

    public function storePengguna(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'username' => 'required|string|unique:penggunas|max:255',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Pengguna::create([
            'nama_pengguna' => $request->nama_pengguna,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function editPengguna($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $roles = Role::all();
        return view('admin.pengguna.edit', compact('pengguna', 'roles'));
    }

    public function updatePengguna(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'username' => 'required|string|unique:penggunas,username,' . $id . '|max:255',
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $updateData = $request->only(['nama_pengguna', 'username', 'role_id', 'status']);
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        $pengguna->update($updateData);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroyPengguna($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    // Alumni Management
    public function indexAlumni()
    {
        $alumnis = Alumni::with('wali')->paginate(10);
        return view('admin.alumni.index', compact('alumnis'));
    }

    public function createAlumni()
    {
        $walis = Wali::all();
        return view('admin.alumni.create', compact('walis'));
    }

    public function storeAlumni(Request $request)
    {
        $request->validate([
            'Nama_alumni' => 'required|string|max:255',
            'Santri_id' => 'required|string|unique:alumnis|max:20',
            'Tanggal_lhr' => 'required|date',
            'Jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'Status_aksk' => 'required|in:aktif,nonaktif',
            'Email' => 'required|email|unique:alumnis|max:255',
            'No_hp' => 'required|string|max:20',
            'Wali_id' => 'nullable|exists:walis,id',
        ]);

        Alumni::create($request->all());
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil ditambahkan.');
    }

    public function editAlumni($id)
    {
        $alumni = Alumni::findOrFail($id);
        $walis = Wali::all();
        return view('admin.alumni.edit', compact('alumni', 'walis'));
    }

    public function updateAlumni(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $request->validate([
            'Nama_alumni' => 'required|string|max:255',
            'Santri_id' => 'required|string|unique:alumnis,Santri_id,' . $id . '|max:20',
            'Tanggal_lhr' => 'required|date',
            'Jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'Status_aksk' => 'required|in:aktif,nonaktif',
            'Email' => 'required|email|unique:alumnis,Email,' . $id . '|max:255',
            'No_hp' => 'required|string|max:20',
            'Wali_id' => 'nullable|exists:walis,id',
        ]);

        $alumni->update($request->all());
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil diperbarui.');
    }

    public function destroyAlumni($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->delete();
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil dihapus.');
    }

    // Laporan
    public function indexLaporan()
    {
        $laporans = Laporan::with('pembuat', 'psikologiSantri', 'pembayaran', 'progressHafalan')->paginate(10);
        return view('admin.laporan.index', compact('laporans'));
    }

    public function showLaporan($id)
    {
        $laporan = Laporan::with(['santri', 'psikologiSantri', 'pembayaran', 'progressHafalan'])->findOrFail($id);
        return view('admin.laporan.detail', compact('laporan'));
    }

    public function cetakLaporan($id)
    {
        $laporan = Laporan::with(['santri', 'psikologiSantri', 'pembayaran', 'progressHafalan'])->findOrFail($id);
        return view('admin.laporan.cetak', compact('laporan'));
    }
}
