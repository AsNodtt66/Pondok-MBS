<?php

namespace App\Http\Controllers;

use App\Models\PsikologiSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PsikologiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:Pengguna');
        $this->middleware('role:admin');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Santri_id' => 'required|exists:santris,id',
            'Tanggal_konseling' => 'required|date',
            'Hasil_psikologi' => 'required|string',
            'Catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Tambahkan Pengguna_id dari pengguna yang sedang login
        $request->merge(['Pengguna_id' => Auth::id()]);

        $psikologi = PsikologiSantri::create($request->all());

        return response()->json(['message' => 'Data psikologi berhasil ditambahkan.', 'data' => $psikologi], 201);
    }

    public function update(Request $request, $id)
    {
        $psikologi = PsikologiSantri::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'Tanggal_konseling' => 'required|date',
            'Hasil_psikologi' => 'required|string',
            'Catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Anda mungkin ingin memperbarui Pengguna_id juga jika konselornya berubah,
        // atau biarkan saja Pengguna_id aslinya. Untuk saat ini, biarkan saja tidak diupdate.
        // $request->merge(['Pengguna_id' => Auth::id()]);

        $psikologi->update($request->all());

        return response()->json(['message' => 'Data psikologi berhasil diperbarui.', 'data' => $psikologi]);
    }

    public function destroy($id)
    {
        try {
            $psikologi = PsikologiSantri::findOrFail($id);
            $psikologi->delete();
            return response()->json(['message' => 'Data psikologi berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}