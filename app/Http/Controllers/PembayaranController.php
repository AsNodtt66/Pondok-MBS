<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Tambahkan ini jika perlu Auth untuk pembayaran

class PembayaranController extends Controller
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
            'Jenis_pembayaran' => 'required|string|max:50',
            'Jumlah' => 'required|numeric|min:0',
            'Tanggal_bayar' => 'required|date',
            'Metode_bayar' => 'required|string|max:50',
            'Status_bayar' => 'required|in:lunas,belum lunas',
            'Jatuh_tempo' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pembayaran = Pembayaran::create($request->all());

        return response()->json(['message' => 'Pembayaran berhasil ditambahkan.', 'data' => $pembayaran], 201);
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'Jenis_pembayaran' => 'required|string|max:50',
            'Jumlah' => 'required|numeric|min:0',
            'Tanggal_bayar' => 'required|date',
            'Metode_bayar' => 'required|string|max:50',
            'Status_bayar' => 'required|in:lunas,belum lunas',
            'Jatuh_tempo' => 'nullable|date|after_or_equal:Tanggal_bayar', // Tambahkan validasi ini
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pembayaran->update($request->all());

        return response()->json(['message' => 'Pembayaran berhasil diperbarui.', 'data' => $pembayaran]);
    }

    public function destroy($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->delete();
            return response()->json(['message' => 'Pembayaran berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}